<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <title>Golden Languages | Kontakt</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        @vite('resources/css/styles.css')
        <style>
            body, html {
                height: 100%;
            }
            .content {
                min-height: 100%;
                display: flex;
                flex-direction: column;
            }
            .main-content {
                flex: 1;
            }
            .footer {
                padding: 4rem 0;
            }
            .map-container {
                margin-top: 1rem;
                margin-bottom: 2rem;
            }
        </style>
    </head>
    <body id="page-top">
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                <div class="container px-5">
                    <a class="navbar-brand" href="/">Golden Languages</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="courses" class="nav-link">Kursy</a>
                            </li>
                            <li class="nav-item">
                                <a href="contact" class="nav-link">Kontakt</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/cart') }}" class="nav-link">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </li>
                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
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
            <section class="page-section main-content" id="contact" style="padding-top: 100px;">
                <div class="container px-5">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="mt-0">Skontaktuj się z nami!</h2>
                            <hr class="divider" />
                            <p class="text-muted mb-5">Masz pytania? Jesteśmy tutaj, aby pomóc. Skontaktuj się z nami za pomocą poniższych informacji.</p>
                        </div>
                    </div>
                    <div class="row gx-5 justify-content-center mb-5">
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                            <a class="d-block" href="tel:+48731911946">+48 731 911 946</a>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                            <a class="d-block" href="mailto:kontakt@goldenlanguages.com">kontakt@goldenlanguages.com</a>
                        </div>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-map-marker-alt fa-3x mb-3 text-muted"></i>
                            <div>ul. Topolowa 42, 31-506 Kraków, Polska</div>
                            <div class="map-container">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2562.123456789!2d19.945123456789!3d50.064123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47165b123456789%3A0x123456789abcdef!2sTopolowa%2042%2C%2031-506%20Krak%C3%B3w%2C%20Polska!5e0!3m2!1spl!2spl!4v1234567890" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="text-center mt-4">
                                <h3>Formularz pomocy</h3>
                            </div>
                            <form class="mt-4" action="{{ route('help.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label for="subject" class="form-label">Temat</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="" disabled selected>Wybierz temat</option>
                                        <option value="problem_z_zamowieniem">Problem z zamówieniem</option>
                                        <option value="dostepne_opcje_platnosci">Dostępne opcje płatności</option>
                                        <option value="wystawienie_faktury_vat">Wystawienie faktury VAT</option>
                                        <option value="inne">Inne</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Adres e-mail *" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Wprowadź poprawny adres e-mail">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Treść *" required></textarea>
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="attachment" class="form-label">Dodaj załącznik (opcjonalnie)</label>
                                    <input class="form-control" type="file" id="attachment" name="attachment">
                                </div>
                                <button type="submit" class="btn btn-primary">Wyślij zgłoszenie</button>
                            </form>
                            <div class="mb-5"></div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="py-5 bg-black footer">
                <div class="container px-5"><p class="m-0 text-center text-white small">&copy; 2025 Golden Languages, Inc.</p></div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        @vite('resources/js/scripts.js')
    </body>
</html>
