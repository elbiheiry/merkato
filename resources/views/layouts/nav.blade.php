<div class="dash_header">
    <a href="{{ route('admin.dashboard') }}" class="dash_logo">
        <img src="{{ aurl('images/logo.png') }}" alt="" />
    </a>
    <ul class="btns">
        <div class="user">
            <span>{{ auth()->user()->name }}</span>
        </div>
        <button class="toggle-btn icon fa fa-bars"></button>
    </ul>
</div>
