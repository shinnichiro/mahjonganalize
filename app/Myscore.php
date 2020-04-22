<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myscore extends Model
{
    protected $fillable = [
        "user_id", "start", "player","houjuu_player", "date", "gamesOfDay", "turn", "score", "dealer", "tsumo",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
