<?php

namespace APP\Services;

use Illuminate\Support\Facades\File;

use ZipArchive;

class ZipperService
{
    public static function createZipOf()
    {
        $zipFileName = "order.zip";
        $zip = new ZipArchive();

        if ($zip->open(storage_path('app/public/order/' . $zipFileName), ZipArchive::CREATE) === true) {
            $fiels = File::files(storage_path('app/public/order/invoice'));

            foreach ($fiels as $key => $value) {
                $nameOfFile = basename($value);
                $zip->addFile($value, $nameOfFile);
            }
        }
        $zip->close();

        return $zipFileName;
    }
}
