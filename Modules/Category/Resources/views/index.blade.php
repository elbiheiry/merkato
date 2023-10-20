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
                                            <td class="text-center">
                                                {{-- <a href="#send_notes" class="icon" data-target="#send_notes"
                                                    data-toggle="modal">
                                                    <i class="far fa-question-circle" data-toggle="tooltip"
                                                        data-placement="top" title="إرسال ملاحظات "></i></a> --}}

                                                <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                    data-url="{{ route('admin.category.destroy', ['category' => $category->slug]) }}"><i
                                                        class="fas fa-trash"></i></a>
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
                </div>
            </div>
        </div>
    </main>
@endsection
