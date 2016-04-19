@extends('layout')

@section('content')
<section class="header">
   <h2>Go Outside</h2>
</section>
<form>
   <div class="row">
      <div class="six columns">
         <label for="cityInput">City Name</label>
         <input class="u-full-width" type="text">
      </div>
      <div class="six columns">
         <label for=""></label>
      </div>
   </div>
   <div class="row">
      <input class="button-primary" type="submit" value="Submit">
   </div>
</form>
@stop
