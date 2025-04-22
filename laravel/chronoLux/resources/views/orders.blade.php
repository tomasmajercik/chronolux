@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('title', 'Orders')

@section('content')
<main>
    <x-sidebar :active="'orders'" />
    <div class="orders">
        <h1>Orders</h1>

        @if($orders->isEmpty())
            <p class="note">You will see your orders here.</p>
        @endif
        @foreach($orders as $order)
           <x-order
                :url="route('profile.orders.detail', ['id' => $order['id']])"
                :orderDate="$order['date']"
                :orderNumber="$order['id']"
                :total="$order['price']"
                :address="$order['address']"
                :images="$order['images']"
            />
        @endforeach


    </div>
</main>
@endsection