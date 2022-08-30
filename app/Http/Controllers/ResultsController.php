<?php

namespace App\Http\Controllers;
use App\Models\Check;
use Illuminate\Http\Request;
use App\Models\Url;

class ResultsController extends Controller
{
   public function show_results() {
        $checks = Check::all();
        return view('results', ['checks' => $checks]);
   }
   public function show_urls() {
        $urls = Url::all();
        return view('url-list', ['urls' => $urls]);
}
}
