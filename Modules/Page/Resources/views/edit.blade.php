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
                                    <i class="fas fa-plus"></i> تعديل الصفحة
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" action="{{ route('admin.page.update', ['page' => $page->slug]) }}"
                                method="put">
                                @csrf
                                @method('put')
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>العنوان </label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $page->title }}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>الوصف </label>
                                            <textarea name="description" class="form-control tiny-editor">{{ $page->description }}</textarea>
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
