@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<main>
    <x-adminSidebar :active="'statistics'" />
        <!-- Profile Content -->
        <div class="profile-content">
            <div class="profile-info">
                <div class="center">
                    <img src="../IMGs/person.jpeg" alt="Profile Picture" class="profile-pic">
                    <h3 class="profile-name">František Hraško</h3>
                    <h6>Administrator</h6>
                </div>
                <div class="main-content">
                    <div class="statistic-element">
                    <div class="statistic-container">
                        <h6>Orders this month</h6>
                        <h2>{{ number_format($ordersThisMonth) }} orders</h2>
                    </div>
                </div>

                <div class="statistic-element">
                    <div class="statistic-container">
                        <h6>New users this month</h6>
                        <h2>{{ number_format($newUsersThisMonth) }} new users</h2>
                    </div>
                </div>

                <div class="statistic-element">
                    <div class="statistic-container">
                        <h6>Total orders</h6>
                        <h2>{{ number_format($totalOrders) }} orders</h2>
                    </div>
                </div>

                <div class="statistic-element">
                    <div class="statistic-container">
                        <h6>Total sales this month</h6>
                        <h2>{{ number_format($salesThisMonth, 2, '.', ' ') }} €</h2>
                    </div>
                </div>

                <div class="statistic-element">
                    <div class="statistic-container">
                        <h6>Total sales this year</h6>
                        <h2>{{ number_format($salesThisYear, 2, '.', ' ') }} €</h2>
                    </div>
                </div>

                <div class="statistic-element">
                    <div class="statistic-container">
                        <h6>Total sales overall</h6>
                        <h2>{{ number_format($salesOverall, 2, '.', ' ') }} €</h2>
                    </div>
                </div>
                </div>

            </div>
        </div>
</main>
@endsection
@push('scripts')

@endpush
