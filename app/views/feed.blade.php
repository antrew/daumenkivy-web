@extends('layout')

@section('content')
	<a href="submit">submit a Daumenkivy</a>
    @foreach($daumenkivys as $dk)
        <p>{{ $dk->caption }} / {{$dk->username}}</p>
    @endforeach
@stop
