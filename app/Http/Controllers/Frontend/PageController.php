<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function bookingPage()
    {
        $title = "My Bookings";
        return view('pages.user.booking-page', compact(['title']));
    }
}
