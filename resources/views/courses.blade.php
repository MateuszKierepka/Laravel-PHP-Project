<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Golden Languages | Kursy</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        @vite('resources/css/styles.css')
        <style>
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            main {
                flex: 1;
                padding-top: 80px;
            }
            .card-img-top {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }
            .card-body {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .card-text {
                flex-grow: 1;
            }
            .in-cart {
                color: gray;
                font-weight: bold;
            }
        </style>
    </head>
    <body id="page-top">
        @include('partials.navbar')
        <main class="page-section">
            <div class="container px-5">
                <div class="row gx-5">
                    @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset($course->image) }}" alt="{{ $course->title }}">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $course->title }}</h4>
                                    <p class="card-text">{{ $course->description }}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $course->price }} zł</small>
                                    @php
                                        $userOwnsCourse = Auth::check() && \App\Models\UserCourse::where('user_id', Auth::id())->where('course_id', $course->id)->exists();
                                    @endphp
                                    @if($userOwnsCourse)
                                        <span class="text-success" style="font-weight: bold;">Posiadane</span>
                                    @else
                                        @if(session('cart') && array_key_exists($course->id, session('cart')))
                                            <span class="in-cart">W koszyku</span>
                                        @else
                                            <form action="{{ route('cart.add', $course->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Kup teraz</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
        @include('partials.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        @vite('resources/js/scripts.js')
    </body>
</html>
