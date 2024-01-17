@extends('layouts.master')
@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            @can('عرض مستخدمين لوحة التحكم')
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="row">
                            <div class="col-12">
                                <div class="widget_title d-flex justify-content-between align-items-center">
                                    <h3 class="m-0">
                                        <i class="fas fa-plus"></i> مستخدم جديد
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <form class="ajax-form" method="{{ route('admin.admin.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الإسم </label>
                                                <input type="text" class="form-control" name="name" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>البريد الإلكتروني </label>
                                                <input type="email" class="form-control" name="email" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الرقم السري </label>
                                                <input type="password" class="form-control" name="password" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الدور</label>
                                                <select class="form-control select2" name="role">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="link"><span> حفظ</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('عرض الأدوار')
                <div class="widget">
                    <div class="row">
                        <div class="col-12">
                            <div class="widget_title d-flex justify-content-between align-items-center">
                                <h3 class="m-0">
                                    <i class="fas fa-list"></i> المستخدمين
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="small-wide">#</th>
                                            <th>الإسم</th>
                                            <th>الدور</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($admins as $index => $admin)
                                            <tr>
                                                <td class="small-wide">{{ $x }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->roles[0]['name'] }}</td>
                                                <td class="text-center">
                                                    @can('عرض مستخدم لوحة التحكم')
                                                        <a href="{{ route('admin.admin.edit', ['admin' => $admin->id]) }}"
                                                            class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                title="تعديل "></i></a>
                                                    @endcan

                                                    @can('حذف مستخدم لوحة التحكم')
                                                        <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                            data-url="{{ route('admin.admin.destroy', ['admin' => $admin->id]) }}"><i
                                                                class="fas fa-trash"></i></a>
                                                    @endcan

                                                </td>
                                            </tr>
                                            @php
                                                $x++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            @endcan

        </div>
    </main>
@endsection
