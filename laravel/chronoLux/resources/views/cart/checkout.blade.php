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
        <form action="{{ route('cart.shipping') }}" method="POST">
            @csrf
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
                            <input type="email" id="email" placeholder="example@email.com" name="email" required>

                            <label>Name</label>
                            <input type="text" id="name" placeholder="John" name="name" required>
                        
                            <label>Surname</label>
                            <input type="text" id="surname" placeholder="Carrot" name="surname" required>
                        
                            <label>Address</label>
                            <input type="text" id="address" placeholder="Orange 123/45" name="address" required>
                        </div>
                        <div class="input-holder">
                            <label>Phone</label>
                            <input type="text" id="phone" placeholder="0912 345 679" name="phone_number" required>

                            <label>Postal Code</label>
                            <input type="text" id="postal_code" placeholder="010 10" name="postal_code" required>
                        
                            <label>City</label>
                            <input type="text" id="city" placeholder="Carrot City" name="city" required>
                        
                            <label>Country</label>
                            <input type="text" id="country" placeholder="Carroty" name="country" required>
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
                        :button_url="null"
                        :total_products="$totalProducts"
                        :shipping="$shipping"
                        :total="$total"
                    />
                @endif
            </div>
        </form>
    </section>
</main>
@endsection
@push('scripts')
<script>
    const prefill = @json($prefill);
    function prefillUserInfo(checkbox) {
        if (checkbox.checked) {
            document.getElementById('email').value = prefill.email || "";
            document.getElementById('phone').value = prefill.phone || "";
            document.getElementById('name').value = prefill.name || "";
            document.getElementById('surname').value = prefill.surname || "";
            document.getElementById('address').value = prefill.address || "";
            document.getElementById('postal_code').value = prefill.postal_code || "";
            document.getElementById('city').value = prefill.city || "";
            document.getElementById('country').value = prefill.state || "";
        } else {
            document.querySelectorAll('input[type="text"], input[type="email"]').forEach(input => input.value = "");
        }
    }
</script>
@endpush