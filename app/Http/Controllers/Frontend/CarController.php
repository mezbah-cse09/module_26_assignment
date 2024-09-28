<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarController extends Controller
{
    function CarPage(Request $request)
    {
        $title = "Cars";

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
                    })
                    ->with([
                        'rentals' => function ($query) use ($startDate, $endDate) {
                            // Load rentals for the car within the search period
                            $query->whereBetween('start_date', [$startDate, $endDate])
                                ->orWhereIn('status', ['Canceled', 'Rejected']);
                        }
                    ]);

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
                $availableCars = $availableCars->paginate(5);
            } else {
                $error_msg  = "Start date must be grater or equal Today and less or equal to End Date.";
            }
        } else {
            $error_msg  = "Start date and End Date Required";
        }

        if (isset($startDate) && isset($endDate)) {

            if ($startDate >= $today && $startDate <= $endDate) {
                $availableCars = $availableCars->appends(
                    [
                        'startDate' => "$startDate",
                        'endDate' => "$endDate",
                    ]
                );

                if (isset($type)) {
                    $availableCars = $availableCars->appends(['type' => "$type"]);
                }
                if (isset($brand)) {
                    $availableCars = $availableCars->appends(['brand' => "$brand"]);
                }
                if (isset($model)) {
                    $availableCars = $availableCars->appends(['model' => "$model"]);
                }
                if (isset($year)) {
                    $availableCars = $availableCars->appends(['year' => "$year"]);
                }
                if (isset($min_rent) && isset($max_rent)) {
                    $availableCars = $availableCars->appends(['min_rent' => "$min_rent", 'max_rent' => "$max_rent"]);
                }
                if (isset($daily_rent)) {
                    $availableCars = $availableCars->appends(['daily_rent' => "$daily_rent"]);
                }
            }
        }

        return view('pages.user.car-page', compact([
            'title',
            'startDate',
            'endDate',
            'type',
            'brand',
            'model',
            'year',
            'min_rent',
            'max_rent',
            'daily_rent',
            'error_msg',
            'availableCars'
        ]));
    }

    public function CarFilterData()
    {
        $distinctBrand = Car::distinct()->pluck('brand');
        $distinctModel = Car::distinct()->pluck('model');
        $distinctType = Car::distinct()->pluck('car_type');

        $result = [
            'brand' => $distinctBrand,
            'model' => $distinctModel,
            'car_type' => $distinctType
        ];

        return $result;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
