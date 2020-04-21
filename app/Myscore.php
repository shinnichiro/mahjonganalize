<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myscore extends Model
{
    protected $fillable = [
        "user_id", "player", "date", "gamesOfDay", "turn", "score", "dealer",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
