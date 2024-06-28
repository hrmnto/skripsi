<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        return view("search", [
            "title" => "Cari Alumni",
            "keyword" => $keyword,
            "pekerjaan" => Pekerjaan::all(),
            "biodatas" => Biodata::where('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('nim', 'LIKE', ''.$keyword.'%')
            ->get()
        ]);
    }
}
