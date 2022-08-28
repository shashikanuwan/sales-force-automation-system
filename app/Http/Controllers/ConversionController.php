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

    public function generateSingleInvoice(Order $order)
    {
        $pdf = $this->generateInvoice($order);
        return $pdf->download("{$order->number}.pdf");
    }

    public function generateBulkInvoice(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ]);

        Storage::deleteDirectory('public/order');

        $ids = $request->get('ids');
        $integerIDs = array_map('intval', $ids);

        $this->StoreInvoice($integerIDs);

        $zipFileName = "order.zip";
        $zipFilePath = "app/public/order/";

        $this->ziper($zipFilePath, $zipFileName);

        return response()->download(storage_path($zipFilePath . $zipFileName));
    }

    private function generateInvoice($order)
    {
        $data = [
            'order' => $order,
        ];

        return  Pdf::loadView('Order.invoice', $data);
    }

    private function StoreInvoice($integerIDs)
    {
        for ($i = 0; $i < count($integerIDs); $i++) {
            $orders =  Order::query()->where('id', $integerIDs[$i])->get();

            foreach ($orders as $key => $order) {
            }

            $pdf = $this->generateInvoice($order);
            Storage::put('/public/order/invoice/' . "{$order->number}.pdf", $pdf->download());
        }
    }

    private function ziper($zipFilePath, $zipFileName)
    {
        $zip = new ZipArchive();

        if ($zip->open(storage_path($zipFilePath . $zipFileName), ZipArchive::CREATE) === true) {
            $fiels = File::files(storage_path('app/public/order/invoice'));

            foreach ($fiels as $key => $value) {
                $nameOfFile = basename($value);
                $zip->addFile($value, $nameOfFile);
            }
        }
        $zip->close();
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
