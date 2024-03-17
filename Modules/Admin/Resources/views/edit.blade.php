@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="row">
                        <div class="col-12">
                            <div class="widget_title d-flex justify-content-between align-items-center">
                                <h3 class="m-0">
                                    <i class="fas fa-plus"></i> تعديل مستخدم
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" action="{{ route('admin.admin.update', ['admin' => $admin->id]) }}"
                                method="put">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الإسم </label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $admin->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>البريد الإلكتروني </label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $admin->email }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الرقم السري </label>
                                            <input type="password" class="form-control" name="password" />
                                        </div>
                                    </div>
                                    @can('تحديث الدور الخاص بالمستخدم')
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الدور</label>
                                                <select class="form-control select2" name="role">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ $admin->roles()->exists() ? ($admin->roles[0]['name'] == $role->name ? 'selected' : '') : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endcan
                                    <div class="col-12">
                                        <button class="link"><span> حفظ</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
