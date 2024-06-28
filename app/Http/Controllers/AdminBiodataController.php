<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Exports\BiodataExport;
use App\Imports\BiodataImport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminBiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("adminDash.biodata.index", [
            "biodatas" => DB::table('biodatas')
            ->orderBy('tglMasuk', 'asc')
            ->orderBy('name', 'asc')
            ->get()
            // "biodatas" => Biodata::all(),
        ]);
    }

    public function fileImportExport()
    {
       return view('biodata-import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        Excel::import(new BiodataImport, $request->file('file')->store('temp'));
        return back();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new BiodataExport, 'data biodata tracer study.xlsx');
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
        Biodata::destroy($id);
        return redirect('/admin/biodata')->with('success', 'Data Berhasil Dihapus');
    }
}
