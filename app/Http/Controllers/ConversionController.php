<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use APP\Services\Zipper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ConversionController extends Controller
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
        return $pdf->download('invoice.pdf');
    }

    public function generateBulkInvoice(Request $request)
    {
        $ids = $request->get('ids');

        Storage::deleteDirectory('public/order');

        $integerIDs = array_map('intval', $ids);

        for ($i = 0; $i < count($integerIDs); $i++) {
            $orders =  Order::query()->where('id', $integerIDs[$i])->get();

            foreach ($orders as $key => $order) {
            }

            $data = [
                'order' => $order,
            ];

            $pdf = Pdf::loadView('Order.invoice', $data);

            Storage::put('/public/order/invoice/' . "$order->number.pdf", $pdf->download());
        }

        $zipFileName = Zipper::createZipOf();

        return response()->download(storage_path('app/public/order/' . $zipFileName));
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
