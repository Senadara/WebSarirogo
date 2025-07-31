<?php
namespace App\Filament\Resources\InventoryResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Inventory;

class InventorySummary extends \Filament\Widgets\StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Barang', Inventory::count()),
            Stat::make('Total Stok', Inventory::sum('total')),
            Stat::make('Kadaluarsa < 30 Hari', Inventory::where('expiry_date', '<=', now()->addDays(30))->count()),
        ];
    }
}
