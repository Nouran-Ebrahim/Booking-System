<?php


namespace Service;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class BookingService
{

    private $bookingModel;


    public function __construct()
    {
        $this->bookingModel = new Booking();
    }

    public function create(array $data)
    {

        try {



            $item = $this->bookingModel->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function update($id, array $data )
    {
        try {
            $item = $this->find($id);
            $item->status = $data["status"];
            $item->save();


            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function all($relation = [])
    {
        // dd(1);
        try {
            $items = $this->bookingModel->orderBy('created_at', 'asc')->get();
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->bookingModel->where('id', $id)->first();
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function delete($id)
    {
        // dd($id);
        try {
            $item = $this->bookingModel->find($id);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
