<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WorkController;

// Route::get('/alumni/works/{work}', [WorkController::class, 'show']);

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("alumni.works.index", [
            "pekerjaan" => Pekerjaan::all()
        ]);
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
    public function show($id)
    {
        return view("alumni.works.show",[
            'pekerjaan' => Pekerjaan::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        //
    }
}
