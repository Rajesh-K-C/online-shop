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
        'created_by',
        'updated_by',
    ];

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by', 'id');
    }
}
