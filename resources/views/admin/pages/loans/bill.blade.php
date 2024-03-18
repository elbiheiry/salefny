<form class="modal-content text-center ajax-form" method="put"
    action="{{ route('loans.bills.update', ['id' => $bill->id]) }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل البيانات</h5>
    </div>
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label>تاريخ الإستحقاق</label>
            <input type="date" class="form-control" name="payment_date"
                value="{{ \Carbon\Carbon::parse($bill->payment_date)->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label>الحاله</label>
            <select class="form-control" name="status">
                <option value="0">إختر الحالة</option>
                <option value="pending" {{ $bill->status == 'pending' ? 'selected' : '' }}>لم يتم السداد بعد </option>
                <option value="done" {{ $bill->status == 'done' ? 'selected' : '' }}>تم السداد</option>
            </select>
        </div>
    </div>
    <div class="modal-footer text-center">
        <button class="custom-btn" type="submit">
            <i class="fa fa-save"></i>حفظ المعلومات
        </button>
        <button type="button" class="custom-btn red-bc" data-dismiss="modal">
            <i class="fa fa-times"></i> إغلاق
        </button>
    </div>
</form>
