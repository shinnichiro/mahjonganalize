@extends("layouts.app")

@section("content")
	@auth
	<div class="container">
		<div class="mb-3">
			<h2>統計用ページ</h2>
		</div>
		<div class="row mb-3">
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
							<td>ツモ和了</td>
							<td>{{ $tsumoagari }}%</td>
						</tr>
						<tr>
							<td>リーチ成功率</td>
							<td>{{ $reachsuccess }}%</td>
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
							<td>和了時親</td>
							<td>{{ $agaridealer }}%</td>
						</tr>
						<tr>
							<td>和了時リーチ</td>
							<td>{{ $agarireach }}%</td>
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
							<td>リーチへの放銃</td>
							<td>{{ $houjuutoreach }}%</td>
						</tr>
						<tr>
							<td>放銃時親</td>
							<td>{{ $houjuuwd }}%</td>
						</tr>
						<tr>
							<td>放銃時リーチ</td>
							<td>{{ $houjuureach }}%</td>
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

		<div class="d-flex justify-content-end">
			{!! link_to_route("info.index", "新規入力", [], ["class" => "btn btn-success"]) !!}
		</div>
	</div>
	@else
	<?php
	   header("Location: ./");
	   exit;
	?>
	@endauth

@endsection