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
    $OpenWeatherClient = new \App\Pest\Pest(getenv('OPEN_WEATHER_BASE_URL'));
    $OpenWeatherAPI = new \App\API_Adapter\OpenWeatherAPI($OpenWeatherClient);
    // TODO 
    // $OpenWeatherResultSet = new \App\Result\OpenWeatherResultSet();
}
