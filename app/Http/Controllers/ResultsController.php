<?php

namespace App\Http\Controllers;
use App\Models\Check;
use Illuminate\Http\Request;


class ResultsController extends Controller
{
   public function show_results() 
   {
        $checks = Check::all();
        return view('results', ['checks' => $checks]);
   }
}
