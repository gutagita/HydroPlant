<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;


class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('name')
                     ->label('Nama Kategori')
                     ->placeholder('Masukkan nama kategori...')
                     ->required()
                     ->maxLength(100)
                     ->unique(ignoreRecord: true),

            TextInput::make('description')
                     ->label('Deskripsi Kategori')
                     ->placeholder('Masukkan deskripsi kategori...')    
                     ->maxLength(255),

            Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),  // nilai awal ON
            
            // TextInput::make('slug')
            //         ->required(),

            ]);
    }
}
