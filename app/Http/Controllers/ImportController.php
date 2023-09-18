<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\DynamicDataImport;
use Illuminate\Support\Facades\Validator; // Tambahkan Validator


class ImportController extends Controller
{
    public function index(){
        return view('admin.services.import');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_name' => 'required|string',
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tableName = $request->input('table_name');
        $file = $request->file('file');

        // Validasi bahwa nama tabel yang dimasukkan oleh pengguna ada dalam database
        if (!DB::getSchemaBuilder()->hasTable($tableName)) {
            return redirect()->back()->with('error', 'Tabel tidak ditemukan.');
        }

        // Ambil struktur kolom dari tabel yang dipilih
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // Import data dari file Excel ke tabel yang dipilih dengan struktur kolom yang sesuai
        try {
            Excel::import(new DynamicDataImport($tableName, $columns), $file);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data. Pastikan file Excel sesuai dengan struktur yang benar.');
        }

        return redirect()->back()->with('success', 'Data berhasil diimpor ke tabel ' . $tableName);
    }

    
}
