<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Myscore;

class ScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myscores = Myscore::orderBy("id", "desc")->paginate(15);

        return view("scores.index", [
            "myscores" => $myscores,
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

            $myscore->user_id = \Auth::user()->id;
            $myscore->player = true;
            $myscore->date = "2000-01-01";
            $myscore->gamesOfDay = 1;
            $myscore->turn = 0;
            $myscore->score = (int)($request->score);
            $myscore->dealer = false;
            $myscore->save();
        }

        return $this->index();
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
        //
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
        //
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

        return $this->index();
    }
}
