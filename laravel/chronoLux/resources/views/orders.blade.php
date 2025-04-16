@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('content')
<main>
    <x-sidebar :active="'orders'" />
    <div class="orders">
        <x-order/>  
    </div>
</main>
@endsection