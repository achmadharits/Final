<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityFacility extends Model {
    protected $fillable = [
        'city_id',
        'facility_id',
        'total',
        'status',
    ];

    public function city() {
        return $this->belongsTo('App\models\City');
    }

    public function facility() {
        return $this->belongsTo('App\models\Facility');
    }
    public function facilityworkers()
    {
        return $this->hasMany('App\models\FacilityWorker');
    }
}
