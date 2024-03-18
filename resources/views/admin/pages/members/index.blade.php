@extends('admin.layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-member"></i> مستخدمي التطبيق
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">مستخدمي التطبيق</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                إضافة مستخدم جديد
            </div>
            <div class="widget-content">
                <form class="row ajax-form" method="post" action="{{ route('members.store') }}">
                    @csrf
                    @method('post')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>رقم الهوية</label>
                        <input type="text" class="form-control" name="identification">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الاسم الرباعي</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>رقم الجوال</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>قطاع العمل</label>
                        <input type="text" class="form-control" name="sector">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>جهة العمل</label>
                        <input type="text" class="form-control" name="employer">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الرتبة</label>
                        <input type="text" class="form-control" name="position">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>مقدار الراتب</label>
                        <input type="text" class="form-control" name="salary">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الالتزامات الشهرية</label>
                        <input type="text" class="form-control" name="monthly_commitment">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>العنوان</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الرقم السري </label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <button class="custom-btn green-bc">
                            <i class="fa fa-save"></i>حفظ المعلومات
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="widget">
            <!--End Widget Title-->
            <div class="widget-content">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive-lg">
                            <table class="table table-bordered" id="datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم بالكامل</th>
                                        <th>رقم الهوية</th>
                                        <th>رقم الجوال</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $index => $member)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->identification }}</td>
                                            <td>{{ $member->phone }}</td>
                                            <td>
                                                <a class="icon-btn blue-bc "
                                                    href="{{ route('users.show', ['id' => $member->id]) }}" title="عرض">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="icon-btn green-bc "
                                                    href="{{ route('members.edit', ['id' => $member->id]) }}"
                                                    title="تعديل">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="icon-btn red-bc delete-btn"
                                                    data-url="{{ route('members.delete', ['id' => $member->id]) }}"
                                                    title="حذف">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Widget-content-->
        </div>
        <!--End widget-->
    </div>
    <!--End Page content-->
@endsection
