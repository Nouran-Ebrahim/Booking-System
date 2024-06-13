<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pendingBooking=Booking::where('status','pending')->count();
        $rejectBooking=Booking::where('status','reject')->count();
        $approveBooking=Booking::where('status','approve')->count();

        return view('home',compact('pendingBooking','rejectBooking','approveBooking'));
    }
}
