<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index(){
        $biodatas = Biodata::all();
        $koordinats = [];
        // foreach($biodatas as $biodata){
        //     $koordinat = explode(",", $biodata->koordinat);
        //     $koordinats[] = [
        //         "latitude" => $koordinat[0], 
        //         "longitude" => $koordinat[1],
        //         "nama" => $biodata->name,
        //         "foto" => $biodata->foto
        //     ];
        // }
        return view('lacak', [
            'title' => 'Lacak',
            'biodatas' => $biodatas
        ]);
    }
}
