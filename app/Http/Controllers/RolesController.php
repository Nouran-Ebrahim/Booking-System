<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Service\RolesService;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $roleService;

    public function __construct()
    {
        $this->middleware('permission:Index-role|Create-role|Edit-role|Delete-role', ['only' => ['index','store']]);
        $this->middleware('permission:Create-role', ['only' => ['create','store']]);
        $this->middleware('permission:Edit-role', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete-role', ['only' => ['destroy']]);
        $this->roleService = new RolesService();

    }
    public function index()
    {
        $roles=$this->roleService->all();
        // dd($roles);
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get()->groupBy('category');
        return view('roles.create',['cat_permissions' => $permissions]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->roleService->create($request->validated());

        $role->syncPermissions($request['permission']);
        session()->flash('success', 'Added Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $role=$this->roleService->find($id);
        $permissions = Permission::get()->groupBy('category');
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',['role' => $role,'cat_permissions' => $permissions,'rolePermissions' => $rolePermissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $role=$this->roleService->update($id,$request->validated());
        $role->syncPermissions($request['permission']);
        session()->flash('success', 'Update Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd(1);
        $this->roleService->delete($id);
    }
}
