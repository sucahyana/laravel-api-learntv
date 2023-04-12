<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'number'

    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($mentor) {
            $mentor->number = Mentor::getNextNumber();
        });
    }

    public static function getNextNumber()
    {
        $lastMentor = Mentor::orderByDesc('number')->first();

        if ($lastMentor) {
            return $lastMentor->number + 1;
        } else {
            return 1;
        }
    }
}
