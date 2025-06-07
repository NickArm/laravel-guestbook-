<div class="grid gap-4">
    <div>
        <label class="form-label">Title</label>
        <input type="text" name="title" class="input" value="{{ old('title', $recommendation->title ?? '') }}" required>
    </div>

    <div>
        <label class="form-label">Image</label>
        <input type="file" name="image" class="input" accept="image/*">
        @if (!empty($recommendation->image_url))
            <img src="{{ $recommendation->image_url }}" class="w-32 mt-2 rounded border">
        @endif
    </div>

    <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="input" rows="3">{{ old('description', $recommendation->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="form-label">Website URL</label>
        <input type="url" name="website_url" class="input" value="{{ old('website_url', $recommendation->website_url ?? '') }}">
    </div>

    <div>
        <label class="form-label">Directions URL</label>
        <input type="url" name="directions_url" class="input" value="{{ old('directions_url', $recommendation->directions_url ?? '') }}">
    </div>

    <div>
        <label class="form-label">Category</label>
        <select name="category_id" class="input" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $recommendation->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ ucfirst($category->name) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end mt-4">
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
    </div>
</div>
