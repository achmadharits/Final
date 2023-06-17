<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function cityFacilities()
{
    return $this->hasMany(CityFacility::class);
}
public function facilityworkers()
{
    return $this->hasMany(FacilityWorker::class);
}
public function populations()
{
    return $this->hasMany(Populations::class);
}
    use HasFactory;
}
