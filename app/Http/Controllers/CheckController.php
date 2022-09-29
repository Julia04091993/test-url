<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Url;
use App\Jobs\testjob;
 
class CheckController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('check');
    }
 
    /**
     * Store a new blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'URLaddress' => 'bail|required|url',
            'frequency' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return redirect ('/')
                ->withErrors($validator)
                ->withInput();
        } else 
        { 
            $this->check($request);
            return view('check', ['message' => true]);
        }
    }
    public function check(Request $request) 
    {
        Url::updateOrCreate (
                ['url' => $request->input('URLaddress')],
                ['frequency' => $request->input('frequency'), 'quantity' => $request->input('quantity')]
            );
        testjob::dispatch($request->input('URLaddress'));
    }

}
