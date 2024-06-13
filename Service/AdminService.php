<?php


namespace Service;

use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminService
{

    private $adminModel;


    public function __construct()
    {
        $this->adminModel = new User();
    }

    public function create(array $data)
    {

        try {



            $item = $this->adminModel->create([
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

    public function update($id, array $data)
    {
        try {
            $item=$this->find($id);
            $item->update([
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

    public function all($relation = [])
    {
        // dd(1);
        try {
            $items = $this->adminModel->get();
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->adminModel->where('id', $id)->first();
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
            $item = $this->adminModel->find($id);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
