<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Content;
use App\Models\TicketPrice;

class LandingPageController extends Controller
{
    public function index()
    {

        $facilities = Facility::all();
        $contents = Content::all();
        $ticketPrices = TicketPrice::all();


        return view('landingPage', compact('facilities', 'contents', 'ticketPrices'));
    }
}
