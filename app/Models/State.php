<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable   = ['name', 'initials', 'status', 'cd_ibge', 'countries_id', 'created_at', 'updated_at'];
}
