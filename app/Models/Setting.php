<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, softDeletes;
    protected  $table = 'settings';
    protected $fillable = [
        'setting_name',
        'website_name',
        'slogan',
        'logo',
        'favicon',
        'header_logo',
        'footer_logo',
        'phone',
        'phone_optional',
        'email',
        'address',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'youtube_link',
        'google_map_link',
        'about_us',
        'opening_hours',
        'status',
        'created_by',
        'updated_by'
    ];
}
