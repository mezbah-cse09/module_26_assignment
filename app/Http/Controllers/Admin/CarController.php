<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    function AdminCarPage(){
        return view('pages.admin.car-page');
    }

    function CarCreate(Request $request){

        $img = $request->file('img');
        $t = time();
        $rnd = random_int(1111,9999999);
        $file_name = $img->getClientOriginalName();
        $image_name = "{$t}-{$rnd}-{$file_name}";
        $img_url = "uploads/{$image_name}";

        //upload file
        $img->move(public_path('uploads'),$image_name);

        return Car::create([
            'name' => $request->input('name'),
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'car_type' => $request->input('car_type'),
            'daily_rent_price' => $request->input('daily_rent_price'),
            'availability' => $request->input('availability'),
            'image' => $img_url
        ]);
    }

    function CarDelete(Request $request){
        $car_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete($filePath);
        return Car::where('id',$car_id)->delete();
    }

    function CarById(Request $request){
        $car_id = $request->input('id');
        return Car::where('id',$car_id)->first();
    }

    function CarList(Request $request){
        return Car::get();
    }

    function CarUpdate(Request $request){
        $car_id = $request->input('id');
        $filePath = $request->input('file_path');
        
        if($request->hasFile('img')){
            $img = $request->file('img');
            $t = time();
            $rnd = random_int(1111,9999999);
            $file_name = $img->getClientOriginalName();
            $image_name = "{$t}-{$rnd}-{$file_name}";
            $newFilePath = "uploads/{$image_name}";
            $img->move(public_path('uploads'),$image_name);

            File::delete($filePath);
            $filePath = $newFilePath;
        }
        // dd($filePath);
        return Car::where('id',$car_id)->update([

            'name' => $request->input('name'),
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'car_type' => $request->input('car_type'),
            'daily_rent_price' => $request->input('daily_rent_price'),
            // 'availability' => $request->input('availability'),
            'image' => $filePath

        ]);

    }

    function CarStatusUpdate(Request $request){
        $car_id = $request->input('id');
        $availability = $request->input('availability');
        
        $availability = ($availability===0)?1:0;
        return Car::where('id',$car_id)->update([
            'availability' => $availability
        ]);
    }







}
