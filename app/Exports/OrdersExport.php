<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Order::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'UPurchase Order Numberser',
            'Region',
            'Territory',
            'Distributor',
            'Order Date & Time',
            'Deliver Date',
            'Delivery Status',
            'Product Name',
            'Available Quantity',
            'Order Quantity',
            'Total Amount',
        ];
    }
    /**
     * @var Order $order
     */

    public function map($order): array
    {
        return [
            $order->id,
            $order->number,
            $order->user->territory->region->name,
            $order->user->territory->name,
            $order->user->name,
            Date::dateTimeToExcel($order->created_at),
            $order->deliver_date,
            $order->status,
            $order->sku->product->name,
            $order->sku->product->quantity,
            $order->quantity,
            $order->sku->product->mrp * $order->quantity,
        ];
    }
}
