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
        $myscores = Myscore::all();
        $compscore = Myscore::where("user_id", \Auth::id())->latest()->first();

        $myscore = new Myscore;

        $myscore->user_id = \Auth::id();
        $myscore->start = (int)($request->start);
        if (count($myscores) == 0) {
            $myscore->gamesOfDay = 0;
        } else {
            if ($compscore == NULL) {
                $myscore->gamesOfDay = 0;
            } else {
                if ($compscore->date != (date("Y-m-d"))) {
                    $myscore->gamesOfDay = 0;
                } else {
                    $myscore->gamesOfDay = $compscore->gamesOfDay + 1;
                }
            }
        }

        $myscore->player = 5;
        $myscore->houjuu_player = 99;
        $myscore->date = date("Y-m-d");
        $myscore->turn = 10000;
        $myscore->score = 1;
        $myscore->dealer = false;
        $myscore->tsumo = false;
        $myscore->reacha = false;
        $myscore->reachb = false;
        $myscore->reachc = false;
        $myscore->reachd = false;
        $myscore->nakia = 0;
        $myscore->nakib = 0;
        $myscore->nakic = 0;
        $myscore->nakid = 0;
        $myscore->save();

        //空データ対策
        if ($compscore == NULL) {
        } else {
            if ($compscore->score == 1) {
                $compscore->delete();
            }
        }

        return redirect()->route("scores.index", [
            "turn" => 0,
        ]);
    }
}
