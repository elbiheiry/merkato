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
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach ($category->subCategories as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </optgroup>
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
                                            <label>إجمالي الكمية </label>
                                            <input type="number" class="form-control" name="quantity"
                                                value="{{ $product->quantity }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> الوصف لكبار العملاء </label>
                                            <input type="text" class="form-control" name="description"
                                                value="{{ $product->description }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر لكبار العملاء</label>
                                            <input type="number" class="form-control" name="price"
                                                value="{{ $product->price ?? 0 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم لكبار العملاء (%)</label>
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ $product->discount ?? 0 }}" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي كمية للطلب لكبار العملاء</label>
                                            <input type="number" class="form-control" name="maximum"
                                                value="{{ $product->maximum ?? 0 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إضافة للأكثر مبيعا لكبار العملاء ؟</label>
                                            <select class="form-control" name="is_best_sell_1">
                                                <option value="0"
                                                    {{ $product->is_best_sell_1 == 0 ? 'selected' : '' }}>
                                                    لا</option>
                                                <option value="1"
                                                    {{ $product->is_best_sell_1 == 1 ? 'selected' : '' }}>
                                                    نعم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> الوصف لعملاء الجملة </label>
                                            <input type="text" class="form-control" name="description1"
                                                value="{{ $product->description1 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر لعملاء الجملة</label>
                                            <input type="number" class="form-control" name="price1"
                                                value="{{ $product->price1 ?? 0 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم لعملاء الجملة (%)</label>
                                            <input type="number" class="form-control" name="discount1"
                                                value="{{ $product->discount1 ?? 0 }}" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي كمية للطلب لعملاء الجملة</label>
                                            <input type="number" class="form-control" name="maximum1"
                                                value="{{ $product->maximum1 ?? 0 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إضافة للأكثر مبيعا لعملاء الجملة ؟</label>
                                            <select class="form-control" name="is_best_sell_2">
                                                <option value="0"
                                                    {{ $product->is_best_sell_2 == 0 ? 'selected' : '' }}>
                                                    لا</option>
                                                <option value="1"
                                                    {{ $product->is_best_sell_2 == 1 ? 'selected' : '' }}>
                                                    نعم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> الوصف لعملاء القطاعي </label>
                                            <input type="text" class="form-control" name="description2"
                                                value="{{ $product->description2 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر لعملاء القطاعي</label>
                                            <input type="number" class="form-control" name="price2"
                                                value="{{ $product->price2 ?? 0 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم لعملاء القطاعي (%)</label>
                                            <input type="number" class="form-control" name="discount2"
                                                value="{{ $product->discount2 ?? 0 }}" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي كمية للطلب لعملاء القطاعي</label>
                                            <input type="number" class="form-control" name="maximum2"
                                                value="{{ $product->maximum2 ?? 0 }}" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إضافة للأكثر مبيعا لعملاء االقطاعي ؟</label>
                                            <select class="form-control" name="is_best_sell_3">
                                                <option value="0"
                                                    {{ $product->is_best_sell_3 == 0 ? 'selected' : '' }}>
                                                    لا</option>
                                                <option value="1"
                                                    {{ $product->is_best_sell_3 == 1 ? 'selected' : '' }}>
                                                    نعم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>معامل التحويل الأول</label>
                                            <input type="number" class="form-control" name="convert1"
                                                value="{{ $product->convert1 ?? 0 }}" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>معامل التحويل الثاني</label>
                                            <input type="number" class="form-control" name="convert2"
                                                value="{{ $product->convert2 ?? 0 }}" />
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
