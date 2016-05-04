<?php
/*
* Class specific to Flickr's api, implements the super-simple (read:one-function)
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

class FlickrAPI implements iAPIAdapter {

   // options for request
   private $options = array();

   private $client;

   function __construct(\App\Pest\Pest $pestClient)
   {
      $this->client = $pestClient;
      // setup some default options for request
      $this->options["api_key"] = getenv('FLICKR_API_KEY');
      $this->options["tagMode"] = "all";
      $this->options["format"] = "json";
      $this->options["safeSearch"] = "1";
      $this->options["noJSONCallback"] = "1";
      $this->options["extras"] = "views";
   }

   /*
   * Function to send the request, calls the client to actually perform the
   * request.
   *
   * @return The raw (json) response
   */
   public function get()
   {
      $opts = self::formatParams();
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
   public function setParam($opt, $value)
   {
      $this->options[$opt] = $value;
   }

   /*
   * Function to format the extra values for sending in request to Flickr, need
   * to add ampersands and equal signs between options and values.
   *
   * TODO make options a comma separated string that will be appended to the URL
   *
   * @return String The request-ready string
   */
   private function formatParams()
   {
      $formattedParams = '';
      foreach($this->options as $key => $val)
      {
         $formattedParams .= "&" . $key . "=" . $val;
      }
      return $formattedParams;
   }
}
?>
