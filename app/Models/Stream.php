<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stream extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 'code_id', 'mentor_id', 'name', 'category', 'link', 'thumbnail'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($stream) {
            $stream->number = Stream::getNextNumber();
        });

        static::creating(function ($model) {
            $category = $model->attributes['category'];
            $category = strtoupper($category);

            $name = $model->attributes['name'];
            $name = strtoupper($name);


            if ($category === 'JAVA') {
                $model->attributes['code_id'] = 'JV';
            } elseif ($category === 'PYTHON') {
                $model->attributes['code_id'] = 'PY';
            } elseif ($category === 'JAVASCRIPT') {
                $model->attributes['code_id'] = 'JS';
            } elseif ($category === 'C#') {
                $model->attributes['code_id'] = 'CC';
            } elseif ($category === 'PHP') {
                $model->attributes['code_id'] = 'PHP';
            } elseif ($category === 'HTML') {
                $model->attributes['code_id'] = 'HTML';
            } elseif ($category === 'CSS') {
                $model->attributes['code_id'] = 'CSS';
            } elseif ($category === 'KOTLIN') {
                $model->attributes['code_id'] = 'KOTLIN';
            } elseif ($category === 'DART') {
                $model->attributes['code_id'] = 'DART';
            } elseif ($category === 'GO') {
                $model->attributes['code_id'] = 'GO';
            } else {
                $model->attributes['code_id'] = null;
            }


            if ($name === 'PROGRAMMER ZAMAN NOW') {
                $model->attributes['code_id'] .= 'PZN';
            } elseif ($name === 'KELAS TERBUKA') {
                $model->attributes['code_id'] .= 'KT';
            } elseif ($name === 'WEB PROGRAMMING UNPAS') {
                $model->attributes['code_id'] .= 'WPU';
            } elseif ($name === 'JAGAT KODING') {
                $model->attributes['code_id'] .= 'JK';
            } elseif ($name === 'FREE CODE CAMP') {
                $model->attributes['code_id'] .= 'FCC';
            }


            $lastStream = Stream::where([
                ['name', '=', $model->attributes['name']],
                ['category', '=', $model->attributes['category']]
            ])->orderByDesc('code_id')->first();

            if ($lastStream) {
                $codeId = $lastStream->code_id;
                $lastCodeId = intval(substr($codeId, -2)); // Mengambil dua angka terakhir dari kode_id
                if ($lastCodeId >= 9) {
                    $newCodeId = str_pad(($lastCodeId + 1), 2, '0', STR_PAD_LEFT); // Menambahkan 1 dan menggunakan str_pad untuk menambahkan angka 0 di depan
                } else {
                    $newCodeId = '0' . ($lastCodeId + 1); // Menambahkan 0 di depan jika angka kurang dari 10
                }
                $model->code_id = $model->attributes['code_id'] . $newCodeId; // Menyusun kode_id baru
            } else {
                $model->code_id = $model->attributes['code_id'] . '01'; // Mengatur kode_id awal
            }









        });
    }


    public static function getNextNumber()
    {
        $lastStream = Stream::orderByDesc('number')->first();

        if ($lastStream) {
            return $lastStream->number + 1;
        } else {
            return 1;
        }
    }

}
