@extends('layout')

@section('content')
	<form method="POST" action="submit" enctype="multipart/form-data">
		Caption<br/>
		<input name="caption"><br/>
		Username<br/>
		<input name="username"><br/>
		E-mail<br/>
		<input name="email"><br/>
		<label for="file">GIF:</label>
		<input type="file" name="file" id="file"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
@stop
