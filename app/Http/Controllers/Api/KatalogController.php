<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogController extends Controller 
{
    public function index(Request $request) {
        $limit = is_null($request->input('limit'))?10:$request->input('limit');
        $offset = is_null($request->input('offset'))?0:$request->input('offset');
        $city = is_null($request->input('city'))?499099:$request->input('city');

        return \App\Models\Kalyan\Shop::where('city_id','=',$city)
                ->select('seo_translit as translit','address','seo_desc as desc','name')
                ->offset($offset)->limit($limit)
                ->get()->toJson();
    }
}
