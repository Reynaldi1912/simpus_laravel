<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = [
        'id','upaya_kesehatan','kegiatan','tanggal_mulai','rincian_pelaksanaan','id_desa','nama_pelaksana1','nama_pelaksana2','created_date','updated_date','status'
    ];
}
