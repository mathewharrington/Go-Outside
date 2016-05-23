@extends('layout')
@section('content')
<section class="header">
   <h2>Go Outside</h2>
</section>

<div class="row">
   <div class="six columns">

{{ Form::open(array('action' => 'WeatherController@load', 'method' => 'get')) }}
<?php
echo Form::label('city', 'Enter City');
echo Form::text('city', 'Paris', array('class' => 'u-full-width'));
echo Form::button('Search', array('class' => 'button-primary', 'type' => 'submit'));
?>
{{ Form::close() }}

   </div>
</div>
@stop
