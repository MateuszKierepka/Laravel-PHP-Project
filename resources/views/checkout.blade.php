<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Golden Languages | Checkout</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        @vite('resources/css/styles.css')
    </head>
    <body id="page-top" class="d-flex flex-column min-vh-100">
        <!-- Navigation-->
        @include('partials.navbar')
        <!-- Checkout Section-->
        <main class="page-section flex-grow-1" style="padding-top: 80px; padding-bottom: 20px;">
            <div class="container px-5">
                <div class="mb-4" style="padding-top: 20px;">
                    <ul class="list-group mb-4">
                        @foreach (session('cart') as $id => $details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @php
                                        $course = \App\Models\Course::find($id);
                                    @endphp
                                    @if($course && $course->image)
                                        <img src="{{ asset($course->image) }}" alt="{{ $details['title'] }}" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                                    @endif
                                    <div>
                                        <h5>{{ $details['title'] }}</h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span style="font-weight: bold; color: black; text-align: right; margin-right: 15px;">{{ $details['price'] }} zł</span>
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
                    @if (count(session('cart')) == 0)
                        <script>
                            window.location.href = "{{ route('cart.index') }}";
                        </script>
                    @endif
                </div>
                <div class="mb-4" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 1.25rem; font-weight: 500; margin-bottom: 0;">Kod Rabatowy (wpisz jeśli posiadasz)</h2>
                        <form action="{{ route('checkout.applyDiscount') }}" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" id="discount_code" name="discount_code" placeholder="Wpisz kod rabatowy">
                                <button type="submit" class="btn btn-primary">Zastosuj</button>
                            </div>
                            @if (session('discount_error'))
                                <p style="color: red;">{{ session('discount_error') }}</p>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="mb-4" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px;">
                    <h2 style="font-size: 1.25rem; font-weight: 500; margin-bottom: 15px;">Wybierz płatność</h2>
                    <form id="payment-form" action="{{ route('checkout.selectPaymentMethod') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('blik').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="blik" value="BLIK" checked>
                                    <label class="form-check-label ms-2" for="blik">
                                        <img src="{{ asset('images/blik.png') }}" alt="BLIK" style="width: 64px; height: 48px; margin-right: 10px;">
                                        BLIK
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('tpay').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="tpay" value="tpay">
                                    <label class="form-check-label ms-2" for="tpay">
                                        <img src="{{ asset('images/tpay.png') }}" alt="tpay" style="width: 64px; height: 48px; margin-right: 10px;">
                                        tpay Szybki przelew online
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('card').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                    <label class="form-check-label ms-2" for="card">
                                        <img src="{{ asset('images/card.png') }}" alt="Karta płatnicza" style="width: 64px; height: 48px; margin-right: 10px;">
                                        Karta płatnicza przez Internet
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('traditional').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="traditional" value="traditional">
                                    <label class="form-check-label ms-2" for="traditional">
                                        <img src="{{ asset('images/traditional.png') }}" alt="Przelew tradycyjny" style="width: 64px; height: 48px; margin-right: 10px;">
                                        Przelew tradycyjny
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('googlepay').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="googlepay" value="googlepay">
                                    <label class="form-check-label ms-2" for="googlepay">
                                        <img src="{{ asset('images/googlepay.png') }}" alt="Google Pay" style="width: 64px; height: 48px; margin-right: 10px;">
                                        Google Pay
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('visamobile').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="visamobile" value="visamobile">
                                    <label class="form-check-label ms-2" for="visamobile">
                                        <img src="{{ asset('images/visamobile.png') }}" alt="Visa Mobile" style="width: 64px; height: 48px; margin-right: 10px;">
                                        Visa Mobile
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check d-flex align-items-center" style="border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('paypo').checked = true;">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypo" value="paypo">
                                    <label class="form-check-label ms-2" for="paypo">
                                        <img src="{{ asset('images/paypo.png') }}" alt="PayPo" style="width: 64px; height: 48px; margin-right: 10px;">
                                        PayPo - zapłać za 30 dni
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr style="border-top: 2px solid black; margin-top: 40px; margin-bottom: 40px;">
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('cart.index') }}" class=" btn btn-link">< Wróć</a>
                    <div>
                        <div style="font-size: 1.2em; color: black;">
                            @if (session('discount'))
                                <div id="discount-section">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                        <span>Przed obniżką:</span>
                                        <span id="original-total" style="text-decoration: line-through; font-weight: bold; margin-left: 20px;">{{ number_format($total, 2) }} zł</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                        <span>Rabat:</span>
                                        <span id="discount-amount" style="font-weight: bold; margin-left: 20px;">-{{ number_format(session('discount')->discount_amount, 2) }} zł</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                        <span>Po Rabacie:</span>
                                        <span id="new-total" style="font-weight: bold; margin-left: 20px;">{{ number_format($totalAfterDiscount, 2) }} zł</span>
                                    </div>
                                </div>
                            @else
                                <div id="total-section" style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                                    <span>Łącznie:</span>
                                    <span id="total-amount" style="font-weight: bold; margin-left: 20px;">{{ number_format($total, 2) }} zł</span>
                                </div>
                            @endif
                        </div>
                        <form id="purchase-form" action="{{ route('user_courses.store') }}" method="POST" onsubmit="clearDiscountSession()">
                            @csrf
                            @foreach (session('cart') as $id => $details)
                                <input type="hidden" name="course_ids[]" value="{{ $id }}">
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-2" style="display: block; width: 100%;">Kup</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        @include('partials.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        @vite('resources/js/scripts.js')
        <script>
            function clearDiscountSession() {
                fetch("{{ route('checkout.clearDiscount') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
        </script>
    </body>
</html>
