<?php
/*
* Class models the json response from OpenWeather. Used to format the response
* into useable data, primarily a weather description for use in searching for
* images.
*
* @author Mathew Harrington
*/

// namespace for laravel
namespace App\Result;

class OpenWeatherResultSet implements iResultSet {

   private $rawResponse = array();
   private $parsedResponse;

   function __construct()
   {
      // TODO?
   }

   /*
   * Function to parse the raw json response into a useable array.
   *
   * @return Array An array of returned json data
   */
   public function parse()
   {
      $this->parsedResponse = json_decode($this->rawResponse, true);
   }

   /*
   * Adds response to member variable.
   *
   * @param Array The response from REST request
   */
   public function addResults($results)
   {
      $this->rawResponse = $results;
   }

   /*
   * Function to get weather description from parsed json response.
   *
   * @return String A short description of current weather
   */
   public function getShortWeatherDesc()
   {
      return $this->parsedResponse['weather'][0]['main'];
   }

   /*
   * Function to get a 'slightly' longer description of current weather.
   *
   * @return String A slightly longer string for description
   */
   public function getWeatherDesc()
   {
      return $this->parsedResponse['weather'][0]['description'];
   }

   /*
   * @return String The name of the city featured in the response
   */
   public function getCityName()
   {
      return $this->parsedResponse['name'];
   }

   /*
   * Function to return the intire parsed json response to do what you like with.
   *
   * @return Array An array of json data
   */
   public function getParsedResponse()
   {
      return $this->parsedResponse;
   }
}
?>
