@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<main>
    <x-adminSidebar :active="'editProduct'" />
    <h1>KIKIRIKII</h1>

</main>
@endsection
@push('scripts')

@endpush
