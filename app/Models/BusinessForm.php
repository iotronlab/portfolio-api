<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'business_name',
        'business_link',
        'contact',
        'service',
        'budget',
        'details'
    ];
}
