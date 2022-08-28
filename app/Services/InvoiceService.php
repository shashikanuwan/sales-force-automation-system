<?php

namespace APP\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{
    public static function generateInvoice($order)
    {
        $data = ['order' => $order];

        return  Pdf::loadView('Order.invoice', $data);
    }
}
