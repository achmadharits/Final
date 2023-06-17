<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public function worker()
    {
        return $this->hasMany(FacilityWorker::class);
    }
    
    use HasFactory;
}
