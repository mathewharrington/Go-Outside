@extends('layout')
@section('content')
<section class="header">
   <h2>Go Outside</h2>
</section>

<div class="row">
   <div class="four columns">
      <p></p>
   </div>
   <div class="four columns center">

{{ Form::open(array('action' => 'PagesController@load', 'method' => 'post')) }}
<?php
echo Form::label('city', 'Enter City');
echo Form::text('city', 'Paris', array('class' => 'u-full-width'));
echo Form::button('Search', array('class' => 'button-primary', 'type' => 'submit'));
?>
{{ Form::close() }}
   </div>

   <div class="four columns">
      <p></p>
   </div>
</div>

@if(count($errors) > 0)
<div class="row">
   <div class="four columns">
      <p></p>
   </div>
   <div class="four columns center">
      <h4>This is awkward</h4>
      <ul>
      @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
      </ul>
   </div>
   <div class="four columns">
      <p></p>
   </div>
</div>
@endif

@if(isset($weatherDesc))
<div class="row">
   <div class="twelve columns center">
      <h3>{{ $weatherDesc }}</h3>
   </div>
</div>
@endif

@if(isset($photoResponse))
<?php
// counters for rows.
$i = 0;
$j = 0;
?>
@foreach($photoResponse as $photo)
<?php if(($i % 3) === 0)
      {
         echo "<div class='row'>";
         $j = 0;
      }
?>
<div class="one-third column">
<img src="{{ $photo }}" class="u-max-full-width">
</div>
<?php if($j === 2) echo "</div>"; ?>
<?php $i++; $j++ ?>
@endforeach
   </div>
</div>
@endif
@stop
