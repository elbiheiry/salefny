@extends('admin.layouts.master')
@section('content')
    <!-- Page content  ==========================================-->
    <div class="page-head">
        <i class="fa fa-user"></i>
        الإعدادات العامة
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">الإعدادات العامة</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-content">
                <form class="row ajax-form" method="put" action="{{ route('settings.update') }}">
                    @csrf
                    @method('put')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الرسوم الإدارية :</label>
                        <input type="number" class="form-control" value="{{ $settings->tax }}" name="tax">
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
