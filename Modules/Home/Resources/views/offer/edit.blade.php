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
                                    <i class="fas fa-plus"></i> تعديل القسم
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" action="{{ route('admin.offer.update', ['offer' => $offer->id]) }}"
                                method="put">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <img src="{{ $offer->image_path }}" width=200>
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
                                                value="{{ $offer->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>المنتجات المرتبطة بالعرض </label>
                                            <select class="form-control select2" name="related_products[]" multiple>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ $offer->related_products ? (in_array($product->id, json_decode($offer->related_products, true)) ? 'selected' : '') : '' }}>
                                                        {{ $product->name }}</option>
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
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
