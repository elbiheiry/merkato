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
                                    <i class="fas fa-plus"></i> عرض جديد
                                </h3>
                            </div>
                        </div>
                        @can('إنشاء عرض')
                            <div class="col-12">
                                <form class="ajax-form" method="{{ route('admin.offer.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> الصورة</label>
                                                <input type="file" class="jfilestyle" name="image" />
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>الإسم </label>
                                                <input type="text" class="form-control" name="name" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>المنتجات المرتبطة بالعرض </label>
                                                <select class="form-control select2" name="related_products[]" multiple>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                        @endcan

                    </div>
                </div>
            </div>
            <div class="widget">
                <div class="row">
                    <div class="col-12">
                        <div class="widget_title d-flex justify-content-between align-items-center">
                            <h3 class="m-0">
                                <i class="fas fa-list"></i> العروض
                            </h3>
                        </div>
                        <div class="table-responsive">
                            @can('عرض العروض')
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="small-wide">#</th>
                                            <th>الصورة</th>
                                            <th>الإسم</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($offers as $offer)
                                            <tr>
                                                <td class="small-wide">{{ $x }}</td>
                                                <td><img class="img-table" src="{{ $offer->image_path }}" width="150">
                                                </td>
                                                <td>{{ $offer->name }}</td>
                                                <td class="text-center">
                                                    @can('تعديل عرض')
                                                        <a href="{{ route('admin.offer.edit', ['offer' => $offer->id]) }}"
                                                            class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                title="تعديل "></i></a>
                                                    @endcan

                                                    @can('حذف عرض')
                                                        <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                            data-url="{{ route('admin.offer.destroy', ['offer' => $offer->id]) }}"><i
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
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
