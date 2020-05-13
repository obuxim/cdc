<nav id="header-nav" class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name', 'CDC') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsiveMenu" aria-controls="responsiveMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="responsiveMenu">
            <ul class="navbar-nav mr-auto">
                @auth
                    @if(Auth::user()->role  == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.category.index') }}">Category</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a href="/profile" class="nav-link"><i class="fas fa-user rounded-circle fa-border p-2"></i> {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="nav-link">Logout</a>
                        <form id="logout-form" style="display: none" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @if(Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
