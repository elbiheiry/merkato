<!DOCTYPE html>
<html lang="ar" dir="rtl">
@include('layouts.head')

<body>
    <div class="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
    @if (!auth()->guest())
        @include('layouts.sidebar')
    @endif
    @include('layouts.modals')
    @yield('content')

    @include('layouts.scripts')
</body>

</html>
