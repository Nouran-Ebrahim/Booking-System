<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function __construct()
    {
        # By default we are using here auth:api middleware
        $this->middleware('auth:client');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
        ]);
        if ($validator->fails()) {
            return return_msg(
                false,
                'Validation Errors',
                ['validation_errors' => $validator->getMessageBag()],
                'validation_error'
            );
        }
        $existingBooking = Booking::where('room_id', $request->room_id)
            ->where('client_id', auth('client')->id())
            ->where('status', 'pending')
            ->first();


        if ($existingBooking) {
            $data = ['payload' => []];
            return return_msg(
                false,
                'You already have a pending booking for this room.',
                $data,
                'booking_exists'
            );
        }
        $booking = Booking::create([
            'room_id' => $request->room_id,
            'client_id' => \auth('client')->id(),
        ]);
        $data = ['payload' => $booking];
        return return_msg(
            true,
            'You Booked this room Successfully',
            $data,
        );



    }

}
