<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\{TextInput, Textarea, BelongsToSelect, Select};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, BadgeColumn};
use Livewire\Features\SupportFormObjects\Form as SupportFormObjectsForm;

class CategoryResource extends Resource
{
    protected static ?string $model       = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_category')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_category')->label('Nama Kategori')->sortable()->searchable(),
                TextColumn::make('unit')->label('Satuan'),
                TextColumn::make('price')->label('Harga')->money('idr', true),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListCategories::route('/'),
            'create'  => Pages\CreateCategory::route('/create'),
            'edit'    => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
