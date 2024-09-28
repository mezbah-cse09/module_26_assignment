<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardDetail(Request $request)
    {
        $car = Car::count();
        $availableCar = Car::where('availability', 1)->count();
        $user = User::where('role', 'Customer')->count();
        $totalRent = Rental::where('status', 'Completed')->sum('total_cost');
        $completedRent = Rental::where('status', 'Completed')->count();

        $res = [
            'car' => $car,
            'availableCar' => $availableCar,
            'user' => $user,
            'totalRent' => $totalRent,
            'completedRent' => $completedRent
        ];
        return $res;
    }
}
