<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $grandTotal = 0;

        // Pastikan order_items ada
        if (!empty($data['order_items'])) {
            foreach ($data['order_items'] as &$item) {
                $qty   = $item['quantity'] ?? 0;
                $price = $item['price'] ?? 0;

                // Hitung total_harga tiap item
                $item['total_price'] = $qty * $price;

                // Tambahkan ke grand total
                $grandTotal += ($qty * $price);
            }
        }

        // Simpan grand_total ke database
        $data['grand_total'] = $grandTotal;

        return $data;
    }
}
