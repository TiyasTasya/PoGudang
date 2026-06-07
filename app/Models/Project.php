<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'kode_project',
        'nama_project',
        'alamat',
    ];
}
