<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'zalo_phone',
        'other_info',
        'user_id'
    ];


    // protected $fillable = [
    //     'user_id', 'facebook_url', 'twitter_url', 'youtube_url', 'zalo_phone', 'other_info'
    // ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
