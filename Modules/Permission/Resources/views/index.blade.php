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
                                    <i class="fas fa-plus"></i> إذن جديد
                                </h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <form class="ajax-form" method="{{ route('admin.permission.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>الإذن </label>
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
                                <i class="fas fa-list"></i> الأذونات
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="small-wide">#</th>
                                        <th>الإسم</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="small-wide">{{ $x }}</td>
                                            <td>{{ $permission['name'] }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.permission.edit', ['permission' => $permission['id']]) }}"
                                                    class="icon">
                                                    <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                        title="تعديل "></i></a>

                                                <a href="javascript:;" class="icon delete-btn" style="background-color:red"
                                                    data-url="{{ route('admin.permission.destroy', ['permission' => $permission['id']]) }}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $x++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br />
                        {!! $permissions->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
