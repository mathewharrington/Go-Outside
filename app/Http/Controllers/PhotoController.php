<?php
/*
* Photo controller class. Currently only deals with images sourced from flickr,
* may need to add more functions to handle 500px eventually. Not sure about
* naming the function 'load'
*
* @author Mathew Harrington
*/

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
// my namespaces
use App\Pest;
use App\API_Adapter;
use App\Result;

class PhotoController extends Controller
{
   public function load()
   {
      // setup objects to make flickr request
      $FlickrClient = new \App\Pest\Pest(getenv('FLICKR_BASE_URL'));
      $FlickrAPI = new \App\API_Adapter\FlickrAPI($FlickrClient);
      $FlickrResultSet = new \App\Result\FlickrResultSet();

      // add options for flickr query
      $FlickrAPI->setOption("tags", "melbourne");
      $FlickrAPI->setOption("api_key", getenv('FLICKR_API_KEY'));
      $FlickrAPI->setOption("per_page", 20);

      $flickrResponse = $FlickrAPI->get();
      $FlickrResultSet->addResults($flickrResponse);
      // this step is important - pest seems to add a few of its own characters to the response
      $FlickrResultSet->parse();

      $photoURLs = $FlickrResultSet->buildPhotoURLArray();

      return view('pages.test', ['results' => $photoURLs]);
   }
}
