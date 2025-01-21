<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Golden Languages | Koszyk</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        @vite('resources/css/styles.css')
    </head>
    <body id="page-top" class="d-flex flex-column min-vh-100">
        <!-- Navigation-->
        @include('partials.navbar')
        <!-- Cart Section-->
        <main class="page-section flex-grow-1" style="padding-top: 70px; padding-bottom: 40px;">
            <div class="container px-5">
                <h1 class="my-4">Koszyk</h1>
                @php
                    use App\Models\Discount;
                @endphp
                @if (session('cart'))
                    <p style="font-weight: bold; font-size: 0.9em;">{{ count(session('cart')) }} kursy w koszyku.</p>
                    <div class="row">
                        <div class="col-lg-8">
                            <hr style="border-top: 1px solid #ccc;">
                            <ul class="list-group mb-4">
                                @foreach (session('cart') as $id => $details)
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border: none;">
                                        <div class="d-flex align-items-center">
                                            @php
                                                $course = \App\Models\Course::find($id);
                                            @endphp
                                            @if($course && $course->image)
                                                <img src="{{ asset($course->image) }}" alt="{{ $details['title'] }}" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                                            @endif
                                            <div>
                                                <h5>{{ $details['title'] }}</h5>
                                                <p>{{ $details['description'] }}</p>
                                                <span style="font-weight: bold; color: black; display: block; text-align: right;">{{ $details['price'] }} zł</span>
                                            </div>
                                        </div>
                                        <div>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-sm text-muted" style="font-weight: normal;">
                                                    <i class="fas fa-trash-alt fa-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: gray;">Łącznie:</h5>
                                    <div id="total-section" style="font-size: 1.2em; color: black; display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span>Razem:</span>
                                        <span id="total-amount" style="font-weight: bold;">{{ $total }} zł</span>
                                    </div>
                                    <div id="discount-section" style="display: none; font-size: 1.2em; color: black;">
                                        <div style="display: flex; justify-content: space-between;">
                                            <span>Przed obniżką:</span>
                                            <span id="original-total" style="text-decoration: line-through; font-weight: bold;"></span>
                                        </div>
                                        <div style="display: flex; justify-content: space-between;">
                                            <span>Rabat:</span>
                                            <span id="discount-amount" style="font-weight: bold;"></span>
                                        </div>
                                        <div style="display: flex; justify-content: space-between;">
                                            <span>Po obniżce:</span>
                                            <span id="new-total" style="font-weight: bold;"></span>
                                        </div>
                                    </div>
                                    <div style="text-align: right; margin-top: 5px;">
                                        @if (Auth::check())
                                            <a href="{{ route('checkout') }}" class="btn btn-primary mb-2">Idź do kasy</a>
                                        @else
                                            <a href="{{ route('register') }}" class="btn btn-primary mb-2">Idź do kasy</a>
                                        @endif
                                    </div>
                                    <hr style="border-top: 1px solid #ccc; margin-top: 5px;">
                                    <h5 class="card-title" style="color: gray;">Promocje:</h5>
                                    <form id="discount-form">
                                        @csrf
                                        <div class="mb-3 d-flex">
                                            <input type="text" class="form-control me-2" id="discount_code" name="discount_code" placeholder="Wpisz kupon">
                                            <button type="submit" class="btn btn-primary">Zastosuj</button>
                                        </div>
                                        <p id="discount-error" style="color: red; display: none;"></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p>Twój koszyk jest pusty.</p>
                @endif
            </div>
        </main>
        <!-- Footer-->
        @include('partials.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        @vite('resources/js/scripts.js')
        <script>
            document.getElementById('discount-form').addEventListener('submit', function(e) {
                e.preventDefault();
                let discountCode = document.getElementById('discount_code').value;
                let token = document.querySelector('input[name="_token"]').value;

                fetch('{{ route("cart.applyDiscountAjax") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ discount_code: discountCode })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('total-amount').innerText = parseFloat(data.total).toFixed(2) + ' zł';
                        document.getElementById('original-total').innerText = parseFloat(data.total).toFixed(2) + ' zł';
                        document.getElementById('discount-amount').innerText = '-' + parseFloat(data.discountAmount).toFixed(2) + ' zł';
                        document.getElementById('new-total').innerText = parseFloat(data.newTotal).toFixed(2) + ' zł';
                        document.getElementById('discount-section').style.display = 'block';
                        document.getElementById('total-section').style.display = 'none';
                        document.getElementById('discount-error').style.display = 'none';
                    } else {
                        document.getElementById('discount-error').innerText = data.message;
                        document.getElementById('discount-error').style.display = 'block';
                    }
                });
            });
        </script>
    </body>
</html>
