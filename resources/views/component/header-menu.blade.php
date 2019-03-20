@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('admin.login') }}">Admin</a>
                <a href="{{ route('login') }}">User</a>
                @endauth
    </div>
@endif