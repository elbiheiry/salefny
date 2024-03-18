<form class="modal-content text-center ajax-form" method="put"
    action="{{ route('amounts.update', ['id' => $amount->id]) }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل البيانات</h5>
    </div>
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label>المبلغ</label>
            <input type="text" class="form-control" name="amount" value="{{ $amount->amount }}">
        </div>
        <div class="form-group">
            <label>الحالة</label>
            <select name="status" class="form-control">
                <option value="0">إختر الحالة</option>
                <option value="1" {{ $amount->status == '1' ? 'selected' : '' }}>مفعله</option>
                <option value="-1" {{ $amount->status == '-1' ? 'selected' : '' }}>غير مفعله</option>
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
