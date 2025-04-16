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
        <x-order/>  
        <x-order/>  
    </div>
</main>
@endsection