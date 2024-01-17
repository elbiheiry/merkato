<?php

namespace Modules\Role\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\RoleRequest;
use Modules\Role\Transformers\RoleResource;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller  
{
    public function __construct()
    {
        $this->middleware('permission:عرض الأدوار')->only('index');
        $this->middleware('permission:إنشاء دور')->only('store');
        $this->middleware('permission:حذف دور')->only('destroy');
        $this->middleware('permission:عرض دور')->only('edit');
        $this->middleware('permission:تحديث دور')->only('update');  
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $permissions = Permission::select('id' , 'name')->orderByDesc('id')->get()->map(function ($permission) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
            ];
        });

        $roles = Role::get()->map(function ($query) {
            return [
                'id' => $query->id,
                'name' => $query->name,
                'created_at' => $query->created_at->format('d-m-Y'),
            ];
        });
        
        return view('role::index' ,[
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('role::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param RoleRequest $request
     * @return Renderable
     */
    public function store(RoleRequest $request)
    {
        try {
            $role = Role::create(['name' => $request->get('name')]);
            $role->syncPermissions($request->get('permission'));

            $url = route('admin.role.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::all()->sortByDesc('id');

        return view('role::edit' ,[
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role->update($request->only('name'));

            if ($request->has('permission')) {
                $role->syncPermissions($request->get('permission'));
            }

            $url = route('admin.role.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Role $role
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back();
    }
}
