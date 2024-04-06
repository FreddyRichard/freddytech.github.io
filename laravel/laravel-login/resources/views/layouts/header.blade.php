<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                
                @auth
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf <!-- Agrega el token CSRF -->
                        <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">Logout</button>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>