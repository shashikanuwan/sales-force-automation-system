<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Order $order)
    {
        return view('Order.invoice')
            ->with(['order' => $order]);
    }

    public function generateInvoice(Order $order)
    {
        $data = [
            'order' => $order,
        ];

        $pdf = Pdf::loadView('Order.invoice', $data);

        return $pdf->download('fundaofwebit.pdf');
    }
}
