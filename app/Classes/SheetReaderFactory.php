<?php

namespace App\Classes;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xml;

class SheetReaderFactory
{
    public static function Build($file_extension): IReader|null
    {
        return match ($file_extension) {
            'xls' => new Xls(),
            'xlsx' => new Xlsx(),
            'csv' => new Csv(),
            'xml' => new Xml(),
            default => null
        };
    }
}
