<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;
use App\Models\Cage;
use App\Models\DailyChickenReport;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(WeatherService $weather)
    {
        // Get cages for chicken (ayam) -> FILTER BY TYPE 'Layer'
        $cages = Cage::where('chicken_type', 'Layer')->get();
        $cageIds = $cages->pluck('id');
        
        // Get today's date
        $today = Carbon::today();
        
        // 1. Population Summary
        $populasi = $this->getPopulationSummary($cageIds, $today);
        
        // 2. Performance Index (FCR, HDP, HHEP)
        $performa = $this->getPerformanceIndex($cageIds, $today);
        
        // 3. Chart Data
        $chartData = $this->getChartData($cageIds, $cages);
        
        // 4. Weather Data from BMKG
        $cuaca = $weather->getForecast();
        
        // 5. Alerts
        $alerts = $this->getAlerts($cageIds);
        
        // 6. Daily Activities
        $aktivitasHarian = $this->getDailyActivities($cageIds, $today, $cages);
        
        // 7. Kandang List for charts
        $kandangList = $cages->map(function ($cage, $index) {
            $colors = ['#10B981', '#3B82F6', '#8B5CF6', '#F59E0B', '#EF4444'];
            return [
                'id' => $cage->id,
                'name' => $cage->name, // Updated from cage_name
                'color' => $colors[$index % count($colors)],
                'hdpVisible' => true,
                'hhepVisible' => true,
            ];
        })->values();

        // 8. Notifications
        $notifications = DB::table('notifications')
            ->where('notifiable_id', auth()->id() ?? 1) // Fallback to 1 for dev
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get()
            ->map(function ($n) {
                $data = json_decode($n->data, true);
                return [
                    'id' => $n->id,
                    'title' => $data['title'] ?? 'Notifikasi',
                    'message' => $data['message'] ?? '',
                    'type' => $data['type'] ?? 'info',
                    'read_at' => $n->read_at,
                    'created_at' => Carbon::parse($n->created_at)->diffForHumans(),
                ];
            });

        return view('pages.admin.ayam.index', compact(
            'populasi', 
            'performa', 
            'chartData', 
            'cuaca', 
            'alerts',
            'aktivitasHarian',
            'kandangList',
            'kandangList',
            'cages',
            'notifications'
        ));
    }

    /**
     * Get population summary data
     */
    private function getPopulationSummary($cageIds, $today)
    {
        // Get latest reports for each cage
        $latestReports = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->where('report_date', '<=', $today)
            ->orderBy('report_date', 'desc')
            ->get()
            ->unique('cage_id');

        // Get cages data
        $cages = Cage::whereIn('id', $cageIds)->get();

        // Calculate totals
        // Use population_alive from latest report, or fall back to initial_population
        $totalAlive = 0;
        foreach ($cages as $cage) {
            $report = $latestReports->where('cage_id', $cage->id)->first();
            $totalAlive += $report ? $report->population_alive : $cage->initial_population;
        }

        $totalProductive = $latestReports->sum('population_productive') ?: $totalAlive;
        $totalSick = $latestReports->sum('population_sick') ?: 0;
        $totalCulled = DailyChickenReport::whereIn('cage_id', $cageIds)->sum('population_culled') ?: 0;
        
        // Today's production
        $todayReports = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereDate('report_date', $today)
            ->get();
        
        $eggsToday = $todayReports->sum('eggs_produced');
        $eggWeightAvg = $todayReports->avg('eggs_weight_avg') ?: 0;
        $feedToday = $todayReports->sum('feed_consumed');
        
        // This month mortality
        $mortalityMonth = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereMonth('report_date', $today->month)
            ->whereYear('report_date', $today->year)
            ->sum('mortality_count');

        // Average age (weeks) from cages
        $avgAge = $cages->map(function($cage) use ($today) {
            return $cage->installed_date ? Carbon::parse($cage->installed_date)->diffInWeeks(Carbon::now()) : 0;
        })->avg() ?: 0;
        
        // Average weight - Placeholder as body_weight is not in daily reports yet
        // We could look it up if we added it, for now return 0 or static
        $avgWeight = 1.8; // Standard layer weight estimate in kg

        return [
            'total' => $totalAlive,
            'produktif' => $totalProductive ?: 1, // Avoid division by zero issues
            'afkir' => $totalCulled,
            'sakit' => $totalSick,
            'umur' => round($avgAge),
            'berat' => round($avgWeight, 1),
            'telur_hari' => $eggsToday,
            'berat_telur' => round($eggWeightAvg),
            'pakan_hari' => round($feedToday),
            'mortalitas_bulan' => $mortalityMonth,
        ];
    }

    /**
     * Get performance index (FCR, HDP, HHEP)
     */
    private function getPerformanceIndex($cageIds, $today)
    {
        // Get this month's data for averages (Reset Monthly)
        $monthStart = $today->copy()->startOfMonth();
        
        $monthlyReports = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereBetween('report_date', [$monthStart->toDateString(), $today->toDateString()])
            ->get();

        // Calculate averages
        $avgFcr = $monthlyReports->avg('fcr') ?: 0;
        $avgHdp = $monthlyReports->avg('hdp') ?: 0;
        $avgHhep = $monthlyReports->avg('hhep') ?: 0;
        
        // Today's mortality
        $mortalityToday = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->where('report_date', $today->toDateString())
            ->sum('mortality_count');

        // This month mortality
        $mortalityMonth = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereMonth('report_date', $today->month)
            ->whereYear('report_date', $today->year)
            ->sum('mortality_count');

        // Get total population for mortality percentage
        $totalPopulation = Cage::whereIn('id', $cageIds)->sum('initial_population');
        $mortalityPercent = $totalPopulation > 0 
            ? round(($mortalityMonth / $totalPopulation) * 100, 2) 
            : 0;

        // Calculate score (simple weighted formula)
        // Lower FCR is better (target < 2.0), Higher HDP/HHEP is better (target > 90%)
        $fcrScore = $avgFcr > 0 ? max(0, min(100, (2.5 - $avgFcr) * 50)) : 50;
        $hdpScore = $avgHdp;
        $hhepScore = $avgHhep;
        $mortalityScore = max(0, 100 - ($mortalityPercent * 10));
        
        $totalScore = round(($fcrScore * 0.3 + $hdpScore * 0.3 + $hhepScore * 0.3 + $mortalityScore * 0.1));

        return [
            'skor' => $totalScore,
            'status' => $this->getPerformanceStatus($totalScore),
            'fcr' => round($avgFcr, 2),
            'hdp' => round($avgHdp, 1),
            'hhep' => round($avgHhep, 1),
            'hdp' => round($avgHdp, 1),
            'hhep' => round($avgHhep, 1),
            'mortalitas' => $mortalityMonth, // Changed to Monthly Mortality as per "Reset per bulan" request
            'mortalitas_bulan' => $mortalityMonth,
            'mortalitas_persen' => $mortalityPercent,
            // Trends (compared to last week)
            'fcr_trend' => $this->getTrend($cageIds, 'fcr'),
            'hdp_trend' => $this->getTrend($cageIds, 'hdp'),
            'hhep_trend' => $this->getTrend($cageIds, 'hhep'),
        ];
    }

    /**
     * Get performance status text
     */
    private function getPerformanceStatus($score): string
    {
        if ($score >= 90) return 'Sangat Baik';
        if ($score >= 75) return 'Baik';
        if ($score >= 60) return 'Cukup';
        if ($score >= 40) return 'Kurang';
        return 'Buruk';
    }

    /**
     * Get trend compared to last week
     */
    private function getTrend($cageIds, $metric): array
    {
        $today = Carbon::today();
        $thisWeekStart = $today->copy()->startOfWeek();
        $lastWeekStart = $thisWeekStart->copy()->subWeek();
        $lastWeekEnd = $thisWeekStart->copy()->subDay();

        $thisWeekAvg = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereBetween('report_date', [$thisWeekStart->toDateString(), $today->toDateString()])
            ->avg($metric) ?: 0;

        $lastWeekAvg = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereBetween('report_date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])
            ->avg($metric) ?: 0;

        $diff = $lastWeekAvg > 0 ? round((($thisWeekAvg - $lastWeekAvg) / $lastWeekAvg) * 100, 1) : 0;

        return [
            'value' => $diff,
            'direction' => $diff > 0 ? 'up' : ($diff < 0 ? 'down' : 'stable'),
        ];
    }

    /**
     * Get chart data for FCR, Mortalitas, HDP, HHEP
     * Returns both aggregated (average) and per-cage data for all metrics
     */
    private function getChartData($cageIds, $cages)
    {
        $today = Carbon::today();
        
        // Default date range: last 7 days
        $startDate = $today->copy()->subDays(6);
        
        // Get all reports in range
        $reports = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereBetween('report_date', [$startDate->toDateString(), $today->toDateString()])
            ->orderBy('report_date')
            ->get();

        // Generate labels (dates)
        $labels = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $today) {
            $labels[] = $currentDate->format('d M');
            $currentDate->addDay();
        }

        // Initialize data structures
        $fcrAvg = [];
        $fcrPerCage = [];
        $mortalitasAvg = [];
        $mortalitasPerCage = [];
        $hdpAvg = [];
        $hdpPerCage = [];
        $hhepAvg = [];
        $hhepPerCage = [];

        // Initialize per-cage arrays
        foreach ($cages as $cage) {
            $fcrPerCage[$cage->id] = [];
            $mortalitasPerCage[$cage->id] = [];
            $hdpPerCage[$cage->id] = [];
            $hhepPerCage[$cage->id] = [];
        }

        // Process each day
        $currentDate = $startDate->copy();
        while ($currentDate <= $today) {
            $dateStr = $currentDate->toDateString();
            
            // Fix: report_date is Carbon due to casts, compare formatted string
            $dayReports = $reports->filter(function ($report) use ($dateStr) {
                return $report->report_date->format('Y-m-d') === $dateStr;
            });
            
            // Aggregated (average) data
            $fcrAvg[] = $dayReports->count() > 0 ? round($dayReports->avg('fcr'), 3) : null;
            $mortalitasAvg[] = $dayReports->sum('mortality_count');
            $hdpAvg[] = $dayReports->count() > 0 ? round($dayReports->avg('hdp'), 2) : null;
            $hhepAvg[] = $dayReports->count() > 0 ? round($dayReports->avg('hhep'), 2) : null;
            
            // Per-cage data
            foreach ($cages as $cage) {
                $report = $dayReports->where('cage_id', $cage->id)->first();
                $fcrPerCage[$cage->id][] = $report?->fcr ? round($report->fcr, 3) : null;
                $mortalitasPerCage[$cage->id][] = $report?->mortality_count ?? 0;
                $hdpPerCage[$cage->id][] = $report?->hdp ? round($report->hdp, 2) : null;
                $hhepPerCage[$cage->id][] = $report?->hhep ? round($report->hhep, 2) : null;
            }
            
            $currentDate->addDay();
        }

        return [
            'labels' => $labels,
            'fcr' => [
                'average' => $fcrAvg,
                'perCage' => $fcrPerCage,
            ],
            'mortalitas' => [
                'average' => $mortalitasAvg,
                'perCage' => $mortalitasPerCage,
            ],
            'hdp' => [
                'average' => $hdpAvg,
                'perCage' => $hdpPerCage,
            ],
            'hhep' => [
                'average' => $hhepAvg,
                'perCage' => $hhepPerCage,
            ],
        ];
    }

    /**
     * Get alerts
     */
    private function getAlerts($cageIds)
    {
        $alerts = [];
        $today = Carbon::today();

        // 1. Check for low feed stock
        $lowFeed = \App\Models\Inventory::whereHas('category', function($q) {
                $q->where('name', 'Pakan');
            })
            ->whereRaw('stock <= min_stock')
            ->get();
            
        foreach ($lowFeed as $feed) {
            $alerts[] = [
                'type' => 'danger',
                'title' => 'Stok Pakan Menipis',
                'message' => "Stok {$feed->name} sisa {$feed->stock} {$feed->unit}",
            ];
        }
        
        // 2. Check for high mortality today
        $todayMortality = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->where('report_date', $today->toDateString())
            ->sum('mortality_count');
        
        if ($todayMortality > 0) { // Any mortality is worth noting
            $alerts[] = [
                'type' => 'danger',
                'title' => 'Kematian Ayam',
                'message' => "Ada {$todayMortality} ayam mati hari ini",
            ];
        }

        // 3. Check for low FCR
        $avgFcr = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->where('report_date', $today->toDateString())
            ->avg('fcr');
        
        if ($avgFcr && $avgFcr > 2.2) { // 2.2 is usually the alert threshold
            $alerts[] = [
                'type' => 'warning',
                'title' => 'FCR Tinggi',
                'message' => 'Efisiensi pakan menurun (FCR > 2.2)',
            ];
        }

        // 4. Check for drastic production drop (HDP < 80%)
        $avgHdp = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->where('report_date', $today->toDateString())
            ->avg('hdp');

        if ($avgHdp && $avgHdp < 80) {
            $alerts[] = [
                'type' => 'warning',
                'title' => 'Produksi Turun',
                'message' => 'HDP rata-rata turun di bawah 80%',
            ];
        }

        // 5. Check if no report today (Belum ada laporan)
        $todayReportsCount = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereDate('report_date', $today)
            ->count();
            
        if ($todayReportsCount == 0) {
            $alerts[] = [
                'type' => 'info',
                'title' => 'Belum Ada Laporan',
                'message' => 'Laporan harian hari ini belum diisi',
            ];
        }

        return $alerts;
    }

    /**
     * Get daily activities summary
     */
    private function getDailyActivities($cageIds, $today, $cages)
    {
        // Use whereDate to be strictly ensuring today's data only
        $todayReports = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereDate('report_date', $today)
            ->get();

        // Calculate pending cages
        $submittedCageIds = $todayReports->pluck('cage_id')->toArray();
        $pendingCages = $cages->filter(function($cage) use ($submittedCageIds) {
            return !in_array($cage->id, $submittedCageIds);
        })->pluck('name')->toArray();

        // Limit pending text to first 2 + count
        $pendingText = empty($pendingCages) ? 'Semua selesai' : 
            (count($pendingCages) <= 2 ? implode(', ', $pendingCages) . ' pending' : count($pendingCages) . ' kandang pending');

        return [
            'pakan' => [
                'value' => round($todayReports->sum('feed_consumed')),
                'unit' => 'kg',
                'status' => $todayReports->count() > 0 ? 'completed' : 'pending',
            ],
            'telur' => [
                'value' => $todayReports->sum('eggs_produced'),
                'unit' => 'butir',
                'status' => $todayReports->count() > 0 ? 'completed' : 'pending',
            ],
            'laporan' => [
                'value' => $todayReports->count(),
                'total' => $cages->count(),
                'status' => $todayReports->count() > 0 ? 'completed' : 'pending',
                'pending_text' => $pendingText,
            ],
        ];
    }
}
