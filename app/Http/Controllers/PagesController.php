<?php

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
   * open weather api for weather results.
   *
   * @param Request The request object containing the form value(s).
   * @return View Homepage and array of weather result.
   */
   public function load(Request $request)
   {
      $OpenWeatherClient = new \App\Pest\Pest(getenv('OPEN_WEATHER_BASE_URL'));
      $OpenWeatherAPI = new \App\API_Adapter\OpenWeatherAPI($OpenWeatherClient);
      $OpenWeatherResultSet = new \App\Result\OpenWeatherResultSet();

      // harcode for now, will come from form input
      $OpenWeatherAPI->setParam("city", $request->input('city'));
      $response = $OpenWeatherAPI->get();
      $OpenWeatherResultSet->addResults($response);
      $OpenWeatherResultSet->parse();

      // build meaningful string
      $weather = "Current weather for ";
      $weather .= $OpenWeatherResultSet->getCityName();
      $weather .= " is ";
      $weather .= $OpenWeatherResultSet->getWeatherDesc();
      return view('welcome', ['weatherResults' => $weather]);
   }
}
