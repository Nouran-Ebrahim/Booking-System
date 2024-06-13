<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Functions\UploaderHelper;
use Service\BookingService;

class BookingController extends Controller
{
    private $bookingService;

    public function __construct()
    {
        $this->middleware('permission:Index-booking', ['only' => ['index']]);
        $this->bookingService = new BookingService();

    }
    public function index()
    {
        $bookings = $this->bookingService->all([
            'room',
            'client'
        ]);

        return view('bookings.index', compact('bookings'));
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
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $booking=$this->bookingService->update($request->booking_id,$request->all());

        if ($request->status == "approve") {
            $booking->room()->update(['status' => "booked"]);
        } elseif ($request->status == "reject") {
            $booking->room()->update(['status' => "available"]);
        } else {
            $booking->room()->update(['status' => "pending"]);
        }
        session()->flash('success', 'Updated Successfully');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
