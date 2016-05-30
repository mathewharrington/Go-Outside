<?php
/*
* Pages Controller, handles basic homepage load and form submission (I chose to
* keep this a one-page application for simplicity). Each function returns the
* homepage view, with extra input if we have it.
*
* @author Mathew Harrington
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pest;
use App\API_Adapter;
use App\Result;

class PagesController extends Controller
{
   public function home()
   {
      return view('welcome');
   }

   /*
   * Function to handle the form submission... and more!
   * Consider breaking this into a couple of private functions.
   * This takes the request object containing form values and first calls the
   * open weather api for weather results. From that it calls the Flickr API
   * to obtain a set of photos of that city under the current weather conditions.
   *
   * @param Request The request object containing the form value(s).
   * @return View Homepage and array of weather result.
   */
   public function load(Request $request)
   {
      try
      {
         $OpenWeatherClient = new \App\Pest\Pest(getenv('OPEN_WEATHER_BASE_URL'));
         $OpenWeatherAPI = new \App\API_Adapter\OpenWeatherAPI($OpenWeatherClient);
         $OpenWeatherResultSet = new \App\Result\OpenWeatherResultSet();

         // cleanup form value
         $city = str_replace(' ','', $request->input('city'));

         // extract city from request object
         $OpenWeatherAPI->setParam("city", $city);
         $response = $OpenWeatherAPI->get();
         $OpenWeatherResultSet->addResults($response);
         $OpenWeatherResultSet->parse();

         /**
         * BEGIN FLICKR CALLS
         */

         // setup objects to make flickr request
         $FlickrClient = new \App\Pest\Pest(getenv('FLICKR_BASE_URL'));
         $FlickrAPI = new \App\API_Adapter\FlickrAPI($FlickrClient);
         $FlickrResultSet = new \App\Result\FlickrResultSet();

         // add options for flickr query
         $FlickrAPI->setParam("tags", $city);
         $FlickrAPI->setParam("per_page", 20);
         $FlickrAPI->setParam("orientation", "landscape");

         $flickrResponse = $FlickrAPI->get();
         $FlickrResultSet->addResults($flickrResponse);
         // this step is important - Pest seems to add a few of its own characters to the response
         $FlickrResultSet->parse();

         $photoURLs = $FlickrResultSet->buildPhotoURLArray();

         return view('welcome', ['photoResponse' => $photoURLs]);
      }

      catch(Pest_Exception $e)
      {
         return view('welcome');
      }

      catch(Exception $e)
      {
         return view('welcome');
      }
   }
}
