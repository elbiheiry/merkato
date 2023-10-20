@extends('layouts.master')

@section('content')
    <div class="login_wrap">
        <div class="login_form d-block w-100">
            <form method="post" action="{{ route('admin.login') }}">
                @csrf
                <img src="{{ aurl('images/logo.png') }}" alt="logo" class="logo" />
                <h3>تسجيل دخول</h3>
                <div class="form-group">
                    <label>إسم المستخدم </label>
                    <input type="text" name="name" class="form-control" />
                    @error('name')
                        <div id="error-name" class="login__input-error text-danger mt-2">
                            {{ $errors->first('name') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" class="form-control" />
                    @error('password')
                        <div id="error-password" class="login__input-error text-danger mt-2">
                            {{ $errors->first('password') }}
                        </div>
                    @enderror
                </div>
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <button class="link">
                        <span>تسجيل دخول </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
