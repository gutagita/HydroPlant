<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table

            // Kolom yang ditampilkan pada tabel Users
            ->columns([
                // Menampilkan nama user
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                // Menampilkan email user
                TextColumn::make('email')
                    ->label('Email'),

                // Menampilkan tanggal verifikasi email
                TextColumn::make('email_verified_at')
                    ->label('Verified At')
                    ->searchable()
                    ->dateTime(),

                // Menampilkan tanggal dibuatnya akun
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])

            // Filter untuk tabel (kosong dulu)
            ->filters([
                //
            ])

            // Aksi per record, seperti Edit
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
            ])

            // Aksi toolbar yang bisa dipilih banyak (bulk actions)
            ->toolbarActions([
                BulkActionGroup::make([
                    // Hapus banyak user sekaligus
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
