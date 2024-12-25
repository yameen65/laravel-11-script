<x-layouts.guest page-title="All Posts">
    <div class="container py-5">
        <h1 class="text-center mb-5 text-primary fw-bold">All Posts</h1>
        <div class="row g-4">
            @forelse($data['all'] as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="card-img-top img-fluid">
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
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                            <div class="mt-3">

                                @auth
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('posts.delete', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            @endauth
                                 <!-- Rating System -->
                                <form id="rating-form-{{ $post->id }}" action="{{ route('ratings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="rating" id="rating-input-{{ $post->id }}" value="0">
                                    <div class="star-rating" data-post-id="{{ $post->id }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star" data-value="{{ $i }}">&#9734;</span>
                                        @endfor
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Submit Rating</button>
                                </form>
                            </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            const updateStarVisuals = (stars, rating) => {
                stars.forEach(star => {
                    const starValue = star.getAttribute('data-value');
                    star.innerHTML = starValue <= rating ? '&#9733;' : '&#9734;';
                    star.classList.toggle('text-warning', starValue <= rating);
                });
            };

            document.querySelectorAll('.star-rating').forEach(container => {
                const postId = container.getAttribute('data-post-id');
                const stars = container.querySelectorAll('.star');
                const ratingInput = document.getElementById(`rating-input-${postId}`);

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const rating = star.getAttribute('data-value');
                        ratingInput.value = rating;

                        fetch(`/posts/${postId}/rate`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ rating })
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Failed to submit rating');
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                alert('Rating submitted successfully!');
                            } else {
                                alert('Failed to submit rating');
                            }
                        })
                        .catch(error => alert('An error occurred: ' + error.message));

                        updateStarVisuals(stars, rating);
                    });

                    star.addEventListener('mouseenter', () => {
                        const hoverValue = star.getAttribute('data-value');
                        updateStarVisuals(stars, hoverValue);
                    });

                    container.addEventListener('mouseleave', () => {
                        const currentRating = ratingInput.value || 0;
                        updateStarVisuals(stars, currentRating);
                    });
                });
            });
        });
    </script>
</x-layouts.guest>
