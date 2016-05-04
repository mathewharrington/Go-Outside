<?php
/*
* Class specific to OpenWeather's api, implements the super-simple adapter
* interface, but this is ok since this is just a practice app. Responsible
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
   // options to be appended to request url
   private $options = array();

   function __construct(\App\Pest\Pest $pestClient)
   {
      $this->client = $pestClient;
      $this->options["appid"] = getenv('OPEN_WEATHER_API_KEY');
      $this->options["units"] = getenv('UNITS');
   }

   /*
   * Function to send the request, calls the client to actually perform the
   * request. Raw response will be dealt with in the ResultSet class.
   *
   * @return The raw (json) response
   */
   public function get()
   {
      $extra = self::formatParams();
      $response = $this->client->get($extra);
      return $response;
   }

   /*
   * Function to set various options to add on to the OpenWeather request. See
   * http://openweathermap.org/current for available arguments. No checking is
   * done here, it's up to the caller to ensure that appropriate options are
   * being set with appropriate values.
   *
   * @param String $opt The option to set
   * @param String $value The value you want to set the option to
   */
   public function setParam($opt, $value)
   {
      $this->options[$opt] = $value;
   }

   /*
   * Function to format the extra values for sending in request to Flickr, need
   * to add ampersands and equal signs between options and values. City must be
   * first param in string.
   *
   * @return String The request-ready string
   */
   private function formatParams()
   {
      $formattedParams = '';
      foreach($this->options as $key => $val)
      {
         if($key == "city")
         {
            //$formattedParams .= $val;
            $formattedParams = $val . $formattedParams;
         }
         else
         {
            $formattedParams .= "&" . $key . "=" . $val;
         }
      }
      return $formattedParams;
   }
}

?>
