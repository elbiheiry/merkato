@extends('layouts.master')
@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            @can('إنشاء دور')
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="row">
                            <div class="col-12">
                                <div class="widget_title d-flex justify-content-between align-items-center">
                                    <h3 class="m-0">
                                        <i class="fas fa-plus"></i> دور جديد
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <form class="ajax-form" method="{{ route('admin.role.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الدور </label>
                                                <input type="text" class="form-control" name="name" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الصلاحيات</label>
                                                <select class="form-control select2" name="permission[]" multiple>
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission['name'] }}">{{ $permission['name'] }}
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
                                    <i class="fas fa-list"></i> الأذونات
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="small-wide">#</th>
                                            <th>الإسم</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td class="small-wide">{{ $x }}</td>
                                                <td>{{ $role['name'] }}</td>
                                                <td class="text-center">
                                                    @can('عرض دور')
                                                        <a href="{{ route('admin.role.edit', ['role' => $role['id']]) }}"
                                                            class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                title="تعديل "></i></a>
                                                    @endcan

                                                    @can('حذف دور')
                                                        <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                            data-url="{{ route('admin.role.destroy', ['role' => $role['id']]) }}"><i
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
