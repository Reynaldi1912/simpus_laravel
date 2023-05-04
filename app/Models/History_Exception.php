<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_Exception extends Model
{
    use HasFactory;
    protected $table = 'history_exception';
    protected $fillable = [
        'id','status_appr','id_user','old_date','new_date','kegiatan','keterangan'
    ];
}
