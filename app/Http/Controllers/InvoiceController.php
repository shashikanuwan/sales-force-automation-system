<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index(Order $order)
    {
        return view('Order.invoice')
            ->with(['order' => $order]);
    }

    public function generateInvoice(Order $order)
    {
        $name = Str::random(5);

        $data = [
            'order' => $order,
        ];
        $pdf = Pdf::loadView('Order.invoice', $data);

        return $pdf->download("$name.pdf");
    }
}
