<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;

class StatisticsController extends Controller
{
    private $sum = 0;
    private $iscored = 0;
    private $allscored = 0;

    private function add($n) {
        $this->sum += $n;
        $this->iscored++;
    }

    public function statistics() {
        //空データ対策
        $latestscore = Myscore::where("user_id", \Auth::id())->latest()->first();
        if ($latestscore->score == 1) {
            $latestscore->delete();
        }

        $basicscores = Myscore::where("user_id", \Auth::id());
        $allscores = $basicscores->get();
        $myscores = Myscore::where("user_id", \Auth::id())->whereColumn("start","player")->get();
        $houjuuscores = Myscore::where("user_id", \Auth::id())->whereColumn("start", "houjuu_player")->get();

        foreach ($allscores as $allscore) {
            $this->allscored++;
        }

        foreach ($myscores as $myscore) {
            $this->add($myscore->score);
        }

        //0で割る対策
        if ($this->iscored == 0){
            $this->iscored = 1;
        }
        if ($this->allscored == 0) {
            $this->allscored = 1;
        }
        if ($houjuuscores->count() == 0) {
            $houjuu = 1;
        } else {
            $houjuu = $houjuuscores->count();
        }

        return view("statistics", [
            "average" => $this->sum/$this->iscored,
            "agaripro" => ($this->iscored/$this->allscored)*100,
            "averagehoujuu" => $houjuuscores->sum("score")/$houjuu,
            "houjuupro" => ($houjuuscores->count()/$this->allscored)*100,
        ]);
    }
}
