<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

//use App\Http\Requests;

// adding my namespaces
use App\Pest;
use App\API_Adapter;
use App\Result;

class PagesController extends Controller
{
   // have more functions for other pages
    public function about()
    {
      $people = ['mathew', 'rachel', 'cool guy'];
       return view('pages.about', compact('people'));
   }

   public function home()
   {
      return view('welcome');
   }
}
