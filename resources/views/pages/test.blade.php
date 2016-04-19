<?php
// counter for rows.
$i = 0;
$j = 0;
 ?>

@extends('layout')
@section('content')
<h3>Go Outside</h3>
@foreach($results as $result)
<?php if(($i % 3) === 0)
      {
         echo "<div class='row'>";
         $j = 0;
      }
?>
<div class="one-third column">
<img src="{{ $result }}" class="u-max-full-width">
</div>
<?php if($j === 2) echo "</div>"; ?>
<?php $i++; $j++ ?>
@endforeach
@stop
