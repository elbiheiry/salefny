<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">
@include('admin.layouts.head')

<body id="body">
    <div class="modal fade" id="common-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" id="edit-area">

        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content text-center" id="delete-form" method="post">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">هل أنت متاكد ؟</h5>
                </div>
                <div class=" text-center">
                    <button type="submit" class="custom-btn red-bc" style="margin-right : 5px;">
                        <i class="fa fa-trash"></i> حذف
                    </button>
                    <button type="button" class="custom-btn" data-dismiss="modal">
                        <i class="fa fa-times"></i> إغلاق
                    </button>
                </div>
            </form>
        </div>
    </div>
    @stack('modals')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    <!-- Main
        ==========================================-->
    <div class="main">
        <!-- Page content
            ==========================================-->
        @yield('content')
        <!--End Page content-->
    </div>
    <!--End Main-->
    <div class="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
    @include('admin.layouts.scripts')
</body>

</html>
