<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\AdminRequest;
use Modules\Auth\Entities\Admin;
use Modules\Role\Entities\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:عرض مستخدمين لوحة التحكم')->only('index');
        $this->middleware('permission:إضافة مستخدم لوحة التحكم')->only('store');
        $this->middleware('permission:حذف مستخدم لوحة التحكم')->only('destroy');
        $this->middleware('permission:عرض مستخدم لوحة التحكم')->only('edit');
        $this->middleware('permission:تحديث مستخدم لوحة التحكم')->only('update');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Role::select('id' , 'name')->orderBy('id' , 'desc')->get();
        $admins = Admin::with('roles')
                    ->orderByDesc('id')
                    ->paginate(10);

        return view('admin::index' , [
            'roles' => $roles,
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param AdminRequest $request
     * @return Renderable
     */
    public function store(AdminRequest $request)
    {
        try {
            $admin = new Admin();

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);

            $admin->save();
            $admin->syncRoles($request->get('role'));

            $url = route('admin.admin.index');

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
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Admin $admin
     * @return Renderable
     */
    public function edit(Admin $admin)
    {
        $roles = Role::select('id' , 'name')->orderBy('id' , 'desc')->get();

        return view('admin::edit' , [
            'admin' => $admin,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminRequest  $request
     * @param  Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        try {
            $data = $request->except('password');

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $admin->update($data);
            $admin->syncRoles($request->get('role'));

            $url = route('admin.admin.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Admin $admin
     * @return Renderable
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->back();
    }
}
