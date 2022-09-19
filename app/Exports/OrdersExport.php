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
            'Purchase Order Numberser',
            'distributor Name',
            'distributor Territory',
            'Order Date & Time',
            'Deliver Date',
            'Delivery Status',
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
            $order->user->name,
            $order->user->territory->name,
            Date::dateTimeToExcel($order->created_at),
            $order->deliver_date,
            $order->status,
            $order->totalPrice,
        ];
    }
}
