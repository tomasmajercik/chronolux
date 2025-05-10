@extends('layouts.app')

@section('title', 'Thank you!')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/proceed.css') }}">
@endpush

@section('content')
<main>
        <div id="thanks" class="thanks-hide">
            <h1 class="thanksh1">Thank you.</h1>
            <h3 class="thanksh3">Your order was compleeted <b>successfully.</b></h3>
        </div>
        <div id="order-info" class="order-info">
            <div class="order-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M22 5.5H9c-1.1 0-2 .9-2 2v9a2 2 0 0 0 2 2h13c1.11 0 2-.89 2-2v-9a2 2 0 0 0-2-2m0 3.67l-6.5 3.33L9 9.17V7.5l6.5 3.31L22 7.5zM5 16.5c0 .17.03.33.05.5H1c-.552 0-1-.45-1-1s.448-1 1-1h4zM3 7h2.05c-.02.17-.05.33-.05.5V9H3c-.55 0-1-.45-1-1s.45-1 1-1m-2 5c0-.55.45-1 1-1h3v2H2c-.55 0-1-.45-1-1" />
                </svg>
                <h4>
                    An email receipt including all necessary details has been sent to your email address. Please keep it
                    for your records.
                </h4>
            </div>
        </div>
        @auth
            <div id="profile-redirect" class="profile-redirect">
                <p>
                    You can now check your order in your profile. Go to your profile and select 'orders', or press <a
                        class="nice-a" href="{{ route('profile.orders') }}">here</a>.
                </p>
            </div>
        @endauth
    </main>
@endsection