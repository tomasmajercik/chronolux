@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('title', 'Profile')

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
                <div class="profile-info-name">
                    
                    @if (isset($isEditingName) && $isEditingName)
                        <form action="/profile/update-name" method="POST" class="edit-name-form">
                            @csrf
                            <input type="text" name="name" class="name-input" value="{{ $user->name ?? '' }}" placeholder="{{ $user->name ?? 'Name Surname' }}">
                            <button type="button" class="abort-edit" onclick="window.location.href='{{ route('profile') }}'">Zrušiť</button>
                            <button type="submit" class="apply-edit">Uložiť</button>
                        </form>
                    @else
                        <h3 class="profile-name">
                            @if ($user->name)
                                {{ $user->name }}
                            @else
                                <span class="name-placeholder">Name Surname</span>
                            @endif
                        </h3>
                        <form action="{{ route('profile.edit-name') }}" method="POST">
                            @csrf
                            <button type="submit" class="pencil">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 36 36" fill="none">
                                    <path d="M20.5498 13.1542L21.9237 14.5281L8.65256 27.77H7.30791V26.4253L20.5498 13.1542ZM25.8114 4.38477C25.446 4.38477 25.066 4.53092 24.7883 4.80862L22.1137 7.4833L27.5946 12.9642L30.2692 10.2895C30.8393 9.71951 30.8393 8.76949 30.2692 8.22871L26.8492 4.80862C26.5568 4.51631 26.1915 4.38477 25.8114 4.38477ZM20.5498 9.04719L4.38477 25.2122V30.6931H9.86567L26.0307 14.5281L20.5498 9.04719Z" fill="black"/>
                                </svg>
                            </button>
                        </form>
                        
                    
                    @endif
                </div>
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
