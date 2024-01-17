<?php

namespace Modules\Permission\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Permission\Http\Requests\PermissionRequest;
use Modules\Permission\Transformers\PermissionResource;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $permissions = Permission::select('id' , 'name' , 'created_at')
                        ->orderByDesc('id')
                        ->paginate(10)
                        ->through(function ($permission) {
                            return [
                                'id' => $permission->id,
                                'name' => $permission->name,
                                'created_at' => $permission->created_at->format('d-m-Y'),
                            ];
                        });

        return view('permission::index' , ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('permission::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        try {
            Permission::create($request->all());

            $url = route('admin.permission.index');
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
        return view('permission::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Permission $permission
     * @return Renderable
     */
    public function edit(Permission $permission)
    {
        return view('permission::edit' , ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionRequest  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $permission->update($request->all());

            $url = route('admin.permission.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->back();
    }
}
