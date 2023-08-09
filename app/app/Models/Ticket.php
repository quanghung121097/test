<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'start_location_name',
        'end_location_name',
        'type_name',
        'airline_company_name',
    ];

    public function getAirlineCompanyNameAttribute()
    {
        if (!empty($this->airlineCompany)) {
            return $this->airlineCompany->name;
        }
        return null;
    }

    public function getTypeNameAttribute()
    {
        if (!empty($this->type)) {
            return $this->type->name;
        }
        return null;
    }

    public function getStartLocationNameAttribute()
    {
        if (!empty($this->startLocation)) {
            return $this->startLocation->name;
        }
        return null;
    }

    public function getEndLocationNameAttribute()
    {
        if (!empty($this->EndLocation)) {
            return $this->EndLocation->name;
        }
        return null;
    }

    public function startLocation(){
        return $this->belongsTo(Location::class, 'start_location', 'id');
    }

    public function endLocation(){
        return $this->belongsTo(Location::class, 'end_location', 'id');
    }

    public function type(){
        return $this->belongsTo(TicketType::class);
    }

    public function airlineCompany(){
        return $this->belongsTo(AirlineCompany::class);
    }
}
