<?php


namespace Service;

use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Functions\UploaderHelper;
use Illuminate\Support\Facades\File;


class RoomService
{
    use UploaderHelper;

    private $roomModel;


    public function __construct()
    {
        $this->roomModel = new Room();
    }

    public function create(array $data)
    {

        try {



            $item = $this->roomModel->create($data);
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $imageName = $this->upload($image, 'rooms');
                $item->image = $imageName;
                $item->save();

            }
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function update($room, array $data)
    {
        try {
            $room->update($data);
            if (request()->hasFile('image')) {
                File::delete(public_path('uploads/rooms/' . $this->getImageName('rooms', $room->image)));
                $image = request()->file('image');
                $imageName = $this->upload($image, 'rooms');
                $room->image = $imageName;
                $room->save();
            }

            return $room;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }
    public function roomsChangeStatus($id, array $data)
    {
        try {
            $item = $this->find($id);
            $item->status = $data['status'];
            $item->save();
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }
    public function all($type = "web", $relation = [], array $data = [])
    {
        // dd(1);
        try {
            if ($type == "api") {
                $items = $this->roomModel->when($data['title'] ?? null, function ($q) use ($data) {
                    $q->where('title', 'like', '%' . $data['title'] . '%');
                })->where('status', "available")->get();
            } else {
                $items = $this->roomModel->when(request('title') ?? null, function ($q) {
                    $q->where('title', 'like', '%' . request('title') . '%');
                })->get();
            }

            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->roomModel->where('id', $id)->first();
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function delete($room)
    {
        // dd($id);
        try {

            $room->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
