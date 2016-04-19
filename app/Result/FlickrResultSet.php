<?php
/*
* Class to model a set of results obtained from Flickr's api.
*
* @author Mathew Harrington
*/

// namespace for laravel
namespace App\Result;

require_once 'iResultSet.php';

class FlickrResultSet implements iResultSet {

   private $rawResponse = array();
   private $parsedResponse;

   function __construct()
   {

   }

   public function count()
   {
      return count($this->results);
   }

   public function addResults($results)
   {
      $this->rawResponse = $results;
   }

   /*
   * Json response contained some suspicious characters at the beginning and
   * end, this removes those to leave a valid json string. User must call this
   * function to be able to use the json data normally.
   */
   public function parse()
   {
      // remove leading characters
      $formattedJson = preg_replace('/^[^{]*\s*/', '', $this->rawResponse);
      // remove trailing bracket
      $formattedJson = rtrim($formattedJson, ')');
      $this->parsedResponse = json_decode($formattedJson, true);
   }

   public function getParsedResults()
   {
      return $this->parsedResponse;
   }

   public function getRawResponse()
   {
      return $this->rawResponse;
   }

   /*
   * Function to translate the parsed json response from Flickr into an array of
   * valid URL's. Flickr image URL's take the form:
   * https://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}.jpg
   *
   * @return Array The populated array of Flickr image URL's.
   */
   public function buildPhotoURLArray()
   {
      // turn the parsed json response into an array of valid url's
      $photoURLs = array();
      $baseURL = 'https://farm';

      $responsePhotos = $this->parsedResponse['photos'];
      $responsePhotos = $responsePhotos['photo'];

      foreach($responsePhotos as $photoFrag)
      {
         $completeURL = $baseURL;
         $completeURL .= $photoFrag['farm'];
         $completeURL .= '.staticflickr.com/';
         $completeURL .= $photoFrag['server'] . '/';
         $completeURL .= $photoFrag['id'];
         $completeURL .= '_';
         $completeURL .= $photoFrag['secret'];
         // for image sizes see: https://www.flickr.com/services/api/misc.urls.html
         $completeURL .= '_n.jpg';
         array_push($photoURLs, $completeURL);
      }
      return $photoURLs;
   }

   /*
   * Function to add html img tags to each raw url.
   * Larvel didn't like this, escaped my < > and quotes...
   *
   * @return Array An array of photo URL's surrounded by img tags.
   */
   public function buildHTMLImages()
   {
      $photoURLs = $this->buildPhotoURLArray();
      $HTMLImages = array();

      if(count($photoURLs) > 0)
      {
         foreach($photoURLs as $URL)
         {
            $htmlImg = '<img src="' . $URL . '">';
            array_push($HTMLImages, $htmlImg);
         }
         return $HTMLImages;
      }
   }
}

 ?>
