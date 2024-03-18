<form class="modal-content text-center ajax-form" method="put"
    action="{{ route('users.update', ['id' => $user->id]) }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل البيانات</h5>
    </div>
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label>إسم المستخدم</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" class="form-control " name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label>رقم الهاتف</label>
            <input type="text" class="form-control " name="phone" value="{{ $user->phone }}">
        </div>
        <div class="form-group">
            <label>الرقم السري </label>
            <input type="password" class="form-control" name="password" />
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
