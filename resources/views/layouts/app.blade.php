<!doctype html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>解析</title>
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-info mb-4">
		<a class="navbar-brand" href="#" >手動解析機</a>

		<ul class="navbar-nav ml-auto">
			@guest
				<li class="nav-item">
					{!! Form::open(["route" => "login", "method" => "get", "class" => "nav-link"]) !!}
						{!! Form::submit("ログイン", ["class" => "btn btn-info"]) !!}
					{!! Form::close() !!}
				</li>
				<li class="nav-item">
					{!! Form::open(["route" => "register", "method" => "get", "class" => "nav-link"]) !!}
						{!! Form::submit("登録", ["class" => "btn btn-info"]) !!}
					{!! Form::close() !!}
				</li>
			@else
				<li class="nav-item">
					{!! Form::open(["route" => "statistics", "method" => "get", "class" => "nav-link"]) !!}
						{!! Form::submit("統計ページ", ["class" => "btn btn-info"]) !!}
					{!! Form::close() !!}
				<li class="nav-item">
					{!! Form::open(["route" => "logout", "method" => "post", "class" => "nav-link"]) !!}
						{!! Form::submit("ログアウト", ["class" => "btn btn-info"]) !!}
					{!! Form::close() !!}
				</li>
			@endguest
		</ul>
	</nav>

	@yield("content")

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>