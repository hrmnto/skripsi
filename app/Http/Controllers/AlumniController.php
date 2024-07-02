<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("alumni.bios.index", [
            "biodatas" => Biodata::where('nim', auth()->user()->nim)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view("alumni.bios.create", compact('provinces'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file('foto')->store('img');
        $validatedData = $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'ipk' => 'required',
            'kontak' => 'required',
            'foto' => 'image|file',
            'user_id' => "required",
            'tglMasuk' => 'required',
            'tglLulus' => 'required',
            'jk' => 'required',
            'tempatLahir' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tglLahir' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'kawin' => 'required',
            'noIjazah' => 'required',
            'fotoIjazah' => 'image|file',
            'koordinat' => 'required'
        ]);

        $kelurahan = Village::where('id', $validatedData['kelurahan'])->first()->name;
        $kecamatan = District::where('id', $validatedData['kecamatan'])->first()->name;
        $kabupaten = Regency::where('id', $validatedData['kabupaten'])->first()->name;
        $provinsi = Province::where('id', $validatedData['provinsi'])->first()->name;

        $validatedData["kelurahan"] = $kelurahan;
        $validatedData["kecamatan"] = $kecamatan;
        $validatedData["kabupaten"] = $kabupaten;
        $validatedData["provinsi"] = $provinsi;


        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img');
            $file = $request->file('foto');
            $path = $file->store('public/img');
        }
        if ($request->file('fotoIjazah')) {
            $validatedData['fotoIjazah'] = $request->file('fotoIjazah')->store('ijazah');
        }
        // return $validatedData;

        Biodata::create($validatedData);
        return redirect("/alumni/bios")->with("success", "Biodata Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Biodata $biodata)
    {
        return view("alumni.bios.show", [
            'bio' => $biodata
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        $provinces = Province::all();
        return view("alumni.bios.edit", [
            'bio' => Biodata::find($nim)
        ], compact('provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nim)
    {

        $validatedData = $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'ipk' => 'required',
            'kontak' => 'required',
            'foto' => 'image|file',
            'user_id' => "required",
            'tglMasuk' => 'required',
            'tglLulus' => 'required',
            'jk' => 'required',
            'tempatLahir' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tglLahir' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'kawin' => 'required',
            'noIjazah' => 'required',
            'fotoIjazah' => 'image|file',
            'koordinat' => 'required'
        ]);

        $kelurahan = Village::where('id', $validatedData['kelurahan'])->first()->name;
        $kecamatan = District::where('id', $validatedData['kecamatan'])->first()->name;
        $kabupaten = Regency::where('id', $validatedData['kabupaten'])->first()->name;
        $provinsi = Province::where('id', $validatedData['provinsi'])->first()->name;

        $validatedData["kelurahan"] = $kelurahan;
        $validatedData["kecamatan"] = $kecamatan;
        $validatedData["kabupaten"] = $kabupaten;
        $validatedData["provinsi"] = $provinsi;

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img');
            $file = $request->file('foto');
            $path = $file->store('public/img');
        }
        if ($request->file('fotoIjazah')) {
            $validatedData['fotoIjazah'] = $request->file('fotoIjazah')->store('ijazah');
        }



        Biodata::where('nim', $nim)->update($validatedData);
        $request->session()->flash('success', 'Biodata Berhasil Diubah"');
        return redirect('/alumni/bios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}
