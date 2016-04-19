@extends('layout')
@section('content')
<h1>Go Outside</h1>
@foreach($results as $result)
<img src="{{ $result }}">
@endforeach

@stop
