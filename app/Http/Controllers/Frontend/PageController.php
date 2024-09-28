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

    function ContactPage()
    {
        $title = "Contact Us";
        return view('pages.user.contact-page', compact(['title']));
    }

    function AboutPage()
    {
        $title = "About";
        return view('pages.user.about-page', compact(['title']));
    }

    function ServicePage()
    {
        $title = "Service";
        return view('pages.user.service-page', compact(['title']));
    }
}
