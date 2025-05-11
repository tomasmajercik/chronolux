<div class="setting-link" id="setting-link">
    <a href="#" onclick="showHidden(event)">
        <p><b>{{ $settingText }}</b></p>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="31" viewBox="0 0 16 31" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M13.5427 16.4183L6.00008 23.7253L4.11475 21.8989L10.7147 15.5051L4.11475 9.11139L6.00008 7.28497L13.5427 14.5919C13.7927 14.8342 13.9331 15.1626 13.9331 15.5051C13.9331 15.8476 13.7927 16.1761 13.5427 16.4183Z"
                fill="#6A6A6A" />
        </svg>
    </a>
    <div class="hidden-content hidden">

        @if($settingText == 'Change email')
            <div id="edit-modal" class="edit-modal">
                <form action="{{ route('profile.update-email') }}" method="POST" class="edit-form" id="edit-email-form">
                    @csrf
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="{{ $user->email ?? '' }}" placeholder="{{ $user->email ?? 'Email' }}">

                    <button type="button" class="abort-edit" onclick="window.location.href='{{ route('profile.settings') }}'">Cancel</button>
                    <button type="submit" class="apply-edit">Save</button>
                </form>
                <p class="error" id="email-error"></p>
                <p class="success" id="email-success"></p>
                <p class="note"><b>NOTE: </b>if you change email, you have to log in with it</p>
            </div>
            @if($errors->has('email'))
                <p class="error"> {{ $errors->first('email') }} </p>
            @endif

        @elseif($settingText == 'Change password')
            <div id="edit-modal" class="edit-modal">
                <form action="{{ route('profile.update-password') }}" method="POST" class="edit-form" id="edit-password-form">
                    @csrf
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" placeholder="Current Password" required>

                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" placeholder="New Password" required>

                    <label for="new_password_confirmation">Confirm New Password:</label>
                    <input type="password" name="new_password_confirmation" placeholder="Confirm New Password" required>

                    <button type="button" class="abort-edit" onclick="window.location.href='{{ route('profile.settings') }}'">Cancel</button>
                    <button type="submit" class="apply-edit">Save</button>
                </form>

                <p class="error" id="password-error"></p>
                <p class="success" id="password-success"></p>
                <p class="note" id="password-refresh-countdown"></p>
            </div>
            @if($errors->has('current_password'))
                <p class="error"> {{ $errors->first('current_password') }} </p>
            @endif
            @if($errors->has('new_password'))
                <p class="error"> {{ $errors->first('new_password') }} </p>
            @endif
            @if($errors->has('new_password_confirmation'))
                <p class="error"> {{ $errors->first('new_password_confirmation') }} </p>
            @endif
        
        @endif
    </div>
</div>


@push('scripts')
<script>
    function showHidden(event) {
        event.preventDefault();
        const wrapper = event.currentTarget.closest('.setting-link');
        const hiddenDiv = wrapper.querySelector('.hidden-content');
        hiddenDiv.classList.toggle('hidden');
        wrapper.classList.toggle('active'); // rotate arrow
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#edit-email-form').on('submit', function(e) {
        e.preventDefault();

        // Reset error/success messages
        $('#email-error').text('');
        $('#email-success').text('');

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                $('#email-success').text(response.message || 'Email successfully updated.');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors && errors.email) {
                        $('#email-error').text(errors.email[0]);
                    }
                } else {
                    $('#email-error').text('An unexpected error occurred.');
                }
            }
        });
    });
    $('#edit-password-form').on('submit', function(e) {
        e.preventDefault(); 

        // Reset error/success messages
        $('#password-error').text('');
        $('#password-success').text('');

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(), 
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                $('#password-success').text(response.message || 'Password successfully updated.');
                $('#edit-password-form :input').prop('disabled', true);
                
                let countdown = 6; // 5 seconds countdown
                const interval = setInterval(() => {
                    countdown--;
                    $('#password-refresh-countdown').text(`Page will refresh in ${countdown}...`);

                    if (countdown <= 0) {
                        clearInterval(interval);
                        location.reload(); // Refresh page
                    }
                }, 1000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors && errors.current_password) {
                        $('#password-error').text(errors.current_password[0]);
                    }
                    if (errors && errors.new_password) {
                        $('#password-error').text(errors.new_password[0]);
                    }
                } else {
                    $('#password-error').text('');
                }
            }
        });
    });

</script>

@endpush
