@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('title', 'Settings')

@section('content')
<main>
    <x-sidebar :active="'settings'" />
    <div class="settings">
        <h1>Settings</h1>
        <div class="settings-container">
            <ul>
                <li>
                    <x-settings :settingText="'Change email'" />
                </li>
                <li>
                    <x-settings :settingText="'Change password'" />
                </li>
                <li>
                    <x-settings :settingText="'Log out'" />
                </li>
            </ul>
        </div>
    </div>
</main>
@endsection