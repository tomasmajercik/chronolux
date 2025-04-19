<div id="contact-edit-modal" class="edit-modal">
    <form action="/profile/update-contact" method="POST" class="edit-address-form">

        @csrf
        <label for="phone-number">Phone number:</label>
        <input type="text" name="phone-number" value="{{ $user->phone_number ?? '' }}" placeholder="{{ $user->phone_number ?? '+421 123 456 789' }}">
        <label for="email">Email:</label>
        <input type="text" name="email" value="{{ $user->email ?? '' }}" placeholder="{{ $user->email ?? 'Email' }}">

        <button type="button" class="address-abort-edit" onclick="window.location.href='{{ route('profile') }}'">Zrušiť</button>
        <button type="submit" class="address-apply-edit">Uložiť</button>
    </form>
</div>