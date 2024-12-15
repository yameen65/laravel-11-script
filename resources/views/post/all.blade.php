<x-layouts.guest page-title="All Posts">
    <div class="container py-5">
        <h1 class="text-center mb-5 text-primary fw-bold">All Posts</h1>
        <div class="row g-4">
            @forelse($data['all'] as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->tittle }}" class="card-img-top img-fluid">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="Default Image" class="card-img-top img-fluid">
                        @endif
                        <div class="position-relative">
                            <div class="date-badge bg-primary text-white py-1 px-3 rounded">
                                {{ $post->created_at->format('F j, Y') }}
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->tittle }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center d-flex justify-content-between">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                            @auth
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('posts.delete', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No posts available at the moment. Check back later!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.guest>
