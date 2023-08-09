<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirlineCompany extends Model
{
    use HasFactory, SoftDeletes;

    public function tickets(){
        return $this->hasMany(Ticket::class, 'airline_company_id', 'id');
    }
}
