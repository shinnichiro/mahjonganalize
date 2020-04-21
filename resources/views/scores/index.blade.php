<?php
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

    return $strwind . (($turn%4)+1) .  "局" . ($t % 4) . "本場";
}

function scorebutton($i, $j) {
    switch ($i) {
        case 0:
            switch ($j) {
                case 0:
                    return 300;
                    break;
                case 1:
                    return 500;
                    break;
                case 2:
                    return 1000;
                    break;
                case 3:
                    return 2000;
                    break;
                case 4:
                    return 3900;
                    break;
                case 5:
                    return 7700;
                    break;
            }
        case 1:
            switch ($j) {
                case 0:
                    return 400;
                    break;
                case 1:
                    return 700;
                    break;
                case 2:
                    return 1300;
                    break;
                case 3:
                    return 2600;
                    break;
                case 4:
                    return 5200;
                    break;
                case 5:
                    return NULL;
                    break;
            }
        case 2:
            switch ($j) {
                case 0:
                    return 400;
                    break;
                case 1:
                    return 800;
                    break;
                case 2:
                    return 1600;
                    break;
                case 3:
                    return 3200;
                    break;
                case 4:
                    return 6400;
                    break;
                case 5:
                    return NULL;
                    break;
            }
        case 3:
            switch ($j) {
                case 0:
                    return 600;
                    break;
                case 1:
                    return 1200;
                    break;
                case 2:
                    return 2300;
                    break;
                case 3:
                    return 4500;
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
        default:
            return 0;
            break;
    }
}
?>

@extends("layouts.app")

@section("content")

	<div class="container">
		<div class="row">
			<div class="col-md-7">
				{!! Form::open(["route" => "scores.store"]) !!}
<!--
					<p class="mb-4">{!! Form::checkbox("dealer") !!} 親（未実装） {!! Form::checkbox("gained") !!} 得点 {!! Form::checkbox("tsumo") !!} ツモあがり（未実装）</p>
-->
					<table class="table table-bordered">
						<thead>
						</thead>
						<tbody>
							@for ($i=0; $i<6; $i++)
								<tr>
									@for ($j=0; $j<6; $j++)
										<td>
											<input type="submit" name="score" value="<?php echo scorebutton($i, $j); ?>">
										</td>
									@endfor
								</tr>
							@endfor
						</tbody>
					</table>
				{!! Form::close() !!}
			</div>
			<div class="col-md-5">
					@foreach ($myscores as $myscore)
						{!! Form::model($myscore, ["route" => ["scores.destroy", $myscore->id], "method" => "delete"]) !!}
							<p><!--  <?php echo displayRound($myscore->turn); ?>--> {{ $myscore->score }}点		{!! Form::submit("削除", ["class" => "btn btn-danger"]) !!}</p>
						{!! Form::close() !!}
					@endforeach

					{{ $myscores->links('pagination::bootstrap-4') }}
			</div>
		</div>
	</div>

@endsection