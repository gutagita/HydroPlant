<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    // Tempat menyimpan item yang sudah dimutasi
    protected array $pendingOrderItems = [];

protected function mutateFormDataBeforeCreate(array $data): array
{
    if (! empty($data['orderItems']) && is_array($data['orderItems'])) {
        foreach ($data['orderItems'] as $index => $item) {
            // Ambil dari unit_amount jika ada, kalau tidak fallback ke price
            $price = $item['unit_amount'] ?? $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 1;
            $total = $item['total_amount'] ?? ($price * $quantity);

            $data['orderItems'][$index]['price'] = $price;
            $data['orderItems'][$index]['total'] = $total;

            // Hapus nama field UI agar tidak menyebabkan kebingungan
            unset($data['orderItems'][$index]['unit_amount'], $data['orderItems'][$index]['total_amount']);
        }
    }

    // Hitung grand total dari items + shipping_amount
    $itemsTotal = array_sum(array_map(fn($it) => floatval($it['total'] ?? 0), $data['orderItems'] ?? []));
    $shipping = floatval($data['shipping_amount'] ?? 0);
    $data['grand_total'] = $itemsTotal + $shipping;

    // Tulis kembali ke Livewire form state sehingga saveRelationships() menggunakan nilai ini
    $this->form->rawState($data);

    return $data;
}

    /**
     * Override handleRecordCreation supaya kita bisa membuat order_items
     * secara manual dari $this->pendingOrderItems setelah order dibuat.
     *
     * @param  array<string,mixed>  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        // Buat order seperti biasa
        $record = parent::handleRecordCreation($data);

        // Jika ada pending items, buatkan manual
        if (!empty($this->pendingOrderItems)) {
            $items = array_map(function ($item) {
                return [
                    'product_id' => $item['product_id'] ?? null,
                    'quantity'   => $item['quantity'] ?? 0,
                    'price'      => $item['price'] ?? 0,
                    'total'      => $item['total'] ?? 0,
                ];
            }, $this->pendingOrderItems);

            // Gunakan createMany untuk efisiensi
            $record->orderItems()->createMany($items);

            // Kosongkan pending setelah dibuat
            $this->pendingOrderItems = [];
        }

        return $record;
    }
}