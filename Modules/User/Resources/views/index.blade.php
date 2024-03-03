@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="col-lg-12">
                @can('إنشاء مستخدم')
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
                                <form class="ajax-form" action="{{ route('admin.user.store') }}" method="post">
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
                                                <label>رقم الموبايل</label>
                                                <input type="text" class="form-control" name="mobile" />
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
                                                <label>النوع </label>
                                                <select class="form-control" name="type_id">
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>إسم المنشأة </label>
                                                <input type="text" class="form-control" name="facility_name" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>رقم المنشأة </label>
                                                <input type="text" class="form-control" name="facility_number" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>المحافظة </label>
                                                <input type="text" class="form-control" name="city" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>المنطقة </label>
                                                <input type="text" class="form-control" name="district" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>إسم الشارع </label>
                                                <input type="text" class="form-control" name="street" />
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>رقم الدور </label>
                                                <input type="text" class="form-control" name="floor" />
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
                @endcan

            </div>
            <div class="widget">
                <div class="row">
                    @can('عرض المستخدمين')
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
                                            <th>البريد الإلكتروني</th>
                                            <th>رقم الموبايل</th>
                                            <th>النوع</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="small-wide">{{ $x }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->mobile }}</td>
                                                <td>{{ $user?->type?->name }}</td>
                                                <td class="text-center">
                                                    @can('تعديل مستخدم')
                                                        <a href="{{ route('admin.user.status', ['user' => $user->id]) }}"
                                                            class="icon"
                                                            style="background-color : {{ $user->block_status ? 'green' : 'black' }}">
                                                            <i class="fas fa-{{ $user->block_status ? 'check' : 'ban' }}"
                                                                title="{{ $user->block_status ? 'فك الحذر' : 'حذر' }}"></i>
                                                        </a>
                                                        <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                                            class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                title="تعديل "></i></a>
                                                    @endcan
                                                    @can('حذف مستخدم')
                                                        <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                            data-url="{{ route('admin.user.destroy', ['user' => $user->id]) }}"><i
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
                                <div class="mt-5">
                                    {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </main>
@endsection
