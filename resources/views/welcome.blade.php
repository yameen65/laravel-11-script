<x-layouts.guest page-title="Laravel Blog">
    <header class="bg-dark text-white text-center py-4">
        <h1>Laravel Blog</h1>
        <p class="lead">A Place to Share Your Ideas</p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            @auth
                <a class="navbar-brand" href="{{ route('posts.create') }}">Create Post</a>
                <a class="navbar-brand" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a class="navbar-brand" href="{{ route('login') }}">Login</a>
            @endauth

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"></ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2 class="text-center mb-4 text-primary">Explore Latest Posts</h2>
        <div class="row g-4">
            @php
                $posts = App\Models\Post::latest()->get();
            @endphp

            @forelse($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->tittle }}" class="card-img-top img-fluid">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="Default Image" class="card-img-top img-fluid">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->tittle }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($post->content, 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">Read More</a>
                            @auth
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('posts.delete', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No posts available. Be the first to create one!</p>
            @endforelse
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Laravel Blog | Magicians Shoppers 💖</p>
    </footer>
</x-layouts.guest>
