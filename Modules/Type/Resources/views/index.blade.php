@extends('layouts.master')

@section('content')
    <main>
        @include('layouts.nav')
        <!--End Header -->
        <div class="dashboard_content">
            <div class="col-lg-12">
                {{-- <div class="widget">
                    <div class="row">
                        <div class="col-12">
                            <div class="widget_title d-flex justify-content-between align-items-center">
                                <h3 class="m-0">
                                    <i class="fas fa-plus"></i> نوع جديد
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" method="{{ route('admin.type.store') }}" method="post">
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
                                        <button class="link"><span> حفظ</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
                <div class="widget">
                    <div class="row">
                        <div class="col-12">
                            <div class="widget_title d-flex justify-content-between align-items-center">
                                <h3 class="m-0">
                                    <i class="fas fa-list"></i> الأنواع
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="small-wide">#</th>
                                            <th>الصورة</th>
                                            <th>الإسم</th>
                                            <th>أقل قيمة للطلب</th>
                                            <th>أقل قيمة للطلب للتوصيل المجاني</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($types as $type)
                                            <tr>
                                                <td class="small-wide">{{ $x }}</td>
                                                <td><img class="img-table" src="{{ $type->image_path }}" width="50">
                                                </td>
                                                <td>{{ $type->name }}</td>
                                                <td>{{ $type->minimum }}</td>
                                                <td>{{ $type->free_shipping }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.type.edit', ['type' => $type->slug]) }}"
                                                        class="icon">
                                                        <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                            title="تعديل "></i></a>

                                                    {{-- <a href="javascript:;" class="icon delete-btn"
                                                        style="background-color:red"
                                                        data-url="{{ route('admin.type.destroy', ['type' => $type->slug]) }}"><i
                                                            class="fas fa-trash"></i></a> --}}
                                                </td>
                                            </tr>
                                            @php
                                                $x++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $types->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
