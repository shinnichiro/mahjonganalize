@extends("layouts.app")

@section("content")

	<p class="mb-5">統計用ページ（要ログイン／ログアウト時の振り分け）</p>

	<p>平均得点：{{ $average }}点</p>
	<p>和了率　：{{ $agaripro }}%</p>
	<p>平均放銃点：{{ $averagehoujuu }}点</p>
	<p>放銃率　：{{ $houjuupro }}%</p>

	{!! link_to_route("info.index", "入力ページへ（仮）") !!}

@endsection