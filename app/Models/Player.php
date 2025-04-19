<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['user_id', 'name', 'position', 'club', 'birthplace', 'photo_path'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function averageRating() {
        return round($this->ratings()->avg('rating') ?? 0, 1);
    }
}

