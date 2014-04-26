@extends('layout')

@section('content')
    @foreach($daumenkivys as $dk)
        <p>{{ $dk->caption }} / {{$dk->username}}</p>
    @endforeach
@stop
