<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;

class ScoresController extends Controller
{
    public $dealer = false;

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
        if ($request->score != NULL) {
            $myscore = new Myscore;

            if ($request->dealer == "親") {
                $myscore->dealer = true;
            } else {
                $myscore->dealer = false;
            }

            $myscore->user_id = \Auth::user()->id;
            $myscore->iscored = true;
            $myscore->player = 0;
            $myscore->date = "2000-01-01";
            $myscore->gamesOfDay = 1;
            $myscore->turn = 0;
            $myscore->score = (int)($request->score);
            $myscore->tsumo = false;
            $myscore->save();
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
