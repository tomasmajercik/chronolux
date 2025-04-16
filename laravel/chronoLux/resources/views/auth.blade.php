@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <main>
        <section id="sign-in-section">
            <div class="container" id="container">
                <div class="form-container sign-in-container">
                    <h2>Sign in to ChronoLux</h2>
                    <form class="input-fields">
                        <label>Email</label>
                        <input type="email" class="input" placeholder="name.surname@mail.com">

                        <label for="password">Password</label>
                        <input type="password" class="input" placeholder="Password">

                        <a href="#">Forgot your password?</a>
                        <button>Sign In</button>
                        <span onclick="toggleLink()" class="sign-up-btn">Don't have an account yet?</span>
                    </form>
                </div>
                <div class="form-container sign-up-container">
                    <h2>Sign up to ChronoLux</h2>
                    <form class="input-fields" onsubmit="return validatePassword(event)">
                        <label>Email</label>
                        <input type="email" class="input" placeholder="name.surname@mail.com">

                        <label for="password">Password</label>
                        <input type="password" id="password" class="input" placeholder="••••••••" required>

                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" class="input" placeholder="••••••••" required>

                        <p id="error-message" style="color: red; display: none;">Passwords do not match!</p>
                        <button>Sign Up</button>
                        <span onclick="toggleLink()" class="sign-up-btn">Already have an account?</span>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h2>Join, Chronolux!</h2>
                            <p>
                                Create your account and unlock exclusive offers, early access to new arrivals, and a
                                personalized watch experience.
                            </p>
                            <button id="signInBtn" class="switch">Sign in</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h2>Welcome, back!</h2>
                            <p>
                                Log in to explore our latest collection of luxury timepieces and track your orders with
                                ease.
                                Timeless style is just a click away.
                            </p>
                            <button id="createAccountBtn" class="switch">Create an account</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        function validatePassword(event) {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm-password").value;
            let errorMessage = document.getElementById("error-message");

            if (password !== confirmPassword) {
                errorMessage.style.display = "block";
                event.preventDefault(); // Zastaví odoslanie formulára
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }
    </script>
@endpush