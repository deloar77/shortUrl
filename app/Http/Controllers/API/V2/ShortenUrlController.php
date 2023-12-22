<?php

namespace App\Http\Controllers\API\V2;
use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use Illuminate\Http\Request;

class ShortenUrlController extends Controller
{
    public function shortenUrl(Request $request){
         $original_url=$request->input('original_url');
         $oldOriginal_url=ShortUrl::where('original_url',$original_url)->exists();
        //echo $oldOriginal_url;
        
        if($oldOriginal_url==1){
            $Url=ShortUrl::where('original_url',$original_url)->first();
            return response()->json([
                'original_url'=>$original_url,
                'short_url'=>$Url->short_url
            ]);
        } else { 

            $newUrl=ShortUrl::create([
                'original_url'=>$original_url
            ]);

            if($newUrl){
                $shortUrl=base_convert($newUrl->id,10,16);
                $newUrl->update([
                    'short_url'=>$shortUrl
                ]);
            }

            return response()->json([
                'original_url'=>$original_url,
                'short_url'=>$shortUrl
            ]);

        }

       
    }

    public function listOfShortUrl(){
        $shortUrl=ShortUrl::select('short_url')->get();
        return response()->json([
            'short_url'=>$shortUrl
        ]);
    }
}
