<?php
/*
* Class specific to OpenWeather's api, implements the super-simple (read:one-function)
* adapter interface, but this is ok since this is just a practice app. Responsible
* for being an inbetween for my code and the REST client. Just needs to GET at
* this stage, parsing will take place in the result set class.
*
* Has a reference to the Pest REST client because that's the one I chose to use.
*
* @author Mathew Harrington
*/

// namespace for laravel
namespace App\API_Adapter;
use App\Pest;

require_once 'iAPIAdapter.php';

class OpenWeatherAPI implements iAPIAdapter {

   private $client;
   // options will be appended to the url when request is made
   private $options = array();

   function __construct(\App\Pest\Pest $pestClient)
   {
      $this->client = $pestClient;
      //$this->options("appid" => getenv('OPEN_WEATHER_API_KEY'));
      $this->options["appid"] = getenv('OPEN_WEATHER_API_KEY');
      //$this->options("units" => getenv('UNITS'));
      $this->options["units"] = getenv('UNITS');
   }

   /*
   * Function to send the request, calls the client to actually perform the
   * request.
   *
   * @return The raw (json) response
   */
   public function get()
   {
      $response = $this->client->get($opts);
      return $response;
   }

   /*
   * Function to set various options to add on to the Flickr request. See
   * https://www.flickr.com/services/api/flickr.photos.search.html for available
   * arguments. No checking is done here, it's up to the caller to ensure that
   * appropriate options are being set with appropriate values.
   *
   * @param String $opt The option to set
   * @param String $value The value you want to set the option to
   */
   public function setOption($opt, $value)
   {
      $this->options[$opt] = $value;
   }
}

 ?>


 <!-- function openWeatherRequest($city)
{
   $openWeatherUrl = OPEN_WEATHER_BASE_URL;
   $openWeatherUrl .= $city;
   $openWeatherUrl .= '&appid=' . OPEN_WEATHER_API_KEY;
   $openWeatherUrl .= '&units=' . UNITS;

   // process response
   $openWeatherjson = file_get_contents("$openWeatherUrl");
   $openWeatherjson = json_decode($openWeatherjson, true);

   // get weather description
   $weatherDesc = $openWeatherjson['weather'][0]['description'];
   $weatherTag = $openWeatherjson['weather'][0]['main'];

   // get coordinates
   $lat = $openWeatherjson['coord']['lat'];
   $long = $openWeatherjson['coord']['lon'];
   $results = array();
   $results['desc'] = $weatherDesc;
   $results['weatherTag'] = $weatherTag;
   $results['lat'] = $lat;
   $results['long'] = $long;
   return $results;
} -->