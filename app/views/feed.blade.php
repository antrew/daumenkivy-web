@extends('layout')

@section('content')
	<p><a href="submit">submit a Daumenkivy</a></p>
    @foreach($daumenkivys as $dk)
    	<div>
    	<img src="{{ URL::to('/images/') . "/" . $dk->id . ".gif" }}" />
        <p>{{ $dk->caption }} / {{$dk->username}}</p>
        </div>
    @endforeach
@stop
