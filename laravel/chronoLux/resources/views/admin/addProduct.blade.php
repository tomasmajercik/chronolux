@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<main>
    <x-adminSidebar :active="'addProduct'" />
    <h1>MNAUU</h1>

</main>
@endsection
@push('scripts')

@endpush
