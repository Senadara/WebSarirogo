<?php

namespace App\Filament\Widgets;

use App\Models\Cage;
use App\Models\Animal;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CageOverview extends BaseWidget
{
    protected static ?string $heading = 'Ringkasan Kandang';
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $totalCages = Cage::count();
        $totalLife = Cage::sum('total_life');
        $totalDead = Cage::sum('total_dead');
        $topCategory = Cage::selectRaw('cage_category, COUNT(*) as total')
            ->groupBy('cage_category')
            ->orderByDesc('total')
            ->first();
        $topCategoryName = $topCategory ? $topCategory->cage_category : '-';
        $topCategoryCount = $topCategory ? $topCategory->total : 0;

        return [
            Card::make('Total Kandang', $totalCages)
                ->description('Jumlah seluruh kandang yang terdaftar')
                ->icon('heroicon-o-home-modern')
                ->color('primary'),
            Card::make('Total Hewan Hidup', $totalLife)
                ->description('Jumlah total hewan hidup di semua kandang')
                ->icon('heroicon-o-heart')
                ->color('success'),
            Card::make('Total Hewan Mati', $totalDead)
                ->description('Jumlah total hewan mati di semua kandang')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('danger'),
            Card::make('Kategori Kandang Terbanyak', $topCategoryName)
                ->description("Kategori dengan jumlah kandang terbanyak: $topCategoryCount kandang")
                ->icon('heroicon-o-tag')
                ->color('warning'),
        ];
    }
} 