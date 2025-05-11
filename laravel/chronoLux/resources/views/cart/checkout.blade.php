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
        <form id="shipping-form" action="{{ route('cart.shipping') }}" method="POST">
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
                            <input type="text" id="phone" placeholder="0912 345 678" name="phone_number"
                                required title="Enter a valid phone number (e.g., 0912 345 678).">
                            <label>Postal Code</label>
                            <input type="text" id="postal_code" placeholder="010 01" name="postal_code"
                                required pattern="^\d{3}\s?\d{2}$"
                                title="Enter a valid postal code (e.g., 010 01).">
                            <label>City</label>
                            <input type="text" id="city" placeholder="Carrot City" name="city" required>
                        
                            <label>Country</label>
                            <input type="text" id="country" placeholder="Carroty" name="country" required>
                        </div>
                    </div>
                    <div class="delivery-method-holder">
                        <h3>Delivery Method</h3>

                        <div class="delivery-inputs">
                            <input type="radio" id="packeta" name="delivery" value="Packeta" checked>
                            <label for="packeta">Packeta</label><br>

                            <input type="radio" id="dpd" name="delivery" value="DPD">
                            <label for="dpd">DPD</label><br>

                            <input type="radio" id="posta" name="delivery" value="Slovenská pošta">
                            <label for="posta">Slovenská pošta</label><br>
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

    // Using AJAX to submit the form and validate the response on backend
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('shipping-form');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);
            const submitUrl = form.getAttribute('action');

            fetch(submitUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                let data;
                try {
                    data = await response.json();
                } catch (e) {
                    return alert('Invalid response from server.');
                }

                if (response.ok) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        alert(data.success || 'Shipping info updated.');
                    }
                } else {
                    const messages = data.errors
                        ? Object.values(data.errors).flat().join('\n')
                        : (data.error || 'Something went wrong.');
                    alert(messages);
                }
            })
            .catch(() => {
                alert('Network error or server is unreachable.');
            });
        });
    });

</script>
@endpush