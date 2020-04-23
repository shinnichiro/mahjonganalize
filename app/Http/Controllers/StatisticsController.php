<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;

class StatisticsController extends Controller
{
    private $sum = 0;
    private $datas = 0;

    private function add($n) {
        $this->sum += $n;
        $this->datas++;
    }

    public function statistics() {
        //空データ対策
        $latestscore = Myscore::where("user_id", \Auth::id())->latest()->first();
        if ($latestscore->score == 1) {
            $latestscore->delete();
        }

        $myscores = Myscore::where("user_id", \Auth::id())->get();

        foreach ($myscores as $myscore) {
            $this->add($myscore->score);
        }

        if ($this->datas == 0){
            $this->datas++;
        }

        return view("statistics", [
            "sum" => $this->sum,
            "average" => $this->sum/$this->datas,
        ]);
    }
}
