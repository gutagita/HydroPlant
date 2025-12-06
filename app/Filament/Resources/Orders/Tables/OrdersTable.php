<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('Customer')->searchable()->sortable(),

                // Grand Total
                TextColumn::make('grand_total')
                    ->label('Grand Total')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state ?? 0, 0, ',', '.'))
                    ->sortable(),

                TextColumn::make('payment_method')->label('Payment Method')->sortable(),

                BadgeColumn::make('payment_status')
                    ->label('Payment Status')
                    ->colors([
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                    ])
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'diproses' => 'info',
                        'dikirim' => 'primary',
                        'diterima' => 'success',
                        'dibatalkan' => 'danger',
                    ])
                    ->sortable(),

                TextColumn::make('shipping_method')->label('Shipping')->sortable(),
                TextColumn::make('created_at')->label('Created')->dateTime('d M Y H:i')->sortable(),
                TextColumn::make('notes')->label('Notes')->limit(40),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
