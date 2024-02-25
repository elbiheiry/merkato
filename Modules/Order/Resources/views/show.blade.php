@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="widget">
                <div class="row">
                    <div class="col-12">
                        <div class="widget_title d-flex justify-content-between align-items-center">
                            <h3 class="m-0"><i class="far fa-chart-bar"></i> بيانات الطلب</h3>
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="counter">
                            <h3>الإسم</h3>
                            <span> {{ $order->user->name }} </span>
                            <i class="fas fa-info"></i>
                        </div>
                    </div>
                    <!--End Col-->
                    <div class="col-lg-4 col-md-6">
                        <div class="counter">
                            <h3>قيمة الطلب </h3>
                            <span> {{ $order->total }} </span>
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <!--End Col-->
                    <div class="col-lg-4 col-md-6">
                        <div class="counter">
                            <h3>قيمة الخصم (إن وجدت )</h3>
                            <span> {{ $order->coupon_discount }} </span>
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <!--End Col-->
                </div>
            </div>
            <div class="widget">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="small-wide">#</th>
                                        <th>المنتج</th>
                                        <th>القيمة</th>
                                        <th>العدد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="small-wide">{{ $x }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                        @php
                                            $x++;
                                        @endphp
                                    @endforeach
                                        <tr>
                                            <td>الملاحظات</td>
                                            <td>{{ $order->notes }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
