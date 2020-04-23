<?php

use App\Scores\ScoresOperation;

function displayRound($t) {
    $turn = ($t - $t % 100) / 100;
    $strwind = "";

    if ($turn / 4 < 1) {
        $strwind = "東";
    } else if ($turn / 4 < 2) {
        $strwind = "南";
    } else {
        $strwind = "西";
    }

    return $strwind . (($turn%4)+1) .  "局 " . ($t % 100) . "本場";
}

function scorebutton($i, $j) {
    switch ($i) {
        case 0:
            switch ($j) {
                case 0:
                    return 1000;
                    break;
                case 1:
                    return 2000;
                    break;
                case 2:
                    return 3900;
                    break;
                case 3:
                    return 7700;
                    break;
                default:
                    return NULL;
                    break;
            }
            break;
        case 1:
            switch ($j) {
                case 0:
                    return 1300;
                    break;
                case 1:
                    return 2600;
                    break;
                case 2:
                    return 5200;
                    break;
                default:
                    return NULL;
                    break;
            }
            break;
        case 2:
            switch ($j) {
                case 0:
                    return 1600;
                    break;
                case 1:
                    return 3200;
                    break;
                case 2:
                    return 6400;
                    break;
                default:
                    return NULL;
                    break;
            }
            break;
        case 3:
            switch ($j) {
                case 0:
                    return 2300;
                    break;
                case 1:
                    return 4500;
                    break;
                default:
                    return NULL;
                    break;
            }
            break;
        case 4:
            switch ($j) {
                case 0:
                    return 8000;
                    break;
                case 1:
                    return 12000;
                    break;
                case 2:
                    return 16000;
                    break;
                case 3:
                    return 24000;
                    break;
                default :
                    return NULL;
                    break;
            }
            break;
        case 5:
            switch ($j) {
                case 0:
                    return 32000;
                    break;
                case 1:
                    return 64000;
                    break;
                case 2:
                    return 96000;
                    break;
                case 3:
                    return 128000;
                    break;
                default :
                    return NULL;
                    break;
            }
            break;
        default:
            return 0;
            break;
    }
}

function dealerscorebutton($i, $j) {
    switch ($i) {
        case 0:
            switch ($j) {
                case 0:
                    return 1500;
                    break;
                case 1:
                    return 2900;
                    break;
                case 2:
                    return 5800;
                    break;
                case 3:
                    return 11600;
                    break;
                case 4:
                    return NULL;
                    break;
                case 5:
                    return NULL;
                    break;
            }
        case 1:
            switch ($j) {
                case 0:
                    return 2000;
                    break;
                case 1:
                    return 3900;
                    break;
                case 2:
                    return 7700;
                    break;
                case 3:
                    return NULL;
                    break;
                case 4:
                    return NULL;
                    break;
                case 5:
                    return NULL;
                    break;
            }
        case 2:
            switch ($j) {
                case 0:
                    return 2400;
                    break;
                case 1:
                    return 4800;
                    break;
                case 2:
                    return 9600;
                    break;
                case 3:
                    return NULL;
                    break;
                case 4:
                    return NULL;
                    break;
                case 5:
                    return NULL;
                    break;
            }
        case 3:
            switch ($j) {
                case 0:
                    return 3400;
                    break;
                case 1:
                    return 6800;
                    break;
                case 2:
                    return NULL;
                    break;
                case 3:
                    return NULL;
                    break;
                case 4:
                    return NULL;
                    break;
                case 5:
                    return NULL;
                    break;
            }
        case 4:
            switch ($j) {
                case 0:
                    return 12000;
                    break;
                case 1:
                    return 18000;
                    break;
                case 2:
                    return 24000;
                    break;
                case 3:
                    return 36000;
                    break;
                default :
                    return NULL;
                    break;
            }
        case 5:
            switch ($j) {
                case 0:
                    return 48000;
                    break;
                case 1:
                    return 96000;
                    break;
                case 2:
                    return 144000;
                    break;
                case 3:
                    return 192000;
                    break;
                default :
                    return NULL;
                    break;
            }
        default:
            return 0;
            break;
    }
}

