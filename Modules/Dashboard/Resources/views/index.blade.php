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
                </div>
            </div>
        </div>
    </main>
@endsection
