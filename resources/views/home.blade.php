<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <title>Golden Languages | Sklep internetowy z kursami języków obych</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        @vite('resources/css/styles.css')
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top">Golden Languages</a>
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
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">Odkrywaj świat z nami,</h1>
                    <h2 class="masthead-subheading mb-0">zaczynając od nauki nowego języka!</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Sprawdź</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </header>
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="{{asset('teacher.webp')}}" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Otwórz drzwi do nowych możliwości!</h2>
                            <p>Ucz się języków obcych z naszymi profesjonalnymi kursami i zyskaj przewagę na rynku pracy. Nasze kursy są prowadzone przez doświadczonych nauczycieli, którzy pomogą Ci osiągnąć płynność w mówieniu i pisaniu. Dołącz do nas i zacznij swoją językową przygodę już dziś!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="{{asset('kurs.jpg')}}" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">Zalety naszych kursów językowych</h2>
                            <p>Nasze kursy językowe zostały opracowane przez doświadczonych specjalistów, aby zapewnić Ci skuteczną i przyjemną naukę. Oto, co wyróżnia naszą ofertę:</p>
                            <ul>
                                <li>Interaktywne materiały dydaktyczne – ułatwiają przyswajanie wiedzy i sprawiają, że nauka staje się bardziej angażująca.</li>
                                <li>Regularne testy postępów – pomagają śledzić Twoje osiągnięcia i utrwalać zdobyte umiejętności.</li>
                                <li>Indywidualne podejście – dostosowujemy program nauczania do Twoich potrzeb i poziomu zaawansowania.</li>
                                <li>Dodatkowe materiały – nagrania audio i wideo umożliwiają naukę w dowolnym miejscu i czasie.</li>
                            </ul>
                            <p>Dołącz do nas i przekonaj się, jak łatwo można opanować język obcy!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="{{asset('kciuk.jpg')}}" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Dołącz do milionów zadowolonych użytkowników!</h2>
                            <p>Już miliony osób z całego świata zaufały naszym kursom językowym i z powodzeniem osiągnęły swoje cele językowe. Nie czekaj – zacznij swoją przygodę z nauką języków obcych już dziś i dołącz do grona naszych zadowolonych uczniów!</p>
                            <a class="btn btn-primary btn-xl rounded-pill mt-5" href="courses">Zobacz kursy</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">&copy; 2025 Golden Languages, Inc.</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        @vite('resources/js/scripts.js')
    </body>
</html>
