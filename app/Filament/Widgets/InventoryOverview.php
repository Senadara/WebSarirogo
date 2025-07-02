<?php

namespace App\Filament\Widgets;

use App\Models\Inventory;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class InventoryOverview extends BaseWidget
{
    protected static ?string $heading = 'Ringkasan Inventory';
    protected static ?int $sort = 3;

    protected function getCards(): array
    {
        $totalInventory = Inventory::count();
        $minStock = Inventory::orderBy('total')->first();
        $maxStock = Inventory::orderByDesc('total')->first();
        $topCategory = Category::withCount('inventories')->orderByDesc('inventories_count')->first();

        return [
            Card::make('Total Item Inventory', $totalInventory)
                ->description('Jumlah seluruh item inventory yang terdaftar')
                ->icon('heroicon-o-archive-box')
                ->color('primary'),
            Card::make('Stok Minimum', $minStock ? $minStock->name . ' (' . $minStock->total . ')' : '-')
                ->description('Item dengan stok terendah')
                ->icon('heroicon-o-arrow-down')
                ->color('danger'),
            Card::make('Stok Maksimum', $maxStock ? $maxStock->name . ' (' . $maxStock->total . ')' : '-')
                ->description('Item dengan stok tertinggi')
                ->icon('heroicon-o-arrow-up')
                ->color('success'),
            Card::make('Kategori Inventory Terbanyak', $topCategory ? $topCategory->name_category : '-')
                ->description($topCategory ? 'Kategori dengan jumlah item terbanyak: ' . $topCategory->inventories_count . ' item' : '-')
                ->icon('heroicon-o-tag')
                ->color('warning'),
        ];
    }
} 