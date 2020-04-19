@extends("layouts.app")

@section("content")

	@guest
		<div class="jumbotron">
			<div class="d-flex justify-content-center mb-5">
				<h1>麻雀手動点数入力・解析機</h1>
			</div>
			<div class="d-flex justify-content-around">
				<h4>{!! link_to_route("login", "ログイン") !!}</h4>
				<h4>{!! link_to_route("register", "登録") !!}</h4>
				<h4>{!! link_to_route("howto", "What's this?") !!}</h4>
			</div>
		</div>
	@else
		<div class="text-center">
			<a href="statistics">統計ページへ（リダイレクトにしたい）</a>
		</div>
	@endguest

@endsection