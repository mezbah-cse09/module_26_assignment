<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\RentMail;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    public function RentalCreate(Request $request)
    {
        $user_id = $request->header('id');
        $rent = Rental::create([
            'user_id' => $user_id,
            'car_id' => $request->input('car_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'total_cost' => $request->input('total_cost'),
            'status' => 'Processing'
        ]);

        Mail::to('mezbah.cse09@gmail.com')->send(new RentMail($rent));
        Mail::to($rent['user']['email'])->send(new RentMail($rent));

        return $rent;
    }
    public function RentalUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $rental_id = $request->input('id');

        return Rental::where('user_id', $user_id)
            ->where('id', $rental_id)->where('status', 'Processing')
            ->update([
                'status' => 'Canceled'
            ]);
    }

    public function RentalList(Request $request)
    {
        $user_id = $request->header('id');

        return Rental::where('user_id', $user_id)
            ->with('car')
            ->get();
    }

    public function RentalById(Request $request)
    {
        $user_id = $request->header('id');
        $rental_id = $request->input('id');

        return Rental::where('user_id', $user_id)->where('id', $rental_id)
            ->with('car')
            ->get();
    }
}
