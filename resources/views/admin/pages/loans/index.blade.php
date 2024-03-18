@extends('admin.layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-dollar-sign"></i> طلبات السلف
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">طلبات السلف</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                طلب سلفة جديدة
            </div>
            <div class="widget-content">
                <form class="row ajax-form" method="post" action="{{ route('loans.store') }}">
                    @csrf
                    @method('post')
                    <div class="col-md-4 col-sm-12 form-group">
                        <label>قيمة السلفة :</label>
                        <select class="form-control" name="amount">
                            <option value="0">إختر المبلغ</option>
                            @foreach ($amounts as $amount)
                                <option value="{{ $amount->amount }}">{{ $amount->amount }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 form-group">
                        <label>عدد شهور تقسيط السلفة :</label>
                        <select class="form-control" name="months">
                            <option value="0">إختر الشهور</option>
                            @foreach ($months as $month)
                                <option value="{{ $month->month }}">{{ $month->month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 form-group">
                        <label>طالب السلفة :</label>
                        <select class="form-control" name="member_id">
                            <option value="0">إختر المستخدم</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
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
                                        <th>إسم مقدم الطلب</th>
                                        <th>رقم الهاتف</th>
                                        <th>رقم الهوية</th>
                                        <th>المبلغ المطلوب</th>
                                        <th>عدد شهور السداد</th>
                                        <th>حالة الطلب</th>
                                        <th>موعد الطلب</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $index => $loan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $loan->member->name }}</td>
                                            <td>{{ $loan->member->phone }}</td>
                                            <td>{{ $loan->member->identification }}</td>
                                            <td>{{ $loan->amount }}</td>
                                            <td>{{ $loan->months }}</td>
                                            <td>{{ $loan->status }}</td>
                                            <td>{{ $loan->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a class="icon-btn blue-bc"
                                                    href="{{ route('loans.show', ['id' => $loan->id]) }}" title="عرض">
                                                    <i class="fa fa-eye"></i>
                                                </a>
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
