@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('title', 'Edit Product')

@section('content')
<main>
    <x-adminSidebar :active="'editProduct'" />
    <h1>KIKIRIKII</h1>

</main>
@endsection
@push('scripts')

@endpush
