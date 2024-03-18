@extends('admin.layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-user"></i> المستخدمين
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">المستخدمين</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                إضافة مستخدم جديد
            </div>
            <div class="widget-content">
                <form class="row ajax-form" method="post" action="{{ route('users.store') }}">
                    @csrf
                    @method('post')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>إسم المستخدم</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" class="form-control " name="email">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>رقم الهاتف</label>
                        <input type="text" class="form-control " name="phone">
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
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الجوال</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <a class="icon-btn blue-bc "
                                                    href="{{ route('users.show', ['id' => $user->id]) }}" title="عرض">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button class="icon-btn green-bc btn-modal-view"
                                                    data-url="{{ route('users.edit', ['id' => $user->id]) }}"
                                                    title="تعديل">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="icon-btn red-bc delete-btn"
                                                    data-url="{{ route('users.delete', ['id' => $user->id]) }}"
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
