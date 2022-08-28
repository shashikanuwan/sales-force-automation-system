<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use APP\Services\InvoiceService;
use APP\Services\ZipperService;
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

    public function generateSingleInvoice(Order $order)
    {
        $pdf = InvoiceService::generateInvoice($order);
        return $pdf->download("{$order->number}.pdf");
    }

    public function generateBulkInvoice(Request $request)
    {
        $request->validate(['ids' => 'required',]);
        Storage::deleteDirectory('public/order');

        $ids = $request->get('ids');
        $integerIDs = array_map('intval', $ids);

        $this->StoreInvoice($integerIDs);

        $zipFilePath = "app/public/order/";

        $zipFileName = ZipperService::createZipOf($zipFilePath);

        return response()->download(storage_path($zipFilePath . $zipFileName));
    }

    private function StoreInvoice($integerIDs)
    {
        for ($i = 0; $i < count($integerIDs); $i++) {
            $orders =  Order::query()->where('id', $integerIDs[$i])->get();

            foreach ($orders as $key => $order) {
                $pdf = InvoiceService::generateInvoice($order);
                Storage::put('/public/order/invoice/' . "{$order->number}.pdf", $pdf->download());
            }
        }
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
