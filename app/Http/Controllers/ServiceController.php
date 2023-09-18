<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dynamicTables = DynamicTable::all();
        $dynamicTableCategories = $dynamicTables->groupBy('category');

        return view('superadmin.services.home', ['dynamicTableCategories' => $dynamicTableCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = ['Pendma', 'Haji', 'Sekjen', 'Pontren', 'PAI', 'Bimas', 'Syariah', 'Katolik', 'Buddha', 'Kristen', 'Hindu'];

        return view('superadmin.services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required',
            'tableName' => 'required',
            'slug' => 'required|unique:dynamic_tables,slug',
            'column_name' => 'required|array',
            'column_name.*' => 'required|string',
            'column_type' => 'required|array',
            'column_type.*' => 'required|string|in:string,integer,text,date',
        ]);

        
        // Create the table
        Schema::create($data['slug'], function (Blueprint $table) use ($data) {
            $table->id();
            
            foreach ($data['column_name'] as $index => $columnName) {
                $columnType = $data['column_type'][$index];
                $table->$columnType($columnName)->nullable();
            }
        });
        
        // Save table data to DynamicTable model
        DynamicTable::create([
            'category' => $data['kategori'],
            'name' => $data['tableName'],
            'slug' => $data['slug'],
        ]);

        return redirect('/dashboard/services')->with('success', 'Tabel Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showTable($service)
    {
        $columns = Schema::getColumnListing($service);
        $data = DB::table($service)->get();

        $dynamicTable = DynamicTable::where('slug', $service)->first();

        // Cek apakah file template dengan nama yang sama sudah ada
        $templateStatus = Storage::disk('templates')->exists(Str::slug($service) . '_template.xlsx');

        return view('superadmin.services.showTable', compact('data', 'service', 'columns', 'dynamicTable', 'templateStatus'));
    }

    public function deleteTable($tableName)
    {
        // Hapus tabel
        Schema::dropIfExists($tableName);

        // Hapus entri pada Dynamic_table
        DynamicTable::where('slug', $tableName)->delete();

        return redirect('/dashboard/services')->with('success', 'Tabel Berhasil Dihapus');
    }
    
    // public function downloadTemplate($slug)
    // {
    //     // Dapatkan data tabel berdasarkan slug
    //     $table = DynamicTable::where('slug', $slug)->firstOrFail();

    //     // Tentukan nama file template
    //     $fileName = $table->slug . '_template.xlsx';

    //     // Path menuju file template dalam storage
    //     $filePath = storage_path('app/templates/' . $fileName);

    //     // Periksa apakah file template ada
    //     if (!Storage::exists('templates/' . $fileName)) {
    //         return redirect()->back()->with('error', 'File template tidak tersedia.');
    //     }

    //     // Unduh file template
    //     return Response::download($filePath, $fileName);
    // }

    public function uploadExcelTemplate(Request $request)
    {
        // Validasi file Excel template
        $request->validate([
            'excel_template' => 'required|mimes:xlsx'
        ]);

        // Mendapatkan data tabel dari slug
        $tableSlug = $request->input('slug');
        $dynamicTable = DynamicTable::where('slug', $tableSlug)->firstOrFail();

        // Menyusun nama file baru dengan format slug + _template.xlsx
        $newFileName = Str::slug($tableSlug) . '_template.xlsx';

        // Cek apakah file template dengan nama yang sama sudah ada
        if (Storage::disk('templates')->exists($newFileName)) {
            // Jika ada, hapus file template lama
            Storage::disk('templates')->delete($newFileName);
        }

        // Simpan file Excel template ke dalam storage/app/templates dengan nama baru
        $templatePath = $request->file('excel_template')->storeAs('templates', $newFileName);

        return redirect()->back()->with('success', 'File Excel template berhasil diunggah.');
    }

    public function downloadUploadedTemplate($slug)
    {
        $fileName = Str::slug($slug) . '_template.xlsx';

        // Path menuju file template dalam storage
        $filePath = storage_path('app/templates/' . $fileName);

        // Periksa apakah file template ada
        if (!Storage::exists('templates/' . $fileName)) {
            return redirect()->back()->with('error', 'File template tidak tersedia.');
        }

        // Unduh file template
        return Response::download($filePath, $fileName);
    }

    public function deleteTemplate($slug)
    {
        // Mendapatkan nama file template yang akan dihapus
        $fileName = Str::slug($slug) . '_template.xlsx';

        // Hapus file template jika ada
        if (Storage::disk('templates')->exists($fileName)) {
            Storage::disk('templates')->delete($fileName);
            return redirect()->back()->with('success', 'File Excel template berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'File Excel template tidak ditemukan.');
    }


}
