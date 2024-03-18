@extends('admin.layouts.master')
@section('content')
    <!-- Page content ==========================================-->
    <div class="page-head">
        <i class="fa fa-info"></i>
        عرض بيانات السلفه
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">عرض بيانات السلفه</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                <i class="fa fa-profile"></i>
                عرض بيانات السلفه
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            الإسم بالكامل : <span> {{ $loan->member->name }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            رقم الهاتف : <span> {{ $loan->member->phone }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            رقم الهوية : <span> {{ $loan->member->identification }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            المبلغ المطلوب : <span> {{ $loan->amount }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            عدد شهور السداد : <span> {{ $loan->months }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            قيمة السداد الشهرية : <span> {{ number_format($loan->installment) }} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="profile-view">
                            حالة الطلب : <span> {{ $loan->status }} </span>
                        </div>
                    </div>
                    @if ($loan->reason)
                        <div class="col-lg-6 col-md-6">
                            <div class="profile-view">
                                سبب الرفض : <span> {{ $loan->reason }} </span>
                            </div>
                        </div>
                    @endif

                </div>
                <!--End Widget-content-->
            </div>
            <!--End Widget-->
        </div>
        <div class="widget">
            <div class="widget-title">
                <i class="fa fa-dollar-sign"></i>
                مواعيد الاستحقاقات الشهريه
            </div>
            <div class="widget-content">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>القسط الشهري</th>
                            <th>الحالة</th>
                            <th>موعد الاستحقاق</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loan->bills as $index => $bill)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $bill->amount }}</td>
                                <td>{{ $bill->get_status() }}</td>
                                <td>{{ \Carbon\Carbon::parse($bill->payment_date)->format('d-m-Y') }}</td>
                                <td>
                                    <button class="icon-btn green-bc btn-modal-view"
                                        data-url="{{ route('loans.bills.edit', ['id' => $bill->id]) }}" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
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
