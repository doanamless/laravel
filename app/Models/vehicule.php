<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{
    //use HasFactory;
    protected $table ='vehicules';
    protected $fillable=['designation', 'marque',"prix",'date_aquisition','prem_km',
        'puissance','consommation','carburant','reference'];
}
