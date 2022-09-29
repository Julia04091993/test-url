<?php

namespace App\Http\Controllers;
use App\Models\Url;
use Illuminate\Http\Request;

class UrllistController extends Controller
{
    public function show_urls() 
    {
        $urls = Url::all();
        return view('url_list', ['urls' => $urls]);
    }
}
