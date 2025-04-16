@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@php
    $orders = [
        [
            'date' => '21th December 2024',
            'images' => [
                'IMGs/tissot-3-sm.jpg',
                'IMGs/tissot-prx-sm.jpg',
                'IMGs/rolex-2-sm.jpg'
            ],
            'status' => 'Packing',
            'price' => '1 899.72',
            'link' => 'profile/order_detail.html'
        ],
        [
            'date' => '12th July 2024',
            'images' => [
                'IMGs/tissot-sm.jpg'
            ],
            'status' => 'Delivered',
            'price' => '1 899.72',
            'link' => 'profile/order_detail.html'
        ],
        [
            'date' => '22th November 2024',
            'images' => [
                'IMGs/tudor-sm.jpg',
                'IMGs/rolex-sm.jpg'
            ],
            'status' => 'Delivered',
            'price' => '1 899.72',
            'link' => 'profile/order_detail.html'
        ]
    ];
@endphp

@section('content')
<main>
    <!-- Sidebar -->
    <x-sidebar :active="'profile'" />
    <!-- Profile Content -->
    <div class="profile-content">
        <div class="profile-info">
            <div class="center">
                <img src="../IMGs/person.jpeg" alt="Profile Picture" class="profile-pic">
                <h3 class="profile-name">František Hraško</h3>
            </div>
            <div class="profile-info-title">
                <h5>Shipping Adress</h5>
                <a href="#">edit</a>
            </div>
            <p>Super city, super country <br>Perfect Street, 37/11<br>977 87</p>
            <div class="profile-info-title">
                <h5>Contact</h5>
                <a href="#">edit</a>
            </div>
            <div class="contact-info">
                <h6>Phone</h6>
                <p>+421 123 456 789</p>
                <h6>Email</h6>
                <p>myemail@mail.com</p>
            </div>

        </div>

        <div class="account-summary">
            <h2>Hello, František!</h2>
            <div class="summary">
                <div class="box">Member for <strong>8 months</strong></div>
                <div class="box">Ordered <strong>3 times</strong></div>
                <div class="box">Last order <strong>2 days ago</strong></div>
                <div class="box">Something <strong>28 days ago</strong></div>
            </div>

            <div class="last-orders-title">
                <h3>Last Orders</h3>
                <a href="orders.html">View all</a>
            </div>

            <div class="orders">
                @foreach ($orders as $order)
                <x-last-order
                    :orderDate="$order['date']"
                    :imageSrcs="$order['images']"
                    :status="$order['status']"
                    :price="$order['price']"
                    :detailLink="$order['link']"
                />
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
