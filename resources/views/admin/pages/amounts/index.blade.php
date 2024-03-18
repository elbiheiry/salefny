@extends('admin.layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-dollar-sign"></i> المبالغ المتاحة
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>لوحة التحكم</a></li>
            <li class="active">المبالغ المتاحة</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <div class="widget">
            <div class="widget-title">
                إضافة مبلغ جديد
            </div>
            <div class="widget-content">
                <form class="row ajax-form" method="post" action="{{ route('amounts.store') }}">
                    @csrf
                    @method('post')
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>المبلغ</label>
                        <input type="text" class="form-control" name="amount">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                        <label>الحالة</label>
                        <select name="status" class="form-control">
                            <option value="0">إختر الحالة</option>
                            <option value="1">مفعله</option>
                            <option value="-1">غير مفعله</option>
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
                                        <th>المبلغ</th>
                                        <th>الحاله</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amounts as $index => $amount)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $amount->amount }}</td>
                                            <td>{{ $amount->get_status() }}</td>
                                            <td>
                                                <button class="icon-btn green-bc btn-modal-view"
                                                    data-url="{{ route('amounts.edit', ['id' => $amount->id]) }}"
                                                    title="تعديل">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="icon-btn red-bc delete-btn"
                                                    data-url="{{ route('amounts.delete', ['id' => $amount->id]) }}"
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
