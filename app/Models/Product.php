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
        'description',
        'price',
        'discount_amount',
        'discount_percentage',
        'image',
        'stock',
        'status',
        'total_sales',
        'category_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getUpdatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public static function getActiveProducts()
    {
        return Product::where('status', 1);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
