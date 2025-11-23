<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\Rules\Date;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                        ->label('Nama')
                        ->required(),
                TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required(),

                DateTimePicker::make('email_verified_at')
                        ->label('Email Verified At')
                        ->default(now()),

                // TextInput::make('password')
                //         ->label('Password')
                //         ->password()
                //         ->required(),
                
                TextInput:: make('password')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord),

            ]);
    }
}
