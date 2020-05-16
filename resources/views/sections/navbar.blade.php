<nav id="header-nav" class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        @auth
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand">{{ config('app.name', 'CDC') }}</a>
            @else
                <a href="/" class="navbar-brand">{{ config('app.name', 'CDC') }}</a>
            @endif
        @endauth
        @guest
            <a href="/" class="navbar-brand">{{ config('app.name', 'CDC') }}</a>
        @endguest
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsiveMenu" aria-controls="responsiveMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="responsiveMenu">
            <ul class="navbar-nav mr-auto">
                @auth
                    @if(Auth::user()->role  == 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Service
                            </a>
                            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <a class="dropdown-item" href="{{ route('admin.category.index') }}">All Services</a>
                                <a class="dropdown-item" href="{{ route('admin.category.create') }}">Add Service</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="serviceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Item
                            </a>
                            <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                                <a class="dropdown-item" href="{{ route('admin.service.index') }}">All Items</a>
                                <a class="dropdown-item" href="{{ route('admin.service.create') }}">Add Item</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Customer
                            </a>
                            <div class="dropdown-menu" aria-labelledby="customerDropdown">
                                <a class="dropdown-item" href="{{ route('admin.customer.index') }}">All Customers</a>
                                <a class="dropdown-item" href="{{ route('admin.customer.create') }}">Add Customer</a>
                            </div>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('user.profile') }}" class="nav-link"><i class="fas fa-user rounded-circle fa-border p-2 mr-1"></i>  {{ Auth::user()->profile->firstName }}</a>
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
