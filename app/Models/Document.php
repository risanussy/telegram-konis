<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{   
    use HasFactory;

    protected $fillable = [
        'dari', 'kepada', 'klasifikasi', 'no_telegram', 'twu', 'perihal', 'file_path', 'status'
    ];
}
