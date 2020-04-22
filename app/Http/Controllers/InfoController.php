<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;

class InfoController extends Controller
{
    public function index() {
        return view("info");
    }

    public function store(Request $request) {
        $compscore = Myscore::where("user_id", \Auth::id())->latest()->first();

        $myscore = new Myscore;

        $myscore->user_id = \Auth::id();
        $myscore->start = (int)($request->start);
        $myscore->gamesOfDay = $compscore->gamesOfDay + 1;

        $myscore->player = 5;
        $myscore->houjuu_player = 5;
        $myscore->date = "2000-01-01";
        $myscore->turn = 10000;
        $myscore->score = 1;
        $myscore->dealer = false;
        $myscore->tsumo = false;
        $myscore->save();

        return redirect("scores");
    }
}
