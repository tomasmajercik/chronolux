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
                <li class="logout-wrapper">
                    <form method="POST" action="{{ route('logout') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path
                                d="M5 15H16.875M7.5 18.75L3.75 15L7.5 11.25M13.75 8.75V7.5C13.75 6.83696 14.0134 6.20107 14.4822 5.73223C14.9511 5.26339 15.587 5 16.25 5H22.5C23.163 5 23.7989 5.26339 24.2678 5.73223C24.7366 6.20107 25 6.83696 25 7.5V22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H16.25C15.587 25 14.9511 24.7366 14.4822 24.2678C14.0134 23.7989 13.75 23.163 13.75 22.5V21.25"
                                stroke="red" stroke-width="2.83333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                            @csrf
                            <button class="logout" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function showHidden(event) {
        event.preventDefault();
        const wrapper = event.currentTarget;
        const hiddenDiv = wrapper.querySelector('.hidden-content');
        hiddenDiv.classList.toggle('hidden');
        wrapper.classList.toggle('active'); // rotate arrow
    }
</script>
@endpush
