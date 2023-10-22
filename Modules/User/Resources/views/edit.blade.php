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
                                    <i class="fas fa-edit"></i> تعديل بيانات العميل
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" action="{{ route('admin.user.update', ['user' => $user->id]) }}"
                                method="put">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الإسم </label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>البريد الإلكتروني </label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>رقم الموبايل</label>
                                            <input type="text" class="form-control" name="mobile"
                                                value="{{ $user->mobile }}" />
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
                                            <select class="form-control" name="type">
                                                <option value="0" {{ !$user->type ? 'selected' : '' }}>عميل عادي
                                                </option>
                                                <option value="1" {{ $user->type ? 'selected' : '' }}>عميل مميز
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إسم المنشأة </label>
                                            <input type="text" class="form-control" name="facility_name"
                                                value="{{ $user->facility_name }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>رقم المنشأة </label>
                                            <input type="text" class="form-control" name="facility_number"
                                                value="{{ $user->facility_number }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>المحافظة </label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ $user->city }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>المنطقة </label>
                                            <input type="text" class="form-control" name="district"
                                                value="{{ $user->district }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إسم الشارع </label>
                                            <input type="text" class="form-control" name="street"
                                                value="{{ $user->street }}" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>رقم الدور </label>
                                            <input type="text" class="form-control" name="floor"
                                                value="{{ $user->floor }}" />
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
        </div>
    </main>
@endsection
