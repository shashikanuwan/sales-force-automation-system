<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Http\Requests\InvoiceRequest;
use App\Models\DistributorOrderProduct;
use App\Models\Order;
use APP\Services\ZipperService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ConversionController extends Controller
{
    public function index(Order $order)
    {
        return view('Order.invoice')
            ->with([
                'order' => $order,
                'distributorOrderProducts' => DistributorOrderProduct::query()
                    ->where('order_id', $order->id)
                    ->with('product')
                    ->get(),
            ]);
    }

    public function generateBulkInvoice(InvoiceRequest $request)
    {
        $ids = $request->get('ids');
        $integerIDs = array_map('intval', $ids);

        $this->StoreInvoice($integerIDs);

        $zipFilePath = "app/public/order/";

        $zipFileName = ZipperService::createZipOf($zipFilePath);

        return response()->download(storage_path($zipFilePath . $zipFileName));
    }

    private function StoreInvoice($integerIDs)
    {
        Storage::deleteDirectory('public/order');

        for ($i = 0; $i < count($integerIDs); $i++) {
            $order =  Order::query()->where('id', $integerIDs[$i])->first();

            $data = [
                'order' => $order,
                'distributorOrderProducts' => $order->distributorOrderProducts
            ];

            $pdf =  Pdf::loadView('Order.invoice', $data);

            Storage::put('/public/order/invoice/' . "{$order->number}.pdf", $pdf->download());
        }
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
