<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'name',
        'state_id',
    ];

    public function getState(){
        return $this->belongsTo(State::class, 'state_id');
    }
}
