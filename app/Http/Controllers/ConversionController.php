<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

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

        $zipFileName = "order.zip";

        $zip = new ZipArchive();

        if ($zip->open(storage_path('app/public/order/' . $zipFileName), ZipArchive::CREATE) === true) {
            $fiels = File::files(storage_path('app/public/order/invoice'));

            foreach ($fiels as $key => $value) {
                $nameOfFile = basename($value);
                $zip->addFile($value, $nameOfFile);
            }
            $zip->close();
        }

        return response()->download(storage_path('app/public/order/' . $zipFileName));
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
