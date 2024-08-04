<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPromo extends Model
{
    use HasFactory;
    protected $table = 'order_promos';

    protected $fillable = [
        'order_id',
        'promo_code_id',
    ];
}
