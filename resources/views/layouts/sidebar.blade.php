<aside>
    <button class="toggle-btn custom-btn">
        <i class="fa fa-times"></i>
    </button>
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ aurl('images/logo.png') }}" alt="logo" />
    </a>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-meteor"></i> لوحــة التحكــم
            </a>
        </li>
        <li>
            <a href="{{ route('admin.type.index') }}"
                class="nav-item {{ request()->is('admin/type/*') || request()->is('admin/type') ? 'active' : '' }}">
                <i class="fas fa-info"></i> الأنواع
            </a>
        </li>
        <li>
            <a href="{{ route('admin.category.index') }}"
                class="nav-item {{ request()->is('admin/category/*') || request()->is('admin/category') ? 'active' : '' }}">
                <i class="fas fa-list"></i> الأقسام
            </a>
        </li>
        <li>
            <button class="border-0 nav-item" onclick="$('#logout-form').submit()">
                <i class="fa fas fa-sign-out-alt"></i> تسجيل خروج
            </button>
        </li>
    </ul>
</aside>
<form method="post" action="{{ route('admin.logout') }}" id="logout-form">
    @csrf
</form>
