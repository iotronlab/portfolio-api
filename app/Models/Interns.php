<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Interns extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
        'uid',
        'email',
        'start_date',
        'end_date',
        'duration',
        'projects',
        'technology',
        'qr_path'
    ];
}
