<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Doctrine\DBAL\Driver\AbstractMySQLDriver;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        return view('superadmin.layanan.home', compact('tableNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tableName = $request->input('slug');
        $columnNames = $request->input('column_name');
        $columnTypes = $request->input('column_type');
        Schema::create($tableName, function (Blueprint $table) use ($columnNames, $columnTypes) {
            $table->id();
            
            for ($i = 0; $i < count($columnNames); $i++) {
                $columnName = $columnNames[$i];
                $columnType = $columnTypes[$i];
                $table->$columnType($columnName);
            }
            
        });

        return redirect()->route('/dashboard/layanans')->with('success', 'Tabel Berhasil Dibuat');
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

    public function showTable($table)
    {
        $columns = Schema::getColumnListing($table);
        $data = DB::table($table)->get();
        return view('superadmin.layanan.showTable', compact('data', 'table', 'columns'));
    }
    
}
