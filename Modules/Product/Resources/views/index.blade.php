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
                                    <i class="fas fa-plus"></i> منتج جديد
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" method="{{ route('admin.product.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> القسم</label>
                                            <select class="form-control" name="category_id">
                                                <option value="0">إختر القسم</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> النوع</label>
                                            <select class="form-control" name="type_id">
                                                <option value="0">إختر النوع</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الوصف </label>
                                            <input type="text" class="form-control" name="description" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر </label>
                                            <input type="number" class="form-control" name="price" />
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
                                <i class="fas fa-list"></i> المنتجات
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="small-wide">#</th>
                                        <th>الصورة</th>
                                        <th>الإسم</th>
                                        <th>السعر العادي</th>
                                        <th>السعر للعملاء المميزين</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="small-wide">{{ $x }}</td>
                                            <td><img class="img-table" src="{{ $product->image_path }}" width="150">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->special_price }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.product.edit', ['product' => $product->slug]) }}"
                                                    class="icon">
                                                    <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                        title="تعديل "></i></a>

                                                <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                    data-url="{{ route('admin.product.destroy', ['product' => $product->slug]) }}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $x++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-5">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
