<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomePage()
    {
        return view('pages.user.home-page');
    }
    function AdminDashPage()
    {
        return view('pages.admin.home-page');
    }

    function AdminCarPage()
    {
        return view('pages.admin.car-page');
    }
    function AdminCustomerPage()
    {
        return view('pages.admin.customer-page');
    }
    function AdminRentalPage()
    {
        return view('pages.admin.rental-page');
    }
    function AdminRentalCreatePage()
    {
        return view('pages.admin.rental-create-page');
    }
}
