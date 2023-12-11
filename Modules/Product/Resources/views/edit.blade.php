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
                                    <i class="fas fa-edit"></i> تعديل المنتج
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form"
                                action="{{ route('admin.product.update', ['product' => $product->slug]) }}" method="put">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <img src="{{ $product->image_path }}" width=200>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> القسم</label>
                                            <select class="form-control" name="category_id">
                                                <option value="0">إختر القسم</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
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
                                                    <option value="{{ $type->id }}"
                                                        {{ $type->id == $product->type_id ? 'selected' : '' }}>
                                                        {{ $type->name }}</option>
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
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $product->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الوصف </label>
                                            <input type="text" class="form-control" name="description"
                                                value="{{ $product->description }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر </label>
                                            <input type="number" class="form-control" name="price"
                                                value="{{ $product->price }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم </label>
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ $product->discount }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الكمية </label>
                                            <input type="number" class="form-control" name="quantity"
                                                value="{{ $product->quantity }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقل قيمة للطلب </label>
                                            <input type="number" class="form-control" name="minimum"
                                                value="{{ $product->minimum }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أكثر قيمة للطلب </label>
                                            <input type="number" class="form-control" name="maximum"
                                                value="{{ $product->maximum }}" />
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
