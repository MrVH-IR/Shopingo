<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::simplePaginate(10);
        return view('admin.user.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user.role.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                "name" => $request->name,
                "description" => $request->description,
                "status" => $request->status,
            ]);
            $role->permissions()->sync($request->permissions ?? []);
            DB::commit();
            return redirect()->route('admin.user.role.index')->with('swal-success', "کاربر مورد نظر ساخته شد $role->name");
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception $errorID" , (array)$e->getMessage());
            return redirect()->back()->with('swal-error', $errorID);
        }
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
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.role.edit' , compact('role' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->update([
                "name"  => $request->name,
                "description"  => $request->description,
                "status" => $request->status,
            ]);
            $role->permissions()->sync($request->permissions ?? []);
            DB::commit();
            return redirect()->route('admin.user.role.index')
                ->with('swal-success' , "دسترسی با موفقیت به کاربر $role->name داده شد");
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception: $errorID" , (array)$e->getMessage());
            return redirect()->route('admin.user.role.edit' , $errorID);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.user.role.index')
            ->with('swal-success' , 'نقش مورد نظر با موفقیت حذف شد');
    }

    public function status(Role $role)
    {
        return $this->changeStatus($role);
    }
}
