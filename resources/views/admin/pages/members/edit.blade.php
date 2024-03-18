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
                تعديل بيانات المستخدم
            </div>
            <div class="widget-content">
                <form class="row ajax-form" method="put" action="{{ route('members.update', ['id' => $member->id]) }}">
                    @csrf
                    @method('put')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>رقم الهوية</label>
                        <input type="text" class="form-control" name="identification"
                            value="{{ $member->identification }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الاسم الرباعي</label>
                        <input type="text" class="form-control" name="name" value="{{ $member->name }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>رقم الجوال</label>
                        <input type="text" class="form-control" name="phone" value="{{ $member->phone }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>قطاع العمل</label>
                        <input type="text" class="form-control" name="sector" value="{{ $member->sector }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>جهة العمل</label>
                        <input type="text" class="form-control" name="employer" value="{{ $member->employer }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الرتبة</label>
                        <input type="text" class="form-control" name="position" value="{{ $member->position }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>مقدار الراتب</label>
                        <input type="text" class="form-control" name="salary" value="{{ $member->salary }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الالتزامات الشهرية</label>
                        <input type="text" class="form-control" name="monthly_commitment"
                            value="{{ $member->monthly_commitment }}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>العنوان</label>
                        <input type="text" class="form-control" name="address" value="{{ $member->address }}">
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
    </div>
    <!--End Page content-->
@endsection
