<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function cityfacilities()
{
    return $this->hasMany(CityFacility::class);
}
public function facilityworkers()
{
    return $this->hasMany(FacilityWorker::class);
}
    use HasFactory;
}
