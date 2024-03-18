@extends('admin.layouts.master')
@section('content')
    <!-- Page content  ==========================================-->
    <div class="page-head">
        <i class="fa fa-user"></i>
        الصفحة الشخصية
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">الصفحة الشخصية</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-content">
                <form class="row ajax-form" method="put" action="{{ route('profile.update') }}">
                    @csrf
                    @method('put')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الإسم بالكامل :</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>البريد الإلكتروني :</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>رقم الجوال :</label>
                        <input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الرقم السري :</label>
                        <input type="password" class="form-control" value="{{ $user->profile }}" name="password">
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <button class="custom-btn green-bc">
                            <i class="fa fa-save"></i>حفظ المعلومات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Page content-->
@endsection
