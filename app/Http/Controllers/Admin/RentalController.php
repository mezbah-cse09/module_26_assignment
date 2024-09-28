<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Mail\RentMail;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    //

    function availableCarForRent(Request $request)
    {

        $today = Carbon::today()->toDateString();

        $startDate = request('startDate');
        $endDate = request('endDate');
        $type = request('type');
        $brand = request('brand');
        $model = request('model');
        $year = request('year');
        $min_rent = request('min_rent');
        $max_rent = request('max_rent');
        $daily_rent = request('daily_rent');

        $availableCars = '';
        $error_msg = '';

        if (isset($startDate) && isset($endDate)) {
            // dd($startDate >= $today);
            if ($startDate >= $today && $startDate <= $endDate) {

                $availableCars = Car::where('availability', 1)  // Apply availability filter globally
                    ->where(function ($query) use ($startDate, $endDate) {
                        // Group the whereDoesntHave and orWhereHas conditions to avoid conflicting with availability
                        $query->whereDoesntHave('rentals', function ($query) use ($startDate, $endDate) {
                            // Check if the car has rentals that overlap the search period with statuses that are not 'Canceled' or 'Rejected'
                            $query->where('start_date', '<=', $endDate)
                                ->where('end_date', '>=', $startDate)
                                ->whereNotIn('status', ['Canceled', 'Rejected']);
                        })
                            ->orWhereHas('rentals', function ($query) use ($startDate, $endDate) {
                                // Check if the car has rentals with status 'Canceled' or 'Rejected' during the search period
                                $query->where('start_date', '<=', $endDate)
                                    ->where('end_date', '>=', $startDate)
                                    ->whereIn('status', ['Canceled', 'Rejected']);
                            });
                    });

                if (isset($type)) {
                    $availableCars->where('car_type', $type);
                }
                if (isset($brand)) {
                    $availableCars->where('brand', $brand);
                }
                if (isset($model)) {
                    $availableCars->where('model', $model);
                }
                if (isset($year)) {
                    $availableCars->where('year', operator: $year);
                }
                if (isset($min_rent) && isset($max_rent)) {
                    $availableCars->whereBetween('daily_rent_price', [$min_rent, $max_rent]);
                }
                if (isset($daily_rent)) {
                    $availableCars->where(
                        'daily_rent_price',
                        '<=',
                        $daily_rent
                    );
                }
                $availableCars = $availableCars->get();
            } else {
                $error_msg  = "Start date must be grater or equal Today and less or equal to End Date.";
            }
        } else {
            $error_msg  = "Start date and End Date Required";
        }

        if (!is_string($availableCars)) {
            return ResponseHelper::Out('success', $availableCars, 200);
        } else {
            return ResponseHelper::Out('fail', $availableCars, 200);
        }
    }

    public function RentalList(Request $request)
    {
        return Rental::with('car', 'user')->get();
    }

    public function RentalCreate(Request $request)
    {
        $rent = Rental::create([
            'user_id' => $request->input('user_id'),
            'car_id' => $request->input('car_id'),
            'total_cost' => $request->input('total_cost'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => 'Processing'
        ]);

        Mail::to('mezbah.cse09@gmail.com')->send(new RentMail($rent));
        Mail::to($rent['user']['email'])->send(new RentMail($rent));
        return $rent;
    }

    public function RentalUpdate(Request $request)
    {
        $rental_id = $request->input('id');
        $status = $request->input('status');

        return Rental::where('id', $rental_id)
            ->where('status', 'Processing')
            ->orWhere('status', 'Started')
            ->update([
                'status' => $status
            ]);
    }

    function RentalDelete(Request $request)
    {
        $id = $request->input('id');
        return Rental::where('id', $id)->delete();
    }

    function RentalById(Request $request)
    {
        $id = $request->input('id');

        $rent = Rental::with('car', 'user')->where('id', $id)->get();
        return $rent;
    }
}
