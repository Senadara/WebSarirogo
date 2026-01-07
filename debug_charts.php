<?php

use App\Models\Cage;
use App\Models\DailyChickenReport;
use Carbon\Carbon;

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$cages = Cage::where('chicken_type', 'Layer')->get();
$cageIds = $cages->pluck('id');
$today = Carbon::today();
$startDate = $today->copy()->subDays(6);

$reports = DailyChickenReport::whereIn('cage_id', $cageIds)
            ->whereBetween('report_date', [$startDate->toDateString(), $today->toDateString()])
            ->orderBy('report_date')
            ->get();

$fcrPerCage = [];
$hdpPerCage = [];
$hhepPerCage = [];

// Initialize
foreach ($cages as $cage) {
    $fcrPerCage[$cage->id] = [];
    $hdpPerCage[$cage->id] = [];
    $hhepPerCage[$cage->id] = [];
}

$currentDate = $startDate->copy();
while ($currentDate <= $today) {
    $dateStr = $currentDate->toDateString();
    
    $dayReports = $reports->filter(function ($report) use ($dateStr) {
        return $report->report_date->format('Y-m-d') === $dateStr;
    });
    
    foreach ($cages as $cage) {
        $report = $dayReports->where('cage_id', $cage->id)->first();
        $fcrPerCage[$cage->id][] = $report?->fcr ? round($report->fcr, 3) : null;
        $hdpPerCage[$cage->id][] = $report?->hdp ? round($report->hdp, 2) : 0; // CHANGE: Use 0 if null to force line drawing? No, null is better for gaps.
        $hhepPerCage[$cage->id][] = $report?->hhep ? round($report->hhep, 2) : 0;
    }
    
    $currentDate->addDay();
}

echo "HDP Data:\n";
echo json_encode($hdpPerCage, JSON_PRETTY_PRINT);
echo "\n\nHHEP Data:\n";
echo json_encode($hhepPerCage, JSON_PRETTY_PRINT);

