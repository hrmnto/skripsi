<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index()
    {
        //$biodatas = Biodata::all();
        $biodatas = Biodata::with('works')->get();
        $koordinats = [];


        return view('lacak', [
            'title' => 'Lacak',
            'biodatas' => $biodatas
        ]);
    }
}
