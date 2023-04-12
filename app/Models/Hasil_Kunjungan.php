<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'hasil_kunjungan';
    protected $fillable = [
        'id','nik','berat_badan','tinggi_badan','tekanan_darah','penyuluhan','dokumentasi','created_at','updated_at','created_by','updated_by'
        ];
}
