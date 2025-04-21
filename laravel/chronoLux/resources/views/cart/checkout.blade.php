@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<main>
    <section class="cart-section">
        <nav class="categorization">
            <ul>
                <li><a href="/cart">My Cart</a></li>
                <li><a href="#">Shipping</a></li>
            </ul>
        </nav>
        <div class="cart-wrapper">

            <div class="cart-overview-container">
                <div class="cart-header">
                    <h3>Shipping Information</h3>
                </div>

                <div class="form-wrapper">
                    @auth
                        <div class="prefill">
                            <input type="checkbox" id="prefill" name="prefill" onchange="prefillUserInfo(this)">
                            <label for="prefill">Use information from your account</label>
                        </div>
                    @endauth
                    <div class="input-holder">
                        <label>Email</label>
                        <input type="text" id="email" placeholder="example@email.com" required>

                        <label>Name</label>
                        <input type="text" id="name" placeholder="John" required>
                    
                        <label>Surname</label>
                        <input type="text" id="surname" placeholder="Carrot" required>
                    
                        <label>Address</label>
                        <input type="text" id="address" placeholder="Orange 123/45" required>
                    </div>
                    <div class="input-holder">
                        <label>Phone</label>
                        <input type="text" id="phone" placeholder="0912 345 679" required>

                        <label>Postal Code</label>
                        <input type="text" id="postal_code" placeholder="010 10" required>
                    
                        <label>City</label>
                        <input type="text" id="city" placeholder="Carrot City" required>
                    
                        <label>Country</label>
                        <input type="text" id="country" placeholder="Carroty" required>
                    </div>
                </div>
                <div class="delivery-method-holder">
                    <h3>Delivery Method</h3>

                    <div class="delivery-inputs">
                        <input type="radio" id="standard" name="delivery" value="Standard" checked>
                        <label for="standard">Packeta</label><br>

                        <input type="radio" id="express" name="delivery" value="Express">
                        <label for="express">DPD</label><br>

                        <input type="radio" id="pickup" name="delivery" value="Pickup">
                        <label for="pickup">Slovenská pošta</label><br>
                    </div>
                </div>


            </div>
            @if (count($items) > 0)
                <x-cart-summary 
                    button_message="Payment" 
                    button_url="{{ route('cart.payment') }}" 
                    :total_products="$totalProducts"
                    :shipping="$shipping"
                    :total="$total"
                />
            @endif

        </div>
    </section>
</main>
@endsection
@push('scripts')
<script>
    function prefillUserInfo(checkbox) {
        if (checkbox.checked) {
            @auth
                document.getElementById('email').value = "{{ $prefill['email'] ?? '' }}";
                document.getElementById('phone').value = "{{ $prefill['phone'] ?? '' }}";
                document.getElementById('name').value = "{{ $prefill['name'] ?? '' }}";
                document.getElementById('surname').value = "{{ $prefill['surname'] ?? '' }}";
                document.getElementById('address').value = "{{ $prefill['address'] ?? '' }}";
                document.getElementById('postal_code').value = "{{ $prefill['postal_code'] ?? '' }}";
                document.getElementById('city').value = "{{ $prefill['city'] ?? '' }}";
                document.getElementById('country').value = "{{ $prefill['state'] ?? '' }}";
            @endauth
        } else {
            document.getElementById('email').value = "";
            document.getElementById('phone').value = "";
            document.getElementById('name').value = "";
            document.getElementById('surname').value = "";
            document.getElementById('address').value = "";
            document.getElementById('postal_code').value = "";
            document.getElementById('city').value = "";
            document.getElementById('country').value = "";
        }
    }
</script>
@endpush