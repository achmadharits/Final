<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class FacilityWorker extends Model
{
    use HasFactory;

    protected $fillable = [
        'cityfacility_id',
        'worker_id',
        'total',
        'status',
    ];

    protected $appends = [
        'city_name',
        'facility_name',
    ];

    public function cityfacility()
    {
        return $this->belongsTo(CityFacility::class, 'city_facility_id', 'id');
    }

    public function city()
    {
        return $this->cityfacility->city;
    }

    public function facility()
    {
        return $this->cityfacility->facility;
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    public function getCityNameAttribute()
    {
        return $this->city()->name;
    }

    
    public function getFacilityNameAttribute()
    {
        return $this->facility()->name;
    }

}