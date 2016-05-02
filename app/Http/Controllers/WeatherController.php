<?php
/*
* Weather controller class. Currently only deals with the open weather api. Aims
* to facilitate retrival and returning of weather data.
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

class WeatherController extends Controller
{
   public function load()
   {
      $OpenWeatherClient = new \App\Pest\Pest(getenv('OPEN_WEATHER_BASE_URL'));
      $OpenWeatherAPI = new \App\API_Adapter\OpenWeatherAPI($OpenWeatherClient);
      $OpenWeatherResultSet = new \App\Result\OpenWeatherResultSet();

      $OpenWeatherAPI->setOption("city", "melbourne");
      $response = $OpenWeatherAPI->get();
      //$OpenWeatherResultSet->addResults($response);
      //return view('pages.ow');
      //return view('pages.ow', ['data' => $owData]);
   }
}
