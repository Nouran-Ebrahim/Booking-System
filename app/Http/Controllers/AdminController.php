<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\AdminRequest;
use Service\AdminService;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $adminService;
    public function __construct()
    {
        $this->middleware('permission:Index-admin|Create-admin|Edit-admin|Delete-admin', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create-admin', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit-admin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete-admin', ['only' => ['destroy']]);
        $this->adminService = new AdminService();

    }
    public function index()
    {

        $admins = $this->adminService->all();
        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('admins.create', compact("roles"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $admin = $this->adminService->create($request->validated());

        $role = Role::where('id', $request->role)->first();
        $admin->assignRole($role);
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
        $admin = $this->adminService->find($id);
        $roles = Role::get();
        $userRole = $admin->roles->pluck('name', 'name')->all();
        return view('admins.edit', compact('admin', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin=$this->adminService->update($id,$request->validated());

        DB::table('model_has_roles')->where('model_id', $id)->where('model_type', User::class)->delete();
        $role = Role::where('id', $request->role)->first();
        $admin->assignRole($role);
        session()->flash('success', 'Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminService->delete($id);
    }
}
