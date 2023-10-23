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
                            <form class="ajax-form" action="{{ route('admin.coupon.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>كود الخصم </label>
                                            <input type="text" class="form-control" name="code" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي حد للإستخدام </label>
                                            <input type="number" class="form-control" name="max_usage" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>قيمة الخصم</label>
                                            <input type="number" class="form-control" name="discount" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>متاح حتي</label>
                                            <input type="datetime-local" class="form-control" name="valid_till" />
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
            <div class="widget">
                <div class="row">
                    <div class="col-12">
                        <div class="widget_title d-flex justify-content-between align-items-center">
                            <h3 class="m-0">
                                <i class="fas fa-list"></i> كوبونات الخصم
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="small-wide">#</th>
                                        <th>الكود</th>
                                        <th>عدد مرات الإستخدام</th>
                                        <th>أقصي حد للإستخدام</th>
                                        <th>متاح حتي</th>
                                        <th>قيمة الخصم</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($coupons as $coupon)
                                        <tr>

                                            <td class="small-wide">{{ $x }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->usage_count }}</td>
                                            <td>{{ $coupon->max_usage }}</td>
                                            <td>{{ $coupon->valid_till ?? 'غير محدد' }}</td>
                                            <td>{{ $coupon->discount }}</td>

                                            <td class="text-center">
                                                <a href="{{ route('admin.coupon.edit', ['coupon' => $coupon->id]) }}"
                                                    class="icon">
                                                    <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                        title="تعديل "></i></a>

                                                <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                    data-url="{{ route('admin.coupon.destroy', ['coupon' => $coupon->id]) }}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $x++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $coupons->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
