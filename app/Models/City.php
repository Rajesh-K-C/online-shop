<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = [
        'name',
        'district_id',
        'delivery_charge',
        'delivery_status',
    ];

    public function getDistrict(){
        return $this->belongsTo(District::class, 'id', 'district_id');
    }
}
