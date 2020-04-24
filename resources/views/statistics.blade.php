@extends("layouts.app")

@section("content")

	<p class="mb-5">統計用ページ（要ログイン／ログアウト時の振り分け）</p>

	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<table class="table table-bordered">
					<thead>
					</thead>
					<tbody>
						<tr>
							<td>和了率</td>
							<td>{{ $agaripro }}%</td>
						</tr>
						<tr>
							<td>和了素点</td>
							<td>{{ $average }}点</td>
						</tr>
						<tr>
							<td>ツモ和了率</td>
							<td>{{ $tsumoagari }}%</td>
						</tr>
						<tr>
							<td>和了時3900以上</td>
							<td>{{ $p3900over }}%</td>
						</tr>
						<tr>
							<td>和了時7700以上</td>
							<td>{{ $p7700over }}%</td>
						</tr>
						<tr>
							<td>和了時11600以上</td>
							<td>{{ $p11600over }}%</td>
						</tr>
						<tr>
							<td>和了時親率</td>
							<td>{{ $agaridealer }}%</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-md-3">
				<table class="table table-bordered">
					<thead>
					</thead>
					<tbody>
						<tr>
							<td>放銃率</td>
							<td>{{ $houjuupro }}%</td>
						</tr>
						<tr>
							<td>放銃素点</td>
							<td>{{ $averagehoujuu }}点</td>
						</tr>
						<tr>
							<td>放銃時3900以上</td>
							<td>{{ $m3900over }}%</td>
						</tr>
						<tr>
							<td>放銃時7700以上</td>
							<td>{{ $m7700over }}%</td>
						</tr>
						<tr>
							<td>放銃時11600以上</td>
							<td>{{ $m11600over }}%</td>
						</tr>
						<tr>
							<td>親への放銃</td>
							<td>{{ $houjuutodealer }}%</td>
						</tr>
						<tr>
							<td>放銃時親率</td>
							<td>{{ $houjuuwd }}%</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-md-3">
				<table class="table table-bordered">
					<thead>
					</thead>
					<tbody>
						<tr>
							<td>流局率</td>
							<td>{{ $ryuukyoku }}%</td>
						</tr>
						<tr>
							<td>流局時聴牌率</td>
							<td>{{ $tenpai }}%</td>
						</tr>
						<tr>
							<td>流局時収支</td>
							<td>{{ $ryuushuushi }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	{!! link_to_route("info.index", "入力ページへ（仮）") !!}

@endsection