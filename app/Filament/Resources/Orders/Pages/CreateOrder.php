<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $grandTotal = 0;

        if (!empty($data['order_items'])) {
            foreach ($data['order_items'] as $item) {
                $qty = $item['quantity'] ?? 0;
                $price = $item['price'] ?? 0;
                $grandTotal += ($qty * $price);
            }
        }

        $data['grand_total'] = $grandTotal;

        return $data;
    }
}
