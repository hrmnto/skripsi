<?php

namespace App\Models;

use App\Models\Biodata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function biodata(){
        return $this->belongsTo(Biodata::class, "nim", "nim");
    }
}
