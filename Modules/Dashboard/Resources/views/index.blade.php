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
                            <h3 class="m-0"><i class="far fa-chart-bar"></i> الإحصائيات</h3>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="counter">
                            <h3>عدد الأقسام</h3>
                            <span> {{ $categories }} </span>
                            <i class="fas fa-list"></i>
                        </div>
                    </div>
                    <!--End Col-->
                    <div class="col-lg-4 col-md-6">
                        <div class="counter">
                            <h3>عدد المستخدمين</h3>
                            <span> {{ $users }} </span>
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <!--End Col-->
                    <div class="col-lg-4 col-md-6">
                        <div class="counter">
                            <h3>عدد المنتجات</h3>
                            <span> {{ $products }} </span>
                            <i class="fab fa-product-hunt"></i>
                        </div>
                    </div>
                    <!--End Col-->
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="counter">
                            <h3>عدد كوبونات الخصم</h3>
                            <span> {{ $coupons }} </span>
                            <i class="fas fa-percent"></i>
                        </div>
                    </div>
                    <!--End Col-->
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="counter">
                            <h3>عدد الطلبات</h3>
                            <span> {{ $orders }} </span>
                            <i class="fas fa-info"></i>
                        </div>
                    </div>
                    <!--End Col-->
                </div>
            </div>
            <div class="widget">
                <div class="row">
                    <div class="col-12">
                        <div class="widget_title d-flex justify-content-between align-items-center">
                            <h3 class="m-0">
                                <i class="fas fa-list"></i> اخر الطلبات
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="small-wide">#</th>
                                        <th>المستخدم</th>
                                        <th>العنوان</th>
                                        <th>الإجمالي</th>
                                        <th>قيمة الخصم</th>
                                        <th>المنتجات</th>
                                        <th>الحالة</th>
                                        <th>تاريخ الطلب</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($last_orders as $order)
                                        <tr style="background-color:{{ $order->status == 'delivered' ? '#1be71b' : '' }}">
                                            <td class="small-wide">{{ $x }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>
                                                {{ $order->address->region }},
                                                {{ $order->address->area }},
                                                {{ $order->address->address }},
                                                {{ $order->address->facility }},
                                                {{ $order->address->floor }}
                                            </td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->coupon_discount }}</td>
                                            <td>
                                                @foreach ($order->items as $item)
                                                    {{ $item->product->name }} x {{ $item->quantity }} <br />
                                                @endforeach
                                            </td>
                                            <form method="post"
                                                action="{{ route('admin.order.update', ['order' => $order->id]) }}">
                                                @csrf
                                                @method('put')
                                                <td>
                                                    @if ($order->status == 'preparing')
                                                        <select class="form-control" name="status">
                                                            <option value="preparing" selected>{{ $order->getStatus() }}
                                                            </option>
                                                            <option value="delivered">تم التسليم</option>
                                                        </select>
                                                    @else
                                                        {{ $order->getStatus() }}
                                                    @endif

                                                </td>
                                                <td>{{ $order->created_at }}</td>
                                                <td class="text-center">
                                                    @if ($order->status != 'delivered')
                                                        <button type="submit" class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip"
                                                                data-placement="top" title="تعديل "></i>
                                                        </button>
                                                    @endif

                                                    <a href="{{ route('admin.order.show', ['order' => $order->id]) }}"
                                                        class="icon" title="عرض"><i class="fas fa-eye"></i></a>

                                                    <a href="javascript:;" class="icon delete-btn"
                                                        style="background-color:red"
                                                        data-url="{{ route('admin.order.destroy', ['order' => $order->id]) }}"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </form>
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
        </div>
    </main>
@endsection
