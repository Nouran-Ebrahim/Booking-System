<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreRoomRequest;
use App\Http\Requests\Admin\UpdateRoomRequest;
use App\Functions\UploaderHelper;
use Illuminate\Support\Facades\File;
use Service\RoomService;

class RoomController extends Controller
{
    use UploaderHelper;
    /**
     * Display a listing of the resource.
     */
    private $roomService;

    public function __construct()
    {
        $this->middleware('permission:Index-room|Create-room|Edit-room|Delete-room', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create-room', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit-room', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete-room', ['only' => ['destroy']]);
        $this->roomService = new RoomService();

    }
    public function index()
    {
        $rooms = $this->roomService->all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        // dd($request->all());
        $room = $this->roomService->create($request->validated());
        session()->flash('success', 'Added Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room = $this->roomService->update($room, $request->validated());

        session()->flash('success', 'Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $this->roomService->delete($room);

    }
    public function roomsChangeStatus(Request $request)
    {
        $room = $this->roomService->roomsChangeStatus($request->room_id, $request->all());
        session()->flash('success', 'Status Changed Successfully');

        return redirect()->back();

    }
}
