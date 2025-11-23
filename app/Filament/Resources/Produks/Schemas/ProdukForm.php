<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            FileUpload::make('images')
                ->label('Gambar')
                ->image()
                ->multiple()
                ->disk('public')
                ->directory('products')
                ->reorderable()
                ->maxFiles(5)
                ->required(),

            TextInput::make('name')
                ->label('Nama Produk')
                ->required(),
            
            Textarea::make('description')
                ->label('Deskripsi')
                ->required(),

            TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->required(),

            TextInput::make('stock')
                ->label('Stok')
                ->numeric()
                ->required(),

            Select::make('category_id')
                ->label('Kategori')
                ->relationship('category', 'name')
                ->required(),

            Toggle::make('is_featured')
                ->label('Produk Unggulan'),
        ])->columns(3);
    }
}
