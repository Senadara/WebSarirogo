<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Models\Inventory;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Manajemen Inventory';
    protected static ?string $navigationGroup = 'Produksi';
    protected static ?int $navigationSort = 2;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Inventory')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('Contoh: Pakan Ayam')
                    ->autofocus(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->options(Category::all()->pluck('name_category', 'id'))
                    ->searchable()
                    ->required()
                    ->placeholder('Pilih Kategori'),
                TextInput::make('total')
                    ->label('Stok')
                    ->numeric()
                    ->minValue(0)
                    ->required()
                    ->placeholder('Masukkan jumlah stok'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Inventory')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name_category')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Stok')
                    ->sortable()
                    ->color(fn($record) => $record->total < 10 ? 'danger' : ($record->total < 50 ? 'warning' : 'success')),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->options(Category::all()->pluck('name_category', 'id')),
                TernaryFilter::make('stok_kritis')
                    ->label('Stok Kritis (< 10)')
                    ->queries(
                        true: fn($query) => $query->where('total', '<', 10),
                        false: fn($query) => $query->where('total', '>=', 10),
                    ),
            ])
            ->actions([
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square'),
                DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Tambah Inventory')
                    ->icon('heroicon-o-plus'),
            ])
            ->striped()
            ->paginated([10, 25, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
} 