<?php

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{he}', function () {
      $request=($_SERVER['REQUEST_URI']);
      //dd($request);
      $re=explode("/",$request);
     // print_r($re[1]);
      $shortUrl=ShortUrl::where('short_url',$re[1])->first();
     // dd($shortUrl);
      if($shortUrl!==null){
        //dd($shortUrl);
        $shortUrl->increment('visits');
        return redirect()->to(url($shortUrl->original_url));
    
        
      }
      return view('welcome');
      

  
});

