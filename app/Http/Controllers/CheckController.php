<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Url;
use App\Models\Check;
 
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
    public function check_http_status($url) {
        $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 12);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $page = curl_exec($ch);
        
        $err = curl_error($ch);
        if (!empty($err))
            return $err;

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'URLaddress' => 'bail|required|url',
            'frequency' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect ('/')
                ->withErrors($validator)
                ->withInput();
        } else { 
            Url::updateOrCreate (
                ['url' => $request->input('URLaddress')],
                ['frequency' => $request->input('frequency'), 'quantity' => $request->input('quantity')]
            );
            $i = 0;
            while ($i <= $request->input('quantity')) {
                Check::create([
                "url" => $request->input('URLaddress'),
                "http_code" => $this->check_http_status($request->input('URLaddress')),
                "attempt_number" => $i + 1,
                ]);
                $i++;
            }
            return view('message', ['message' => 'Проверка началась']);

        }
    }
}
