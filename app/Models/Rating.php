<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id', 'player_id', 'rating', 'comment', 'sentiment'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function player() {
        return $this->belongsTo(Player::class);
    }
}
