@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/profile/profile-modals.css') }}">
@endpush

@section('title', 'Profile')

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
                            <input type="text" name="name" class="name-input" value="{{ $user->name ?? '' }}" placeholder="{{ $user->name ?? 'Name Surname' }}" autofocus>
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
            @include('partials.address-edit-modal')
            <div class="profile-info-title">
                <h5>Shipping Adress</h5>
                <button class="edit-address-btn" onclick="openAddressEditModal()">edit</button>
            </div>
            @if ($user->address)
                <p>
                    {{ $user->address->city }}, {{ $user->address->country }} <br>
                    {{ $user->address->address }}<br>
                    {{ $user->address->postal_code }}
                </p>
            @else
                <p>Address not set: tap edit to set default address</p>
            @endif
           @if ($errors->address->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->address->all() as $error)
                            <li class="error">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            

            @include('partials.contact-edit-modal')
            <div class="profile-info-title">
                <h5>Contact</h5>
                <button class="edit-address-btn" onclick="openContactEditModal()">edit</button>
            </div>
            <div class="contact-info">
                <p><b>Phone</b></p>
                @if($user->phone_number)
                    <p>
                        {{ $user->phone_number ?? 'unset' }}
                    </p>
                @else
                    <p class="name-placeholder">Phone number not set</p>
            @endif
            @if($user->email)
                <p><b>Email</b></p>
                <p>{{ $user->email }}</p>
            @endif
            @if($errors->has('email'))
                <p class="error"> {{ $errors->first('email') }} </p>
            @endif
            @if ($errors->contact->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->contact->all() as $error)
                            <li class="error">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            </div>

        </div>

        <div class="account-summary">
            <h2>Hello{{ ", " . explode(" ", $user->name)[0] }}</h2>
            <div class="summary">
                <div class="box">Member for <strong>{{ $memberSince }} months</strong></div>
                <div class="box">Ordered <strong>{{ $orderCount }} times</strong></div>
                <div class="box">Last order <strong>{{ $lastOrderDaysAgo ?? '0' }} days ago</strong></div>
                <div class="box">Money spent <strong>{{ $moneySpent . "€" ?? '0' }}</strong></div>
            </div>
            <div class="last-orders-title">
                <h3>Last Orders</h3>
                <a href="/profile/orders">View all</a>
            </div>

            <div class="orders">
                @if($orders->isEmpty())
                    <p class="note">You will see your orders here.</p>
                @endif
                @foreach ($orders as $order)
                <x-last-order
                    :orderDate="$order['date']"
                    :imageSrcs="$order['images']"
                    :status="$order['status']"
                    :price="$order['price']"
                    :detailLink="route('profile.orders.detail', ['id' => $order['id']])"
                />
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
    <script src="{{ asset('js/editingModals.js') }}"></script>
    <script>
        function showModal(){
            input.focus();
        }
    </script>
@endpush
