<div id="address-edit-modal" class="edit-modal">
    <form action="/profile/update-address" method="POST" class="edit-address-form">

        @csrf
        <label for="city">City:</label>
        <input type="text" name="city" value="{{ $user->address->city ?? '' }}" placeholder="{{ $user->address->city ?? 'City' }}">
        <label for="country">Country:</label>
        <input type="text" name="country" value="{{ $user->address->country ?? '' }}" placeholder="{{ $user->address->country ?? 'Country' }}">
        <label for="address">Address:</label>
        <input type="text" name="address" value="{{ $user->address->address ?? '' }}" placeholder="{{ $user->address->address ?? 'Name Surname' }}">
        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" value="{{ $user->address->postal_code ?? '' }}" placeholder="{{ $user->address->postal_code ?? 'Postal Code' }}">

        <button type="button" class="address-abort-edit" onclick="window.location.href='{{ route('profile') }}'">Cancel</button>
        <button type="submit" class="address-apply-edit">Save</button>
    </form>
</div>