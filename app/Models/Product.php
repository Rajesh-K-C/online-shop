<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'discount_amount',
        'discount_percent',
        'image',
        'stock',
        'rank',
        'status',
        'total_sales',
        'category_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

}
