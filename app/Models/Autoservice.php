<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autoservice extends Model
{
    use HasFactory;

    public function autoserviceMechanics()
    {
        return $this->hasMany(Mechanic::class, 'autoservice_id', 'id');
    }

    public function autoserviceServices()
    {
        return $this->hasMany(Service::class, 'autoservice_id', 'id');
    }
}