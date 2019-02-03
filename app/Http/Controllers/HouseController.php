<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    public function search(Request $request){

      if($request->isMethod('post')){
        $result = DB::table('houses');
        if($request->filled('name'))  $result->where('name','like','%' . $request->input('name').'%');
        if($request->filled('bedrooms'))  $result->where('bedrooms','=',$request->input('bedrooms'));
        if($request->filled('bathrooms'))  $result->where('bathrooms','=',$request->input('bathrooms'));
        if($request->filled('garages'))  $result->where('garages','=',$request->input('garages'));
        if($request->filled('pricefrom'))  $result->where('price','>=',$request->input('pricefrom'));
        if($request->filled('priceto'))  $result->where('price','<=',$request->input('priceto'));

        // return dd($result->toSQL());
        $data = $result->get();
        return $data->toArray();
      }

    }
    public function getall() {
      $houses = House::all();

      return $houses->toArray();
    }
}
