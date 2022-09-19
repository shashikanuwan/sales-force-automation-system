<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\CustomerOrder;
use APP\Services\ZipperService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CustomerInvoiceController extends Controller
{
    public function generateInvoice(InvoiceRequest $request)
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
            $customerOrder =  CustomerOrder::query()->where('id', $integerIDs[$i])->first();

            $data = [
                'customerOrder' => $customerOrder,
                'customerOrderProducts' => $customerOrder->customerOrderProducts
            ];
            $pdf =  Pdf::loadView('CustomerOrder.view', $data);

            Storage::put('/public/order/invoice/' . "{$customerOrder->number}.pdf", $pdf->download());
        }
    }
}
