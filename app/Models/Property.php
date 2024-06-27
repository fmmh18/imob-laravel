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
        'state_id',
        'type_id',
        'bedroom',
        'bathroom',
        'area',
        'publish',
        'address',
        'neighborhood',
        'city_id',
        'user_id',
        'counts'
    ];


    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }


    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
