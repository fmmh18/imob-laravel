<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'value_rent',
        'value_buy',
        'type_rent',
        'type_buy',
        'city_id',
        'state_id',
        'type_id',
        'bedroom',
        'bathroom',
        'area',
        'publish',
        'address',
        'neighborhood',
        'city_id',
        'state_id'
    ];


    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}
