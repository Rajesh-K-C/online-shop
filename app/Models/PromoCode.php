<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;
    protected $table = 'promo_codes';
    protected $fillable = [
        'code',
        'code_for',
        'discount_amount',
        'discount_percent',
        'description',
        'usage_limit',
        'used_count',
        'user_limit',
        'starts_at',
        'expires_at',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
