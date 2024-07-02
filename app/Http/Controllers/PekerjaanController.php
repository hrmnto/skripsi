<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Pekerjaan;
use Illuminate\Routing\Controller;
use App\Http\Requests\StorePekerjaanRequest;
use App\Http\Requests\UpdatePekerjaanRequest;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("alumni.works.index", [
            "pekerjaan" => Pekerjaan::where('nim', auth()->user()->nim)->get(),
            "biodata" => Biodata::where('nim', auth()->user()->nim)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view("alumni.works.create", compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePekerjaanRequest $request)
    {


        $validatedData = $request->validate([
            'nim' => 'required',
            'nama_pekerjaan' => "required",
            'tempat_pekerjaan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'koordinat' => 'required',
            'tanggal_pekerjaan' => 'required',
            'gaji' => 'required',
            'kategori_pekerjaan1' => 'nullable',
            'kategori_pekerjaan2' => 'nullable',
            'kategori_pekerjaan3' => 'nullable',
            'relevansi_pekerjaan' => 'required'
        ]);

        $kelurahan = Village::where('id', $validatedData['kelurahan'])->first()->name;
        $kecamatan = District::where('id', $validatedData['kecamatan'])->first()->name;
        $kabupaten = Regency::where('id', $validatedData['kabupaten'])->first()->name;
        $provinsi = Province::where('id', $validatedData['provinsi'])->first()->name;

        $validatedData["kelurahan"] = $kelurahan;
        $validatedData["kecamatan"] = $kecamatan;
        $validatedData["kabupaten"] = $kabupaten;
        $validatedData["provinsi"] = $provinsi;
        // return $validatedData;

        Pekerjaan::create($validatedData);
        return redirect("/alumni/works")->with("success", "Pekerjaan Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provinces = Province::all();
        return view("alumni.works.edit", [
            'pekerjaan' => Pekerjaan::find($id)
        ], compact('provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePekerjaanRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required',
            'kategori_pekerjaan1' => 'nullable',
            'kategori_pekerjaan2' => 'nullable',
            'kategori_pekerjaan3' => 'nullable',
            'nama_pekerjaan' => "required",
            'tempat_pekerjaan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'koordinat' => 'required',
            'tanggal_pekerjaan' => 'required',
            'gaji' => 'required',
            'relevansi_pekerjaan' => 'required'
        ]);

        $kelurahan = Village::where('id', $validatedData['kelurahan'])->first()->name;
        $kecamatan = District::where('id', $validatedData['kecamatan'])->first()->name;
        $kabupaten = Regency::where('id', $validatedData['kabupaten'])->first()->name;
        $provinsi = Province::where('id', $validatedData['provinsi'])->first()->name;

        $validatedData["kelurahan"] = $kelurahan;
        $validatedData["kecamatan"] = $kecamatan;
        $validatedData["kabupaten"] = $kabupaten;
        $validatedData["provinsi"] = $provinsi;

        // return $validatedData;

        Pekerjaan::where("id", $id)->update($validatedData);
        return redirect("/alumni/works")->with("success", "Pekerjaan Berhasil Diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pekerjaan::destroy($id);
        return redirect('/alumni/works')->with('success', 'Data Berhasil Dihapus');
    }
}
