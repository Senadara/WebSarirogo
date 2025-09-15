<?php

namespace App\Filament\Resources\InventoryResource\DailyUsagesRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyUsagesRelationManager extends RelationManager
{
    protected static string $relationship = 'dailyUsages';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('quantity_used')
                ->label('Jumlah Digunakan')
                ->numeric()
                ->minValue(0.01)
                ->required(),

            Forms\Components\DatePicker::make('used_at')
                ->label('Tanggal Pemakaian')
                ->default(now())
                ->required(),

            Forms\Components\Textarea::make('notes')
                ->label('Catatan')
                ->rows(2),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Laporan Harian')
           ->columns([
                Tables\Columns\TextColumn::make('used_at')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('quantity_used')->label('Jumlah'),
                Tables\Columns\TextColumn::make('notes')->label('Catatan')->limit(30),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
