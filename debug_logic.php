<?php

use App\Models\Cage;
use App\Models\DailyChickenReport;
use Carbon\Carbon;

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$today = Carbon::today();
$monthStart = $today->copy()->startOfMonth();
$weekStart = $today->copy()->startOfWeek();

echo "Today: " . $today->toDateString() . "\n";
echo "Month Start: " . $monthStart->toDateString() . "\n";
echo "Week Start: " . $weekStart->toDateString() . "\n";

$reports = DailyChickenReport::whereBetween('report_date', [$monthStart->toDateString(), $today->toDateString()])->count();
echo "Reports this month: " . $reports . "\n";

$dailyActivity = DailyChickenReport::whereDate('report_date', $today)->count();
echo "Reports today (Strict Date): " . $dailyActivity . "\n";
