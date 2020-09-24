<?php

namespace App\Helpers;
use App\Contracts\FileExporter;
/*
|--------------------------------------------------------------------------
| CsvExporter
|--------------------------------------------------------------------------
| Outputs a csv file to storage when data received in array
*/

class CsvExporter implements FileExporter
{
    /**
     * Outputs a csv file to storage when data received in array
     * @param array $data
     * @param array $headers
     * @param string $file_name
     * @return string
     */
    public function outputFile(array $data,array $headers, string $file_name) : string
    {
        $FH = fopen(storage_path($file_name), 'w');
        fputcsv($FH, $headers);
        foreach ($data as $row) {
            fputcsv($FH, $row);
        }
        fclose($FH);

        return storage_path($file_name);
    }
}
