<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videoMentor extends Model
{
    use HasFactory;
    protected $fillable =[
        'nama_mentor',
        'basprog',
        'judul',
        'link'
    ];
}
