@extends('admin.layouts.master')
@section('content')
    <!-- Page content ==========================================-->
    <div class="page-head">
        <i class="fa fa-member"></i>
        {{ $member->name }}
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">{{ $member->name }}</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                <i class="fa fa-profile"></i>
                {{ $member->name }}
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            الإسم بالكامل : <span> {{ $member->name }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            رقم الهوية : <span> {{ $member->identification }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            رقم الهاتف : <span> {{ $member->phone }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            القطاع : <span> {{ $member->sector }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            جهة العمل : <span> {{ $member->employer }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            الرتبة : <span> {{ $member->position }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            مقدار الراتب : <span> {{ $member->salary }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            الالتزامات الشهرية : <span> {{ $member->monthly_commitment }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            العنوان : <span> {{ $member->address }} </span>
                        </div>
                    </div>
                </div>
                <!--End Widget-content-->
            </div>
            <!--End Widget-->
        </div>
        <div class="widget">
            <div class="widget-title">
                <i class="fa fa-dollar-sign"></i>
                السلف السابقة
            </div>
            <div class="widget-content">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الكمية</th>
                            <th>القسط الشهري</th>
                            <th>عدد الشهور</th>
                            <th>حالة السلفة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member->loans as $index => $loan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->installment }}</td>
                                <td>{{ $loan->months }}</td>
                                <td>{{ $loan->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--End Widget-content-->
            </div>
            <!--End Widget-->
        </div>
        <!--End Page Content-->
    </div>
@endsection