function displayPlayer($check, $player, $h_player, $score, $turn, $dealer) {
    $scoresoperation = new ScoresOperation();

    if ($h_player != 4) {
        if ($check == $player) {
            return $score;
        } else if ($check == $h_player) {
            return "<font color=\"red\">" . -$score . "</font>";
        } else {
            return "";
        }
    } else {
        if ($check == $player) {
            return $score;
        } else {
            if ($dealer == true) {
                return "<font color=\"red\">" . -$score/3 . "</font>";
            } else {
                if ($check == (((int)($turn/100))%4)) {         //親の被ツモ
                    $calcscore = $scoresoperation->showScore($score, true);
                } else {                                        //子の被ツモ
                    $calcscore = $scoresoperation->showScore($score, false);
                }
            }
            return "<font color=\"red\">" . -$calcscore . "</font>";
        }
    }
}
?>

@extends("layouts.app")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-md-6">
 				{{ Form::open(["route" => "scores.store"]) }}

				<div class="row mb-3">
					<div class="col-md-6">
					 	<input class="form-control" type="text" value="{{ displayRound($turn) }}" readonly>
					</div>
					<div class="col-md-6 d-inline-flex">
						<div class="align-middle">
 						{{ link_to_route("scores.index", "ー", ["turn" => (((int)($turn/100)-1)*100)], ["class" => "btn btn-light"]) }} 局 {{ link_to_route("scores.index", "＋", ["turn" => (((int)($turn/100)+1)*100)], ["class" => "btn btn-light"]) }}
 						{{ link_to_route("scores.index", "ー", ["turn" => $turn-1], ["class" => "btn btn-light"]) }} 本場 {{ link_to_route("scores.index", "＋", ["turn" => $turn+1], ["class" => "btn btn-light"]) }}
 						</div>
					</div>
				</div>

				<input type="hidden" name="turn" value="{{ $turn }}">

				<div class="row mb-3">
					<div class="col-md-5">
						<div>
						@if ($dealer == true)
							<input type="hidden" name="dealer" value="true">{{ link_to_route("scores.index", "親", ["dealer" => false, "turn" => $turn], ["class" => "btn btn-light"]) }}　　
						@else
							<input type="hidden" name="dealer" value="false">{{ link_to_route("scores.index", "子", ["dealer" => true, "turn" => $turn], ["class" => "btn btn-light"]) }}　　
						@endif

						{!! Form::checkbox("tsumo", true) !!}ツモあがり
						</div>
					</div>

					<div class="col-md-7">
						和了者{{ Form::select("player", ["東", "南", "西", "北"]) }} 家 ／ 放銃者{{ Form::select("houjuu_player", ["東", "南", "西", "北"]) }} 家
					</div>
				</div>

				<table class="table table-bordered mb-4">
					<thead>
					</thead>
					<tbody>
						@for ($i=0; $i<6; $i++)
							<tr>
								@for ($j=0; $j<4; $j++)
									<td>
										@if ($dealer == false)
											<input type="submit" name="score" value="{{ scorebutton($i, $j) }}">
										@else
											<input type="submit" name="score" value="{{ dealerscorebutton($i, $j) }}">
										@endif
									</td>
								@endfor
							</tr>
						@endfor

					</tbody>
				</table>

				{{ Form::close() }}

				<div class="d-flex justify-content-end">
					{{ link_to_route("info.index", "続けて入力", [], ["class" => "btn btn-primary"]) }}　
					{{ link_to_route("statistics", "統計ページへ", [], ["class" => "btn btn-success"]) }}
				</div>

			</div>

			<div class="col-md-6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>開始時</th>
							<th>起家</th>
							<th>B</th>
							<th>C</th>
							<th>D</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($myscores as $myscore)
						<tr>
							@if ($myscore->turn == 10000)
								@continue
							@endif
							<td class="align-middle">{{ displayRound($myscore->turn) }}</td>
							@for ($i=0; $i<4; $i++)
							<td class="align-middle">{!! displayPlayer($i, $myscore->player, $myscore->houjuu_player, $myscore->score, $myscore->turn, $myscore->dealer) !!}</td>
							@endfor
							<td>
							{{ Form::model($myscore, ["route" => ["scores.destroy", $myscore->id], "method" => "delete"]) }}
								{{ Form::submit("削除", ["class" => "btn btn-danger"]) }}
							{{ Form::close() }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{{ $myscores->links('pagination::bootstrap-4')}}
			</div>
		</div>
	</div>

@endsection