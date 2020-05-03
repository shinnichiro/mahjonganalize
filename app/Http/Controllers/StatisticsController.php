<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;
use App\Scores\ScoresOperation;

class StatisticsController extends Controller
{
    private $sum = 0;
    private $iscored = 0;
    private $allscored = 0;

    private function add($n) {
        $this->sum += $n;
        $this->iscored++;
    }

    private function ryaku() {
        return Myscore::where("user_id", \Auth::id())->whereColumn("start", "player");
    }

    private function gentenryaku() {
        return Myscore::where("user_id", \Auth::id())->whereColumn("start", "houjuu_player");
    }

    private function countReach($myscore, $num) {
        switch ($myscore->start) {
            case 0:
                if ($myscore->reacha == true) {
                    return $num+1;
                }
                break;
            case 1:
                if ($myscore->reachb == true) {
                    return $num+1;
                }
                break;
            case 2:
                if ($myscore->reachc == true) {
                    return $num+1;
                }
                break;
            case 3:
                if ($myscore->reachd == true) {
                    return $num+1;
                }
                break;
        }
        return $num;
    }

    public function statistics() {
        $scoresoperation = new ScoresOperation();

        //空データ対策
        $latestscore = Myscore::where("user_id", \Auth::id())->latest()->first();
        if ($latestscore== NULL) {
        } else if ($latestscore->score == 1) {
            $latestscore->delete();
        }

        $basicscores = Myscore::where("user_id", \Auth::id());
        $allscores = $basicscores->get();
        $myscores = Myscore::where("user_id", \Auth::id())->whereColumn("start","player")->get();
        $houjuuscores = Myscore::where("user_id", \Auth::id())->whereColumn("start", "houjuu_player")->get();
        $agari3900over = Myscore::where("user_id", \Auth::id())->whereColumn("start", "player")->where("score", ">=", "3900")->get();
        $agari7700over = Myscore::where("user_id", \Auth::id())->whereColumn("start", "player")->where("score", ">=", "7700")->get();
        $agari11600over = Myscore::where("user_id", \Auth::id())->whereColumn("start", "player")->where("score", ">=", "11600")->get();
        $agaridealer = Myscore::where("user_id", \Auth::id())->whereColumn("start", "player")->where("score", ">", "10")->where("dealer", true)->get();
        $tsumoagari = $this->ryaku()->where("score", ">", "0")->where("tsumo", true)->get();
        $houjuu3900over = $this->gentenryaku()->where("score", ">=", "3900")->get();
        $houjuu7700over = $this->gentenryaku()->where("score", ">=", "7700")->get();
        $houjuu11600over = $this->gentenryaku()->where("score", ">=", "11600")->get();
        $houjuutodealer = $this->gentenryaku()->where("score", ">", "10")->where("dealer", true)->get();
        $houjuuwhendealers = $this->gentenryaku()->where("score", ">", "10")->get();
        $houjuuwd = 0;
        $ryuu = Myscore::where("user_id", \Auth::id())->where("houjuu_player", ">=", "5")->where("houjuu_player", "<=", "20")->get();
        $counttenpai = 0;
        $ryuushuushi = 0;
        $agarirs = $this->ryaku()->get();
        $allreach = 0;

        foreach ($allscores as $allscore) {
            $this->allscored++;
            $allreach = $this->countReach($allscore, $allreach);
        }

        foreach ($myscores as $myscore) {
            $this->add($myscore->score);
        }


        //データがない状態の対応
        if (($this->iscored == 0) && ($this->allscored == 0)) {
            $agaripro = 0;
        } else {
            $agaripro = ($this->iscored / $this->allscored) * 100;
        }
        //0で割る対策
        if ($this->allscored == 0) {
            $this->allscored = 1;
        }
        if ($this->iscored == 0){
            $this->iscored = 1;
        }
        if ($houjuuscores->count() == 0) {
            $houjuu = 1;
        } else {
            $houjuu = $houjuuscores->count();
        }
        if ($ryuu->count() == 0) {
            $ryuucount = 1;
        } else {
            $ryuucount = $ryuu->count();
        }
        if ($allreach == 0) {
            $allreach = 1;
        } else {
        }

        foreach ($houjuuwhendealers as $houjuuwhendealer) {
            if ($houjuuwhendealer->start == (int)($houjuuwhendealer->turn/100)%4) {
                $houjuuwd++;
            }
        }

        foreach ($ryuu as $ryu) {
            if ($scoresoperation->ryuukyoku($ryu->start, $ryu->houjuu_player, $ryu->turn, false) == true) {
                $counttenpai++;
            }
        }

        foreach ($ryuu as $ryu) {
            $tempstr = $scoresoperation->ryuukyoku($ryu->start, $ryu->houjuu_player, $ryu->turn, true);
            if ($tempstr > 0) {
            } else {
                $tempstr = strstr($tempstr, "-");
                $tempstr = strstr($tempstr, "<", true);
            }
            $ryuushuushi += (int)$tempstr;
        }

        //あがったときリーチ
        $agarireach = 0;
        foreach ($agarirs as $agarir) {
            $agarireach = $this->countReach($agarir, $agarireach);
        }

        //放銃したときリーチ
        //リーチへの放銃
        $houjuureach = 0;
        $houjuutoreach = 0;
        foreach ($houjuuscores as $houjuun) {
            $houjuureach = $this->countReach($houjuun, $houjuureach);
            switch ($houjuun->player) {
                case 0:
                    if ($houjuun->reacha == true) {
                        $houjuutoreach++;
                    }
                    break;
                case 1:
                    if ($houjuun->reachb == true) {
                        $houjuutoreach++;
                    }
                    break;
                case 2:
                    if ($houjuun->reachc == true) {
                        $houjuutoreach++;
                    }
                    break;
                case 3:
                    if ($houjuun->reachd == true) {
                        $houjuutoreach++;
                    }
                    break;
                default:
                    break;
            }
        }


        return view("statistics", [
            "average" => round($this->sum/$this->iscored, 2),
            "agaripro" => round($agaripro, 2),
            "averagehoujuu" => round($houjuuscores->sum("score")/$houjuu, 2),
            "houjuupro" => round(($houjuuscores->count()/$this->allscored)*100, 2),
            "p3900over" => round(($agari3900over->count()/$this->iscored)*100, 2),
            "p7700over" => round(($agari7700over->count()/$this->iscored)*100, 2),
            "p11600over" => round(($agari11600over->count()/$this->iscored)*100, 2),
            "agaridealer" => round(($agaridealer->count()/$this->iscored)*100, 2),
            "tsumoagari" => round(($tsumoagari->count()/$this->iscored)*100, 2),
            "m3900over" => round(($houjuu3900over->count()/$houjuu)*100, 2),
            "m7700over" => round(($houjuu7700over->count()/$houjuu)*100, 2),
            "m11600over" => round(($houjuu11600over->count()/$houjuu)*100, 2),
            "houjuutodealer" => round(($houjuutodealer->count()/$houjuu)*100, 2),
            "houjuuwd" => round(($houjuuwd/$houjuu)*100, 2),
            "ryuukyoku" => round(($ryuu->count()/$this->allscored)*100, 2),
            "tenpai" => round(($counttenpai/$ryuucount)*100, 2),
            "ryuushuushi" => round(($ryuushuushi/$ryuucount), 2),
            "agarireach" => round(($agarireach/$this->iscored)*100, 2),
            "reachsuccess" => round(($agarireach/$allreach)*100, 2),
            "houjuureach" => round(($houjuureach/$houjuu)*100, 2),
            "houjuutoreach" =>round(($houjuutoreach/$houjuu)*100, 2),
        ]);
    }
}
