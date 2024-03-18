<aside class="side-menu">
    <ul>
        <button class="toggle-btn custom-btn">
            <i class="fa fa-times"></i> إغلاق
        </button>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                - لوحة التحكم
            </a>
        </li>
        <li class="{{ request()->routeIs('settings') ? 'active' : '' }}">
            <a href="{{ route('settings') }}">
                - الإعدادات
            </a>
        </li>
        <li class="{{ request()->routeIs('amounts.index') ? 'active' : '' }}">
            <a href="{{ route('amounts.index') }}">
                - المبالغ المتاحة
            </a>
        </li>
        <li class="{{ request()->routeIs('months.index') ? 'active' : '' }}">
            <a href="{{ route('months.index') }}">
                - الشهور المتاحة
            </a>
        </li>
        <li class="{{ request()->routeIs('users.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                - مستخدمي لوحة التحكم
            </a>
        </li>
        <li
            class="{{ request()->routeIs('members.index') || request()->routeIs('users.show') || request()->routeIs('members.edit') ? 'active' : '' }}">
            <a href="{{ route('members.index') }}">
                - مستخدمي التطبيق
            </a>
        </li>
        <li class="{{ request()->routeIs('loans.index') || request()->routeIs('loans.show') ? 'active' : '' }}">
            <a href="{{ route('loans.index') }}">
                - طلبات السلفات
            </a>
        </li>
        <li class="{{ request()->routeIs('bills.index') || request()->routeIs('bills.search') ? 'active' : '' }}">
            <a href="{{ route('bills.index') }}">
                - الفواتير الحالية
            </a>
        </li>

    </ul>
    <!--End Ul-->
</aside>
<!--End Aside-->
