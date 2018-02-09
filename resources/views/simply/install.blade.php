<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Simply | Installation </title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('public/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{asset('public/img/favicon.png') }}" rel="icon"/>
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('public/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{asset('public/css/foundation-icons.css') }}" rel="stylesheet"/>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
</head>
<body>
	<div class="col-xs-12 col-md-6 col-md-offset-3" style="background: rgba(0,0,0,0.1);margin-top: 15px;margin-bottom: 15px;border-radius: 5px;">
		<h2>Simply</h2>
		<p>Fill the below for to install Simply once and for all</p>
		@if($errors->any())
			@foreach($errors->all() as $error)
				<p class="text-danger">{{$error}}</p>
			@endforeach
		@endif
		@if(@$dbError)
			<p class="text-danger">{{$dbError}}</p>
		@endif
		<hr />
		<form method="post" action="{{route('start')}}">
			{{csrf_field()}}

			<div class="form-group">
				<label>Database Host:</label>
				<input type="text" name="dbHost" class="form-control" value="{{old('dbHost')}}">
			</div>
			<div class="form-group">
				<label>Database Port:</label>
				<input type="number" value='3306' name="dbPort" class="form-control"  value="{{old('dbPort')}}">
			</div>
			<div class="form-group">
				<label>Database Username:</label>
				<input type="text" name="dbUser" class="form-control" value="{{old('dbUser')}}">
			</div>
			<div class="form-group">
				<label>Database Password:</label>
				<input type="password" name="dbPass" class="form-control">
			</div>
			<div class="form-group">
				<label>Database Name:</label>
				<input type="text" name="dbName" class="form-control" value="{{old('dbName')}}">
			</div>
			<div class="form-group">
				<label>Login E-Mail:</label>
				<input type="email" name="email" class="form-control" value="{{old('email')}}">
			</div>
			<div class="form-group">
				<label>Login Password:</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" class="form-control btn-success" value="Start Installation">
			</div>

		</form>
	</div>
</body>
</html>
