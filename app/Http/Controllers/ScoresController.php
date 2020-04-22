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
        $myscores = Myscore::where("user_id", \Auth::user()->id)->orderBy("id", "desc")->paginate(10);
        $this->dealer = $request->dealer;


        if ($this->dealer == null) {
            $this->dealer = false;
        }

        return view("scores.index", [
            "myscores" => $myscores,
            "dealer" => $this->dealer,
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
        //空ボタンを押したとき
        if ($request->score != NULL) {
            //ツモ以外で和了者と放銃者が同じだったとき
            if (($request->player != $request->houjuu_player) || ($request->tsumo == true)) {
                //東家で子の点数を選ぶorその逆だったとき
                if (!((($request->player == "0") && ($request->dealer == "子")) || (($request->player != "0") && ($request->dealer == "親")))) {
                    $myscore = new Myscore;
                    $compscore = Myscore::where("user_id", \Auth::id())->latest()->first();

                    if ($compscore->score == 1) {
                        $myscore = $compscore;
                    } else {
                        $myscore->start = $compscore->start;
                        $myscore->gamesOfDay = $compscore->gamesOfDay;

                    }

                    if ($request->dealer == "親") {
                        $myscore->dealer = true;
                    } else {
                        $myscore->dealer = false;
                    }

                    //仮
                    $myscore->turn = 0;

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
                    $myscore->date = "2000-01-01";

                    $myscore->save();
                }
            }
        }

        return redirect("scores");
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
