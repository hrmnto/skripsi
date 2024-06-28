<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'foto',
            'nim',
            'tglLulus',
            'tglMasuk',
            'jk',
            'tempatLahir',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'tglLahir',
            'agama',
            'pekerjaan',
            'kawin',
            'ipk',
            'kontak',
            'noIjazah',
            'fotoIjazah',
            'koordinat'


    ];

    protected $primaryKey = 'nim';
    protected $keyType = 'string';

    public function user(){
        return $this->hasOne(User::class);
    }

    public function works(){
        return $this->hasMany(Pekerjaan::class, "nim", "nim");
    }
}
