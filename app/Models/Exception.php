<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    use HasFactory;
    protected $table = 'exception';
    protected $fillable = [
        'id','id_jadwal','id_user','alasan','status_appr',
    ];

}
