<?php

namespace App\Filament\Widgets;

use App\Models\Land;
use App\Models\Plant;
use App\Models\Category;
use App\Models\Report;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProductionSummary extends BaseWidget
{
    protected static ?string $heading = 'Ringkasan Produksi';
    protected static ?int $sort = 5;

    protected function getCards(): array
    {
        $totalLands = Land::count();
        $totalPlants = Plant::count();
        $totalCategories = Category::count();
        $totalReports = Report::count();

        return [
            Card::make('Total Lahan', $totalLands)
                ->description('Jumlah lahan yang terdaftar')
                ->icon('heroicon-o-map')
                ->color('primary'),
            Card::make('Total Tanaman', $totalPlants)
                ->description('Jumlah tanaman yang tercatat')
                ->icon('heroicon-o-sparkles')
                ->color('success'),
            Card::make('Total Kategori', $totalCategories)
                ->description('Kategori hewan/tanaman')
                ->icon('heroicon-o-archive-box')
                ->color('warning'),
            Card::make('Total Laporan', $totalReports)
                ->description('Laporan kesehatan/berat hewan')
                ->icon('heroicon-o-document-text')
                ->color('info'),
        ];
    }
} 