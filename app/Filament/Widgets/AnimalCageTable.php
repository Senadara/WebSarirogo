<?php

namespace App\Filament\Widgets;

use App\Models\Cage;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class AnimalCageTable extends BaseWidget
{
    protected static string $view = 'filament.widgets.animal-cage-table';
    protected static ?string $heading = 'Detail Kandang & Hewan';
    protected static ?int $sort = 2;

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Cage::query())
            ->columns([
                TextColumn::make('cage_name')->label('Nama Kandang')->searchable(),
                TextColumn::make('cage_category')->label('Kategori'),
                TextColumn::make('location')->label('Lokasi'),
                TextColumn::make('total_life')->label('Hewan Hidup')->sortable(),
                TextColumn::make('total_dead')->label('Hewan Mati')->sortable(),
            ])
            ->defaultSort('cage_name');
    }
} 