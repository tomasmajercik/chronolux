@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('content')
    <x-sidebar :active="'settings'" />
@endsection