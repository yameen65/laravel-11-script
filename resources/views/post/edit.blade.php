<x-layouts.guest page-title="Edit Post">
    <div class="container">
        <h1 class="mb-4">Edit Post</h1>
        <form action="{{ route('posts.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tittle" class="form-label">Tittle</label>
                <input type="text" name="tittle" id="tittle" class="form-control"
                    value="{{ old('tittle', $data->tittle) }}" required>
                @error('tittle')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($data->image)
                    <div class="mt-2">
                        <p>Current Image:</p>
                        <img src="{{ asset('storage/' . $data->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                @endif
                @error('image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $data->content) }}</textarea>
                @error('content')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.guest>
