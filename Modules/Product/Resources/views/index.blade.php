@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="col-lg-12">
                @can('إضافة منتج')
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
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach ($category->subCategories as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                            <input type="text" class="form-control" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إجمالي الكمية </label>
                                            <input type="number" class="form-control" name="quantity" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> الوصف لكبار العملاء </label>
                                            <input type="text" class="form-control" name="description" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر لكبار العملاء</label>
                                            <input type="number" class="form-control" name="price" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم لكبار العملاء (%)</label>
                                            <input type="number" class="form-control" name="discount" value="0" />
                                        </div>
                                    </div>
                                    

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي كمية للطلب لكبار العملاء</label>
                                            <input type="number" class="form-control" name="maximum" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إضافة للأكثر مبيعا لكبار العملاء ؟</label>
                                            <select class="form-control" name="is_best_sell_1">
                                                <option value="0">لا</option>
                                                <option value="1">نعم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> الوصف لعملاء الجملة </label>
                                            <input type="text" class="form-control" name="description1" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر لعملاء الجملة</label>
                                            <input type="number" class="form-control" name="price1" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم لعملاء الجملة (%)</label>
                                            <input type="number" class="form-control" name="discount1" value="0" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي كمية للطلب لعملاء الجملة</label>
                                            <input type="number" class="form-control" name="maximum1" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إضافة للأكثر مبيعا لعملاء الجملة ؟</label>
                                            <select class="form-control" name="is_best_sell_2">
                                                <option value="0">لا</option>
                                                <option value="1">نعم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> الوصف لعملاء القطاعي </label>
                                            <input type="text" class="form-control" name="description2" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>السعر لعملاء القطاعي</label>
                                            <input type="number" class="form-control" name="price2" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الخصم لعملاء القطاعي (%)</label>
                                            <input type="number" class="form-control" name="discount2" value="0" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>أقصي كمية للطلب لعملاء القطاعي</label>
                                            <input type="number" class="form-control" name="maximum2" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>إضافة للأكثر مبيعا لعملاء االقطاعي ؟</label>
                                            <select class="form-control" name="is_best_sell_3">
                                                <option value="0">لا</option>
                                                <option value="1">نعم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>معامل التحويل الأول</label>
                                            <input type="number" class="form-control" name="convert1" />
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>معامل التحويل الثاني</label>
                                            <input type="number" class="form-control" name="convert2" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>معامل التحويل للقطاعي</label>
                                            <input type="number" class="form-control" name="convert3" />
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
                @endcan
            </div>
            @can('عرض المنتجات')
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
                                            <th>السعر</th>
                                            <th>الكمية</th>
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
                                                <td>{{ $product->quantity }}</td>
                                                <td class="text-center">
                                                    @can('تعديل منتج')
                                                        <a href="{{ route('admin.product.edit', ['product' => $product->slug]) }}"
                                                            class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                title="تعديل "></i></a>
                                                    @endcan
                                                    @can('حذف منتج')
                                                        <a href="javascript:;" class="icon delete-btn"
                                                            style="background-color:red"
                                                            data-url="{{ route('admin.product.destroy', ['product' => $product->slug]) }}"><i
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
                                <div class="mt-5">
                                    {!! $products->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </main>
@endsection
