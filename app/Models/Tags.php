<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'tags';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
