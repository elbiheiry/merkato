@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="col-lg-12">
                @can('إنشاء قسم')
                    <div class="widget">
                        <div class="row">
                            <div class="col-12">
                                <div class="widget_title d-flex justify-content-between align-items-center">
                                    <h3 class="m-0">
                                        <i class="fas fa-plus"></i> قسم جديد
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <form class="ajax-form" method="{{ route('admin.category.store') }}" method="post">
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>القسم الرئيسي </label>
                                                <select class="form-control" name="parent_id">
                                                    <option value="0">نعم</option>
                                                    @foreach ($parentCategories as $item)
                                                        <option value="{{ $item->id }}">ينتمي إلي : {{ $item->name }}
                                                        </option>
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
                @endcan

            </div>
            <div class="widget">
                <div class="row">
                    @can('عرض الأقسام')
                        <div class="col-12">
                            <div class="widget_title d-flex justify-content-between align-items-center">
                                <h3 class="m-0">
                                    <i class="fas fa-list"></i> الأقسام
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="small-wide">#</th>
                                            <th>الصورة</th>
                                            <th>الإسم</th>
                                            <th>قسم رئيسي ؟</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="small-wide">{{ $x }}</td>
                                                <td><img class="img-table" src="{{ $category->image_path }}" width="150">
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->parent_id == null ? 'نعم' : 'ينتمي إلي : ' . $category->mainCategory->name }}
                                                </td>
                                                <td class="text-center">
                                                    @can('تعديل قسم')
                                                        <a href="{{ route('admin.category.edit', ['category' => $category->slug]) }}"
                                                            class="icon">
                                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                title="تعديل "></i></a>
                                                    @endcan
                                                    @can('حذف قسم')
                                                        <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                            data-url="{{ route('admin.category.destroy', ['category' => $category->slug]) }}"><i
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
                                {!! $categories->links() !!}
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </main>
@endsection
