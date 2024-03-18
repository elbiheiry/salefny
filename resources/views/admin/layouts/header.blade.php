<header>
    <button class="toggle-btn icon-btn">
        <i class="fa fa-bars"></i>
    </button>
    <a href="{{ route('dashboard') }}" class="logo">
        <img src="{{ asset('admin-assets/images/logo.jpg') }}">
    </a>
    <ul class="top-header-links">

        <!--End li-->
        <li>
            <button type="button" class="dropdown-toggle" data-toggle="dropdown" data-display="static"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('admin-assets/images/user-1.jpg') }}" />
                <span>{{ auth()->user()->name }}</span>
            </button>
            <div class="dropdown-menu">
                <div class="menu-heading">
                    <img src="{{ asset('admin-assets/images/user-1.jpg') }}" />
                    <h3>{{ auth()->user()->name }}</h3>
                    {{-- <p><span></span>online</p> --}}
                </div>
                <ul>
                    <li>
                        <a href="{{ route('profile') }}">
                            <i class="fa fa-user"></i>
                            الصفحه الشخصيه
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" onclick="$('#logout-form').submit()">
                            <i class="fa fa-power-off"></i>
                            تسجيل خروج
                        </a>
                    </li>
                </ul>
            </div>
            <!--End Dropdown Menu-->
        </li>
    </ul>
</header>
<!--End Header -->
<form id="logout-form" action="{{ route('logout') }}" method="post">
    @csrf
</form>
