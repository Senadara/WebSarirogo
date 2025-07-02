<?php

namespace App\Filament\Widgets;

use App\Models\Inventory;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class InventoryTable extends BaseWidget
{
    protected static ?string $heading = 'Daftar Inventory';
    protected static ?int $sort = 4;

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Inventory::query())
            ->columns([
                TextColumn::make('name')->label('Nama Inventory')->searchable(),
                TextColumn::make('category.name_category')->label('Kategori')->sortable(),
                TextColumn::make('total')->label('Stok')->sortable(),
            ])
            ->defaultSort('name');
    }
} 