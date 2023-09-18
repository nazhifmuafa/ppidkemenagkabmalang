<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\DynamicTable;
use Illuminate\Database\Schema\Blueprint;
use Doctrine\DBAL\Driver\AbstractMySQLDriver;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dynamicTables = DynamicTable::all();
        $dynamicTableCategories = $dynamicTables->groupBy('category');

        return view('admin.services.home', ['dynamicTableCategories' => $dynamicTableCategories]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function showTable($table)
    {
        $columns = Schema::getColumnListing($table);
        $data = DB::table($table)->get();

        $dynamicTable = DynamicTable::where('slug', $table)->first();

        return view('admin.services.showTable', compact('data', 'table', 'columns', 'dynamicTable'));
    }

    public function delete(Request $request, $table, $id)
    {
        $dynamicTable = DynamicTable::where('slug', $table)->first();

        // Hapus data berdasarkan ID
        DB::table($table)->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
