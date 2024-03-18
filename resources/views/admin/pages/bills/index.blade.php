@extends('admin.layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-dollar-sign"></i> الفواتير المستحقة
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">الفواتير المستحقة</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                بحث بالشهر والسنه
            </div>
            <div class="widget-content">
                <form class="row" method="get" action="{{ route('bills.search') }}">
                    @csrf
                    @method('get')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الشهر</label>
                        <select name="month" class="form-control">
                            <option {{ \Carbon\Carbon::now()->month == 1 ? 'selected' : '' }} value="1">يناير</option>
                            <option {{ \Carbon\Carbon::now()->month == 2 ? 'selected' : '' }} value="2">قبراير</option>
                            <option {{ \Carbon\Carbon::now()->month == 3 ? 'selected' : '' }} value="3">مارس</option>
                            <option {{ \Carbon\Carbon::now()->month == 4 ? 'selected' : '' }} value="4">أبريل</option>
                            <option {{ \Carbon\Carbon::now()->month == 5 ? 'selected' : '' }} value="5">مايو</option>
                            <option {{ \Carbon\Carbon::now()->month == 6 ? 'selected' : '' }} value="6">يونيو</option>
                            <option {{ \Carbon\Carbon::now()->month == 7 ? 'selected' : '' }} value="7">يوليو</option>
                            <option {{ \Carbon\Carbon::now()->month == 8 ? 'selected' : '' }} value="8">أغسطس</option>
                            <option {{ \Carbon\Carbon::now()->month == 9 ? 'selected' : '' }} value="9">سبتمبر</option>
                            <option {{ \Carbon\Carbon::now()->month == 10 ? 'selected' : '' }} value="10">أكتوبر</option>
                            <option {{ \Carbon\Carbon::now()->month == 11 ? 'selected' : '' }} value="11">نوفمبر</option>
                            <option {{ \Carbon\Carbon::now()->month == 12 ? 'selected' : '' }} value="12">ديسمبر</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>السنه</label>
                        <input type="number" class="form-control" name="year"
                            value="{{ \Carbon\Carbon::now()->year }}">
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
                                        <th>إسم العميل</th>
                                        <th>رقم الهاتف</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>القيمه المستحقه</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $index => $bill)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><a
                                                    href="{{ route('users.show', ['id' => $bill->loan->user->id]) }}">{{ $bill->loan->user->name }}</a>
                                            </td>
                                            <td>{{ $bill->loan->user->phone }}</td>
                                            <td>{{ $bill->loan->user->email }}</td>
                                            <td>{{ $bill->amount }}</td>
                                            <td>
                                                <button class="icon-btn green-bc btn-modal-view"
                                                    data-url="{{ route('loans.bills.edit', ['id' => $bill->id]) }}"
                                                    title="تعديل">
                                                    <i class="fa fa-edit"></i>
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
