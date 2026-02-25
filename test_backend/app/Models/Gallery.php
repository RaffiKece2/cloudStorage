<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'folder_id',
        'file',
        'izin',
        'nama_tampilan'
    ];
    //
}
