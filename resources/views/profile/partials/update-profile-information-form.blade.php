
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">Name</label>
            <input type="text" name="name" class="input" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Email -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">Email</label>
            <input type="email" name="email" class="input" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Bio -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">Bio</label>
            <textarea name="bio" class="input" rows="3">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Address -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">Address</label>
            <input type="text" name="address" class="input" value="{{ old('address', $user->address) }}">
        </div>

        <!-- Mobile Number -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">Mobile Number</label>
            <input type="text" name="mobile_number" class="input" value="{{ old('mobile_number', $user->mobile_number) }}">
        </div>

        <!-- Contact Me (JSON) -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Contact Methods</label>
            <div class="grow" id="contact-methods-container">
                @php
                    $contacts = old('contact_me', $user->contact_me ?? []);
                    if (is_string($contacts)) {
                        $contacts = json_decode($contacts, true);
                    }
                @endphp

                @foreach ($contacts as $index => $contact)
                    <div class="flex gap-2 mb-2 contact-method-row">
                        <select name="contact_me[{{ $index }}][type]" class="select">
                            <option value="email" {{ $contact['type'] === 'email' ? 'selected' : '' }}>Email</option>
                            <option value="website" {{ $contact['type'] === 'website' ? 'selected' : '' }}>Website</option>
                            <option value="viber" {{ $contact['type'] === 'viber' ? 'selected' : '' }}>Viber</option>
                            <option value="whatsapp" {{ $contact['type'] === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            <option value="instagram" {{ $contact['type'] === 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="phone" {{ $contact['type'] === 'phone' ? 'selected' : '' }}>Phone</option>
                        </select>
                        <input type="text" name="contact_me[{{ $index }}][value]" class="input grow" placeholder="Value" value="{{ $contact['value'] }}" />
                        <button type="button" class="btn btn-sm btn-light text-danger remove-contact-method">✕</button>
                    </div>
                @endforeach
                <button type="button" id="add-contact-method" class="btn btn-sm btn-light mt-2">+ Add Contact Method</button>
            </div>

        </div>


        <!-- Submit -->
        <div class="flex justify-end mt-5">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('contact-methods-container');
    const addBtn = document.getElementById('add-contact-method');
    let index = {{ count($contacts) }};

    addBtn.addEventListener('click', () => {
        const wrapper = document.createElement('div');
        wrapper.classList.add('flex', 'gap-2', 'mb-2', 'contact-method-row');

        wrapper.innerHTML = `
            <select name="contact_me[${index}][type]" class="select">
                <option value="email">Email</option>
                <option value="website">Website</option>
                <option value="viber">Viber</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="instagram">Instagram</option>
                <option value="phone">Phone</option>
            </select>
            <input type="text" name="contact_me[${index}][value]" class="input grow" placeholder="Value" />
            <button type="button" class="btn btn-sm btn-light text-danger remove-contact-method">✕</button>
        `;

        container.appendChild(wrapper);
        index++;
    });

    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-contact-method')) {
            e.target.closest('.contact-method-row').remove();
        }
    });
});
</script>
@endpush
