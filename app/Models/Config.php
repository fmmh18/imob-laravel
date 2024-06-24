<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'about',
        'logo',
        'logo_small',
        'logo_dark',
        'logo_small_dark',
        'address',
        'phone',
        'email',
        'facebook',
        'whatsapp',
        'linkedin',
        'instagram'
    ];
}
