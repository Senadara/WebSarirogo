<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\DailyUsagesRelationManagerResource\RelationManagers\DailyUsagesRelationManager;
use App\Filament\Resources\InventoryResource\Pages;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Components\{TextInput, Textarea, BelongsToSelect, Select};
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn, BadgeColumn};
use Livewire\Features\SupportFormObjects\Form as SupportFormObjectsForm;

use Filament\Forms\Components\Concerns\CanBeAutocompleted;
use App\Models\Category;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Inventory';
    protected static ?string $pluralModelLabel = 'Inventories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                TextInput::make('total')
                    ->label('Jumlah')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

                BelongsToSelect::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name_category')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name_category')
                            ->label('Nama Kategori')
                            ->required(),

                        Select::make('unit')
                            ->label('Satuan')
                            ->options([
                                'buah' => 'buah',
                                'cc' => 'cc',
                                'cm' => 'cm',
                                'dm' => 'dm',
                                'dus' => 'dus',
                                'gram' => 'gram',
                                'inch' => 'inch',
                                'kaleng' => 'kaleng',
                                'kantong' => 'kantong',
                                'karung' => 'karung',
                                'kg' => 'kilogram',
                                'km' => 'km',
                                'kotak' => 'kotak',
                                'kuintal' => 'kuintal',
                                'lembar' => 'lembar',
                                'liter' => 'liter',
                                'lusin' => 'lusin',
                                'meter' => 'meter',
                                'mililiter' => 'mililiter',
                                'mm' => 'mm',
                                'ons' => 'ons',
                                'pack' => 'pack',
                                'paket' => 'paket',
                                'papan' => 'papan',
                                'pcs' => 'pcs',
                                'rim' => 'rim',
                                'rol' => 'rol',
                                'sachet' => 'sachet',
                                'set' => 'set',
                                'slop' => 'slop',
                                'ton' => 'ton',
                                'unit' => 'unit',
                            ])
                            ->searchable() // 🔍 memungkinkan pencarian
                            ->required(),

                        TextInput::make('price')
                            ->label('Harga Satuan')
                            ->required()
                            ->numeric(),
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('expiry_date')
                    ->label('Tanggal Kadaluarsa')
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('category.name_category')->label('Kategori')->searchable()->sortable(),
                TextColumn::make('total')->label('Jumlah'),
                TextColumn::make('category.unit')->label('Satuan'),
                TextColumn::make('expiry_date')->label('Kadaluarsa')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\InventoryResource\Widgets\InventorySummary::class,
        ];
    }

    public static function getRelationManagers(): array
    {
        return [
            DailyUsagesRelationManager::class,
        ];
    }
}
