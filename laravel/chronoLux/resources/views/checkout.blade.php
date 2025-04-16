<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <title>WTECH-Watch</title>
    <link rel="icon" href="IMGs/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<x-header/>

<main>
    <section class="cart-section">
        <nav class="categorization">
            <ul>
                <li><a href="cart.html">My Cart</a></li>
                <li><a href="#">Shipping</a></li>
            </ul>
        </nav>
        <div class="cart-wrapper">

            <div class="cart-overview-container">
                <div class="cart-header">
                    <h3>Shipping Information</h3>
                </div>

                <div class="form-wrapper">
                    <span class="input-holder">
                        <label>Name</label>
                        <input type="text" placeholder="John" required>

                        <label>Surname</label>
                        <input type="text" placeholder="Carrot" required>

                        <label>Address</label>
                        <input type="text" placeholder="Orange 123/45" required>
                    </span>
                    <span class="input-holder">
                        <label>Postal Code</label>
                        <input type="text" placeholder="010 10" required>

                        <label>City</label>
                        <input type="text" placeholder="Carrot City" required>

                        <label>State</label>
                        <input type="text" placeholder="Carroty" required>
                    </span>
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
            <x-cart-summary 
                button-message="Payment" 
                button-url="/payment" 
            />

        </div>
    </section>
</main>


</body>
</html>