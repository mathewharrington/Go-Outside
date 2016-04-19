<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// adding my namespaces
use App\Pest;
use App\API_Adapter;
use App\Result;

class PhotoController extends Controller
{
   public function load()
   {
      // have these here for now until I figure out where to put it
      define("FLICKR_BASE_URL", "https://api.flickr.com/services/rest/?method=flickr.photos.search");
      define("FLICKR_API_KEY", "75c703128e789bbbb1cad18b34448032");

      // instantiate objects and make request
      $FlickrClient = new \App\Pest\Pest(FLICKR_BASE_URL);
      $FlickrAPI = new \App\API_Adapter\FlickrAPI($FlickrClient);
      $FlickrResultSet = new \App\Result\FlickrResultSet();

      // add options for flickr query
      $FlickrAPI->setOption("tags", "melbourne");
      $FlickrAPI->setOption("api_key", FLICKR_API_KEY);
      $FlickrAPI->setOption("per_page", 20);

      $flickrResponse = $FlickrAPI->get();
      $FlickrResultSet->addResults($flickrResponse);
      $FlickrResultSet->parse();

      $photoURLs = $FlickrResultSet->buildPhotoURLArray();

      return view('pages.test', ['results' => $photoURLs]);
   }
}
