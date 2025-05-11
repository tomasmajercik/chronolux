@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('title', 'Authentication')

@section('content')
    <main>
        <section id="sign-in-section">
            <div class="container" id="container">
                <div class="form-container sign-in-container">
                    {{-- Login form --}}
                    <h2>Sign in to ChronoLux</h2>
                    <form method="POST" action="{{ route('login') }}" id="login-form" class="input-fields">
                        @csrf

                        <label>Email</label>
                        <input type="email" name="email" class="input" placeholder="name.surname@mail.com">

                        <label for="password">Password</label>
                        <input type="password" name="password" class="input" placeholder="Password">

                        <!-- Error Message -->
                        <p id="login-error" class="error-message"></p>

                        <a href="#">Forgot your password?</a>
                        <button type="submit">Sign In</button>
                        <span onclick="toggleLink()" class="sign-up-btn">Don't have an account yet?</span>
                    </form>
                </div>

                {{-- Registration form --}}
                <div class="form-container sign-up-container">
                    <h2>Sign up to ChronoLux</h2>
                    <form method="POST" action="{{ route('register') }}" id="register-form" onsubmit="return validatePassword(event)" class="input-fields">
                        @csrf
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="input" placeholder="name.surname@mail.com">

                        <p id="email-error" class="error-message"></p>

                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="input" placeholder="••••••••" required>


                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="confirm-password" class="input" placeholder="••••••••" required>

                        <p id="password-error" class="error-message"></p>
                        <p id="password_confirmation-error" class="error-message"></p>

                        <button type="submit">Sign Up</button>
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
                event.preventDefault(); // Prevent form submission
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#login-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form from reloading the page

            // Reset previous error messages
            $('#email-error').text('');
            $('#password-error').text('');

            $.ajax({
                url: '{{ route("login") }}', // Laravel route for login
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect; // Redirect to profile if login is successful
                    }
                },
                error: function(xhr) {
                    // Handle validation errors or other errors
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.message; // The server sends a message like "Email or password are incorrect."

                        // Show the error message in the respective field
                        $('#login-error').text(errors);
                    } else {
                        // Handle generic errors
                        alert('An error occurred. Please try again.');
                    }
                }
            });
        });

        $('#register-form').on('submit', function(e) {
            e.preventDefault(); // blocks reload
            // reset previous error messages

            $('#email-error').text('');
            $('#password-error').text('');
            $('#password_confirmation-error').text('');

            $.ajax({
                url: '{{ route("register") }}', // Laravel route for registration
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    window.location.href = '/profile'; // if success, redirect to profile page 
                },
                error: function(xhr) {
                    // Handle errors here
                    if (xhr.status === 422) { // Validation errors
                        let errors = xhr.responseJSON.errors;

                        if (errors.email) {
                            $('#email-error').text(errors.email[0]);
                        }
                        if (errors.password) {
                            $('#password-error').text(errors.password[0]);
                        }
                        if (errors.password_confirmation) {
                            $('#password_confirmation-error').text(errors.password_confirmation[0]);
                        }

                    } else {
                        alert('An error occurred. Please try again.');
                    }
                }
            })
        });
        </script>

@endpush