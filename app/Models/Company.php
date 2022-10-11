<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_name',
        'ruc',
        'phone',
        'movile',
        'email',
        'country',
        'state',
        'city',
        'street',
        'postal_code',
        'entry',
        'description',
        'photo'
    ];
}
