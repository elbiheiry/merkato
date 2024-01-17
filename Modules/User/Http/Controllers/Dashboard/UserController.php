<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\User;
use Modules\Type\Entities\Type;
use Modules\User\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:عرض المستخدمين')->only('index');
        $this->middleware('permission:إنشاء مستخدم')->only('store');
        $this->middleware('permission:عرض مستخدم')->only('edit');
        $this->middleware('permission:تعديل مستخدم')->only('update');
        $this->middleware('permission:حذف مستخدم')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = app(Pipeline::class)
            ->send(User::select(['id','name','type_id','email','mobile']))
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate(15);
        $types = Type::all('id' , 'name');

        return view('user::index' , [
            'users' => $users,
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param UserRequest $request
     * @return Renderable
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();

            $data['password'] = Hash::make($request->password);

            User::create($data);

            return add_response(route('admin.user.index'));
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
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable
     */
    public function edit(User $user)
    {
        $types = Type::all('id' , 'name');

        return view('user::edit' , [
            'user' => $user,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UserRequest $request
     * @param User $user
     * @return Renderable
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->all();

            if ($request->has('password')) {
                $data['password'] = Hash::make($request->password);
            }
        
            $user->update($data);

            return update_response(route('admin.user.index'));
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
