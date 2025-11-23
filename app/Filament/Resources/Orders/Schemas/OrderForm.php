<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Repeater;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([
                Section::make('Informasi Pesanan')
                    ->columns(1)
                    ->columnSpan('full')
                    ->schema([
                        Select::make('user_id')
                            ->label('Pengguna')
                            ->relationship('user', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'cod' => 'Bayar di Tempat',
                                'qris' => 'QRIS',
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Menunggu',
                                'paid' => 'Lunas',
                                'failed' => 'Gagal',
                            ])
                            ->required(),

                        ToggleButtons::make('status')
                            ->label('Status Pesanan')
                            ->inline()
                            ->options([
                                'diproses' => 'Diproses',
                                // 'dikirim' => 'Dikirim',
                                'diterima' => 'Diterima',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->colors([
                                'diproses' => 'info',
                                // 'dikirim' => 'primary',
                                'diterima' => 'success',
                                'dibatalkan' => 'danger',
                            ])
                            ->default('diproses')
                            ->required(),

                        TextInput::make('currency')
                            ->label('Mata Uang')
                            ->default('IDR')
                            ->required(),

                        TextInput::make('shipping_amount')
                            ->label('Biaya Pengiriman')
                            ->default(10000)
                            ->numeric(),

                        Select::make('shipping_method')
                            ->label('Metode Pengiriman')
                            ->options([
                                'jne' => 'JNE',
                                'tiki' => 'TIKI',
                                'pos' => 'POS Indonesia',
                            ]),

                        Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(3),
                    ])->columnSpanFull(),

                Section::make('Item Pesanan')
                    ->columns(1)
                    ->columnSpan('full')
                    ->schema([
                        Repeater::make('orderItems')
                            ->relationship()
                            ->columns(1)
                            ->columnSpanFull()
                            ->minItems(1)
                            ->schema([
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->relationship('product', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, $set) => $set('unit_amount', \App\Models\Product::find($state)?->price ?? 0))
                                    ->afterStateUpdated(fn ($state, $set) => $set('total_amount', \App\Models\Product::find($state)?->price ?? 0))
                                    ->required(),

                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, $get, $set) => $set('total_amount', $state * $get('unit_amount')))
                                    ->required(),

                                TextInput::make('unit_amount')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->required(),

                                TextInput::make('total_amount')
                                    ->label('Total Harga')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->required(),

                                Hidden::make('grand_total')
                                    ->default(0),
                            ])->columns(4),

                        // Placeholder grand total di luar repeater
                       Placeholder::make('grand_total')
                                ->label('Grand Total')
                                ->content(fn ($get) => 'Rp ' . number_format(
                                ($shipping = $get('shipping_amount') ?? 0) +
                                array_sum(array_column($get('orderItems') ?? [], 'total_amount')),
                                 0, ',', '.'
                                  )),
                        

                        

                    ])->columnSpanFull(),
            ])->columnSpanFull(),

            
        ]);
    }
}
