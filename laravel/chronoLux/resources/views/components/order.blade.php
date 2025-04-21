@props(['orderDate', 'orderNumber', 'total', 'address', 'images'])
<div class="order-container">
    <div class="top">
        <div class="left">
            <div class="order-date">
                <h3>Order Placed</h3>
                <span class="text"> {{ $orderDate }} </span>
            </div>
            <div class="total">
                <h3>Total</h3>
                <span class="text">{{ $total }}</span>
            </div>
            <div class="ship-to">
                <h3>Ship to</h3>
                <span class="text">{{ $address }}</span>
            </div>
        </div>
        <div class="order-number">
            <div>
                <h3>Order Number</h3>
                <span class="text">{{ $orderNumber }}</span>
            </div>
            <button class="manage mobile"
                onclick='window.location.href="./orders"'>Manage</button>
        </div>
    </div>
    <div class="order-info">
        <div class="img-container">
             @foreach($images as $image)
                <img src="{{ asset($image) }}" alt="">
            @endforeach
        </div>
        <button class="manage" onclick="location.href='orders'">Manage</button>
    </div>
    <div class="bottom">
        <div class="order-estimation">
            <h3>Estimated Delivery</h3>
            <span class="text">15.12.2021</span>
        </div>
    </div>
</div>