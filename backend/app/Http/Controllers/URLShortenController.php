<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\URLShorten;
use Illuminate\Support\Facades\Redirect;

class URLShortenController extends Controller
{
    public function getShorten(Request $request){
        $url = $request->input('url');

        $shorten = URLShorten::create([
            'url' => $url,
        ]);
        return $shorten->id;
    }
    public function getUrl(string $id){
        $urlShortened = URLShorten::find($id);
        $urlShortened->update([
           'counter' => $urlShortened->counter + 1
        ]);

        return Redirect::to($urlShortened->url);
    }
}
