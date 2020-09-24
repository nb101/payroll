<?php

namespace App\Contracts;

/**
 *| File Exporter Interface
 * Should be implemented by any concrete classes that export array data to a file in tabular form
 * @param array $data
 * @param array $headers
 * @param array $file_path
 */

interface FileExporter
{
    public function outputFile(array $data, array $headers, string $file_path)  : string ;
}
