@extends("layouts.app")

@section("content")

	<p class="mb-5">統計用ページ（要ログイン／ログアウト時の振り分け）</p>

	<p>計：{{ $sum }}点</p>
	<p>平均得点：{{ $average }}点</p>

	{!! link_to_route("scores.index", "入力ページへ（仮）") !!}

@endsection