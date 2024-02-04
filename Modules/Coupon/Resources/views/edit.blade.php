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
                                    <i class="fas fa-plus"></i> كوبونات الخصم
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" action="{{ route('admin.coupon.update', ['coupon' => $coupon->id]) }}"
                                method="put">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>كود الخصم </label>
                                            <input type="text" class="form-control" name="code"
                                                value="{{ $coupon->code }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي حد للإستخدام </label>
                                            <input type="number" class="form-control" name="max_usage"
                                                value="{{ $coupon->max_usage }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>قيمة الخصم (%)</label>
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ $coupon->discount }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>متاح حتي</label>
                                            <input type="datetime-local" class="form-control" name="valid_till"
                                                value="{{ $coupon->valid_till }}" />
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
