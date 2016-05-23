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
      return view('pages.ow', ['data' => $weather]);
   }
}
