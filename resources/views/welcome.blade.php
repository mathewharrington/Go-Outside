@extends('layout')
@section('content')
<section class="header">
   <h2>Go Outside</h2>
</section>

<div class="row">
   <div class="six columns">

{{ Form::open(array('action' => 'PagesController@load', 'method' => 'post')) }}
<?php
echo Form::label('city', 'Enter City');
echo Form::text('city', 'Paris', array('class' => 'u-full-width'));
echo Form::button('Search', array('class' => 'button-primary', 'type' => 'submit'));
?>
{{ Form::close() }}

   </div>
</div>

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
