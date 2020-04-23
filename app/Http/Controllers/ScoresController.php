<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;

class ScoresController extends Controller
{
    public $dealer = false;

    public function tsumoScore($score, $dealer){
        switch ($score) {
            case 1000:
                return 1100;
                break;
            case 2000:
                if ($dealer == true) {
                    return 2100;
                } else {
                    return 2000;
                }
                break;
            case 3900:
                if ($dealer == true) {
                    return 3900;
                } else {
                    return 4000;
                }
                break;
            case 7700:
                if ($dealer == true) {
                    return 7800;
                } else {
                    return 7900;
                }
                break;
            case 1300:
                return 1500;
                break;
            case 2600:
                return 2700;
                break;
            case 2300:
                return 2400;
                break;
            case 4500:
                return 4700;
                break;
            case 2900:
                return 3000;
                break;
            case 5800:
                return 6000;
                break;
            case 11600:
                return 11700;
                break;
            case 3400:
                return 3600;
                break;
            case 6800:
                return 6900;
                break;
            default:
                return $score;
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $latestscore = Myscore::where("user_id", \Auth::id())->latest()->first();

        $myscores = Myscore::where("user_id",\Auth::user()->id)->where("date", $latestscore->date)->where("gamesOfDay", $latestscore->gamesOfDay)->orderBy("id", "desc")->paginate(10);
        $this->dealer = $request->dealer;
        if ($this->dealer == null) {
            $this->dealer = false;
        }

        //東１局で-を押した
        if ($request->turn < 0) {
            $turn = 0;
        //実装は西４局まで
        } else if ($request->turn > 1100) {
            $turn = 1100 + ($request->turn)%100;
        //0本場で-を押した
        } else if ($request->turn % 100 == 99) {
            $turn = $request->turn + 1;
        } else if ($request->turn == NULL) {
            $turn = 0;
        } else {
            $turn = $request->turn;
        }

        return view("scores.index", [
            "myscores" => $myscores,
            "dealer" => $this->dealer,
            "turn" => $turn,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //使わない
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $turn = -1;
        $tenpaicount = 0;
        $flag = 0;

        //流局時（
        if ($request->ryuukyoku == "流局") {
            $flag = 1;
            for ($i=0; $i<4; $i++) {
                if ($request->$i != NULL) {
                    $tenpaicount += (int)($request->$i);
                }
            }
        }

        //空ボタンを押したとき
        if (($request->score != NULL) || ($flag == 1)) {
            //ツモ以外で和了者と放銃者が同じだったとき
            if ((($request->player != $request->houjuu_player) || ($request->tsumo == true)) || ($flag == 1)) {
                //東家で子の点数を選ぶorその逆だったとき
                if ((!((($request->player == "0") && ($request->dealer == "false")) || (($request->player != "0") && ($request->dealer == "true")))) || ($flag == 1)) {
                    $myscore = new Myscore;
                    $compscore = Myscore::where("user_id", \Auth::id())->latest()->first();

                    $myscore->date = date("Y-m-d");

                    //初期値判定
                    if ($compscore->score == 1) {
                        $myscore = $compscore;
                    } else {
                        $myscore->start = $compscore->start;
                        $myscore->gamesOfDay = $compscore->gamesOfDay;
                    }

                    //すでに入力済みの局だったとき
                    $inputedscores = Myscore::where("user_id", \Auth::id())->where("date", $myscore->date)->where("gamesOfDay", $myscore->gamesOfDay)->get();
                    foreach($inputedscores as $inputedscore) {
                        if ($inputedscore->turn == $request->turn) {
                            return redirect()->route("scores.index", [
                                "turn" => $request->turn,
                            ]);
                        }
                    }

                    if ($request->dealer == "true") {
                        $myscore->dealer = true;
                    } else {
                        $myscore->dealer = false;
                    }

                    $myscore->turn = (int)($request->turn);

                    //最初の席順でだれがあがったか判定
                    $myscore->player = ((int)($request->player) + ((int)(($myscore->turn)/100))) % 4;

                    $myscore->score = (int)($request->score);
                    if ($request->tsumo == true) {
                        $myscore->tsumo = true;
                        $myscore->houjuu_player = 4;
                        //ツモあがり点数補正
                        $myscore->score = $this->tsumoScore($myscore->score, $myscore->dealer);
                    } else {
                        $myscore->tsumo = false;
                        $myscore->houjuu_player = ((int)($request->houjuu_player) + ((int)(($myscore->turn)/100))) % 4;
                    }

                    $myscore->user_id = \Auth::user()->id;

                    //流局時の処理
                    if ($tenpaicount != 0) {
                        $myscore->player = 4;
                        $myscore->houjuu_player = 5 + $tenpaicount;
                        $myscore->score = 0;
                        $myscore->tsumo = false;
                        $num = 0;
                        if (($request->$num) != NULL) {
                            $myscore->dealer = true;
                        } else {
                            $myscore->dealer = false;
                        }
                    }

                    $myscore->save();

                    if ($myscore->dealer == true) {
                        $turn = $myscore->turn + 1;
                    } else {
                        $turn = ((int)($myscore->turn/100)+1) * 100;
                    }
                }
            }
        }

        if ($turn == -1) {
            $turn = $request->turn;
        }

        return redirect()->route("scores.index", [
            "turn" => $turn,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //使わない
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //使わない
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //使わない
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $myscore = Myscore::find($id);
        $myscore->delete();

        return redirect("scores");
    }
}
