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
        @can('عرض البانرات')
            <li>
                <a href="{{ route('admin.banner.index') }}"
                    class="nav-item {{ request()->is('admin/banner') ? 'active' : '' }}">
                    <i class="fas fa-image"></i> البانر
                </a>
            </li>
        @endcan
        @can('عرض العروض')
            <li>
                <a href="{{ route('admin.offer.index') }}"
                    class="nav-item {{ request()->is('admin/offer') || request()->is('admin/offer/*') ? 'active' : '' }}">
                    <i class="fas fa-award"></i> العروض
                </a>
            </li>
        @endcan
        @can('عرض الأنواع')
            <li>
                <a href="{{ route('admin.type.index') }}"
                    class="nav-item {{ request()->is('admin/type/*') || request()->is('admin/type') ? 'active' : '' }}">
                    <i class="fas fa-info"></i> الأنواع
                </a>
            </li>
        @endcan
        @can('عرض الأقسام')
            <li>
                <a href="{{ route('admin.category.index') }}"
                    class="nav-item {{ request()->is('admin/category/*') || request()->is('admin/category') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> الأقسام
                </a>
            </li>
        @endcan
        @can('عرض المنتجات')
            <li>
                <a href="{{ route('admin.product.index') }}"
                    class="nav-item {{ request()->is('admin/product/*') || request()->is('admin/product') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i> المنتجات
                </a>
            </li>
        @endcan
        @can('عرض الكوبونات')
            <li>
                <a href="{{ route('admin.coupon.index') }}"
                    class="nav-item {{ request()->is('admin/coupon/*') || request()->is('admin/coupon') ? 'active' : '' }}">
                    <i class="fas fa-percent"></i> كوبونات الخصم
                </a>
            </li>
        @endcan
        @can('عرض المستخدمين')
            <li>
                <a href="{{ route('admin.user.index') }}"
                    class="nav-item {{ request()->is('admin/user/*') || request()->is('admin/user') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> المستخدمين
                </a>
            </li>
        @endcan
        @can('عرض الطلبات')
            <li>
                <a href="{{ route('admin.order.index') }}"
                    class="nav-item {{ request()->is('admin/order/*') || request()->is('admin/order') ? 'active' : '' }}">
                    <i class="fas fa-info"></i> الطلبات
                </a>
            </li>
        @endcan
        @can('عرض الصفحات')
            <li>
                <a href="{{ route('admin.page.index') }}"
                    class="nav-item {{ request()->is('admin/page/*') || request()->is('admin/page') ? 'active' : '' }}">
                    <i class="fas fa-info"></i> الصفحات
                </a>
            </li>
        @endcan
        @can('عرض الأدوار')
            <li>
                <a href="{{ route('admin.admin.index') }}"
                    class="nav-item {{ request()->is('admin/admin/*') || request()->is('admin/admin') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> مستخدمي لوحة التحكم
                </a>
            </li>
        @endcan
        @can('عرض الأدوار')
            <li>
                <a href="{{ route('admin.role.index') }}"
                    class="nav-item {{ request()->is('admin/role/*') || request()->is('admin/role') ? 'active' : '' }}">
                    <i class="fas fa-info"></i> الأدوار
                </a>
            </li>
        @endcan
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
