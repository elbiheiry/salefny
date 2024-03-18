@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="widget">
            <div class="widget-content">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="counter">
                                    <i class="fa fa-users"></i>
                                    <div class="counter-cont">
                                        <h3 class="timer" data-to="{{ \App\Models\User::count() }}"
                                            data-speed="1500">
                                            {{ \App\Models\User::where('id', '!=', 1)->count() }}
                                        </h3>
                                        <div class="count-name">المستخدمين</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="counter">
                                    <i class="fa fa-dollar-sign"></i>
                                    <div class="counter-cont">
                                        <h3 class="timer" data-to="{{ \App\Models\Loan::count() }}"
                                            data-speed="1500">
                                            {{ \App\Models\Loan::count() }}
                                        </h3>
                                        <div class="count-name">جميع طلبات السلف</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="counter">
                                    <i class="fa fa-dollar-sign"></i>
                                    <div class="counter-cont">
                                        <h3 class="timer"
                                            data-to="{{ \App\Models\Loan::where('accepted', 1)->count() }}"
                                            data-speed="1500">
                                            {{ \App\Models\Loan::where('accepted', 1)->count() }}
                                        </h3>
                                        <div class="count-name">جميع طلبات السلف التي تم الموافقه عليها</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="counter">
                                    <i class="fa fa-dollar-sign"></i>
                                    <div class="counter-cont">
                                        <h3 class="timer"
                                            data-to="{{ \App\Models\Loan::where('accepted', 0)->count() }}"
                                            data-speed="1500">
                                            {{ \App\Models\Loan::where('accepted', 0)->count() }}
                                        </h3>
                                        <div class="count-name">جميع طلبات السلف قيد الإنتظار</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="counter">
                                    <i class="fa fa-dollar-sign"></i>
                                    <div class="counter-cont">
                                        <h3 class="timer"
                                            data-to="{{ \App\Models\Loan::where('accepted', -1)->count() }}"
                                            data-speed="1500">
                                            {{ \App\Models\Loan::where('accepted', -1)->count() }}
                                        </h3>
                                        <div class="count-name">جميع طلبات السلف التم تم رفضها</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget">
            <div class="widget-title">
                طلبات قيد الإنتظار
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive-lg">
                            <table class="table table-bordered" id="datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>إسم المستخدم</th>
                                        <th>رقم الهاتف المستخدم</th>
                                        <th>المبلغ المطلوب</th>
                                        <th>عدد شهور السداد</th>
                                        <th>قيمة السداد الشهرية</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $index => $loan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><a
                                                    href="{{ route('users.show', ['id' => $loan->member_id]) }}">{{ $loan->member->name }}</a>
                                            </td>
                                            <td>{{ $loan->member->phone }}</td>
                                            <td>{{ $loan->amount }}</td>
                                            <td>{{ $loan->months }}</td>
                                            <td>{{ $loan->installment }}</td>
                                            <td>
                                                <select class="form-control change-status" name="accepted"
                                                    data-url="{{ route('loans.status', ['id' => $loan->id]) }}">
                                                    <option value="0">الطلب قيد الإنتظار</option>
                                                    <option value="1">الموافقة علي الطلب</option>
                                                    <option value="-1">رفض الطلب</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.change-status').on('change', function() {
            var url = $(this).data('url');
            var accepted = $(this).val();

            $.ajax({
                url: url,
                data: {
                    accepted: accepted,
                    _token: "{{ csrf_token() }}"
                },
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    notification("success", response, "fas fa-check");
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            return false;
        })
    </script>
@endpush
