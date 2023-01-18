<?php

namespace Tasmir\LaravelMedia\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tasmir\LaravelMedia\LaravelMedia;

class LaravelMediaController extends Controller
{
//    public function __invoke(LaravelMedia $inspire) {
//        $quote = $inspire->justDoIt();
//
//        return view('inspire::index', compact('quote'));
//    }
    public function index()
    {
        $quote = "";
        return view('inspire::index', compact('quote'));
    }
}
