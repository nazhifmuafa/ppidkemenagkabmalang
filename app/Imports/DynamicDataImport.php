<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class DynamicDataImport implements ToModel
{
    protected $tableName;
    protected $columns;

    public function __construct($tableName, $columns)
    {
        $this->tableName = $tableName;
        $this->columns = $columns;
    }

    public function model(array $row)
    {
        $data = [];

        // Memasukkan data dari file Excel sesuai dengan urutan kolom di database
        foreach ($this->columns as $column) {
            $data[$column] = array_shift($row);
        }

        // Simpan data ke dalam tabel yang dipilih
        DB::table($this->tableName)->insert($data);
    }
}
