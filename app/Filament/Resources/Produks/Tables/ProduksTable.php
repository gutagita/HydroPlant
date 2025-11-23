<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.0')
                    ->label('Gambar')
                    ->square()
                    ->disk('public')
                    ->size(60),

                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->color('primary'),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->placeholder('-'),

                IconColumn::make('is_featured')
                ->boolean(),
                // ->label('Active'),

                TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),         
                    ])
                
                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
