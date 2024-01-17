@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="col-lg-12">
                @can('إنشاء البانر')
                    <div class="widget">
                        <div class="row">
                            <div class="col-12">
                                <div class="widget_title d-flex justify-content-between align-items-center">
                                    <h3 class="m-0">
                                        <i class="fas fa-plus"></i> إضافة البانر
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <form class="ajax-form" action="{{ route('admin.banner.store') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> الصورة</label>
                                                <input type="file" class="jfilestyle" name="image" />
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
                <div class="widget">
                    <div class="row">
                        <div class="col-12">
                            <div class="widget_title d-flex justify-content-between align-items-center">
                                <h3 class="m-0">
                                    <i class="fas fa-list"></i> العروض
                                </h3>
                            </div>
                            <div class="table-responsive">
                                @can('عرض البانرات')
                                    <table class="table table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="small-wide">#</th>
                                                <th>الصورة</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $x = 1;
                                            @endphp
                                            @foreach ($banners as $banner)
                                                <tr>
                                                    <td class="small-wide">{{ $x }}</td>
                                                    <td><img class="img-table" src="{{ $banner->image_path }}" width="150">
                                                    </td>
                                                    <td class="text-center">
                                                        @can('تعديل البانر')
                                                            <a href="{{ route('admin.banner.edit', ['banner' => $banner->id]) }}"
                                                                class="icon">
                                                                <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                                    title="تعديل "></i></a>
                                                        @endcan

                                                        @can('حذف البانر')
                                                            <a href="javascript:;" class="icon delete-btn"
                                                                style="background-color:red"
                                                                data-url="{{ route('admin.banner.destroy', ['banner' => $banner->id]) }}"><i
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
        </div>
    </main>
@endsection
