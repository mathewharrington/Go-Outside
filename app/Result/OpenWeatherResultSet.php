<?php
/*
* @author Mathew Harrington
*/

// namespace for laravel
namespace App\Result;

class OpenWeatherResultSet implements iResultSet {

   private $rawResponse = array();
   private $parsedResponse;

   function __construct()
   {
      //TODO
   }

   public function count()
   {
      // TODO
   }

   public function parse()
   {
      //TODO
   }

   public function addResults($results)
   {
      $this->rawResponse = $results;
      print($results);
   }

}
?>
