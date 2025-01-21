<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container px-5">
        <a class="navbar-brand" href="{{ url('/') }}">Golden Languages</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ url('/courses') }}" class="nav-link">Kursy</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/contact') }}" class="nav-link">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/cart') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/profile') }}" class="nav-link">Konto</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Zaloguj się</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Zarejestruj się</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
