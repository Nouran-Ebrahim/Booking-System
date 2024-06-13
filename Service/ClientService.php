<?php


namespace Service;

use App\Models\Client;
use Illuminate\Support\Facades\DB;


class ClientService
{

    private $clientModel;


    public function __construct()
    {
        $this->clientModel = new Client();
    }

    public function create(array $data)
    {

        try {



            $item = $this->clientModel->create([
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

    public function update($client, array $data)
    {
        try {

            $client->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);


        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function all($relation = [])
    {
        // dd(1);
        try {
            $items = $this->clientModel->get();
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->clientModel->where('id', $id)->first();
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function delete($client)
    {
        // dd($id);
        try {

            $client->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
