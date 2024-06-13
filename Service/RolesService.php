<?php


namespace Service;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class RolesService
{

    private $roleModel;
    private $permissionModel;

    public function __construct()
    {
        $this->roleModel = new Role();
        $this->permissionModel = new Permission();
    }

    public function create(array $data)
    {

        try {

            $item = $this->roleModel->create([
                'name' => $data['name'],
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
            $item = $this->find($id);
            $item->name = $data["name"];
            $item->save();
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function all($relation = [])
    {

        try {
            $items = $this->roleModel->get();
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->roleModel->where('id', $id)->first();
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
            $item = $this->roleModel->find($id);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
