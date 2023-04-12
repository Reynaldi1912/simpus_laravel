<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = [
        'nik','nama','jml_anggota_keluarga','tgl_lahir','umur','alamat','no_hp','bpjs','created_at','updated_at','created_by','updated_by'
        ];
}
