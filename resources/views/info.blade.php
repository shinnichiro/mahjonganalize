@extends("layouts.app")

@section("content")

	<div style="text-align: center">
	{!! Form::open(["route" => "info.store"]) !!}
		<p><h1>最初の席？</h1></p>
		{!! Form::select("start", ["東", "南", "西", "北"]) !!}
		{!! Form::submit("開始") !!}
	{!! Form::close() !!}
	</div>

@endsection