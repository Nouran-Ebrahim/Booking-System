<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Service\RoomService;

class RoomController extends Controller
{
    private $roomService;

    public function __construct()
    {
        # By default we are using here auth:api middleware
        $this->middleware('auth:client');
        $this->roomService = new RoomService();

    }
    public function index(Request $request)
    {
        $rooms=$this->roomService->all("api",[],$request->all());

        $data=['payload'=>$rooms];
        return return_msg(true,"Rooms Data",$data);

    }
}
