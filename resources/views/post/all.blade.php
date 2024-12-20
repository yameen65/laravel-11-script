<x-layouts.guest page-title="All Posts">
    <div class="container py-5">
        <h1 class="text-center mb-5 text-primary fw-bold">All Posts</h1>
        <div class="row g-4">
            @forelse($data['all'] as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->tittle }}"
                                class="card-img-top img-fluid">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                class="card-img-top img-fluid">
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
                                <form id="rating-form-{{ $post->id }}" action="{{ route('ratings.store') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="rating" id="rating-input-{{ $post->id }}"
                                        value="">


                                    <div class="star-rating" data-post-id="{{ $post->id }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star" data-value="{{ $i }}">&#9734;</span>
                                        @endfor
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Submit</button>
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
            const starContainers = document.querySelectorAll('.star-rating');

            starContainers.forEach(container => {
                const postId = container.getAttribute('data-post-id');
                const stars = container.querySelectorAll('.star');
                const ratingInput = document.getElementById(`rating-input-${postId}`);

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const rating = star.getAttribute('data-value');
                        ratingInput.value = rating;


                        stars.forEach(s => {
                            s.innerHTML = s.getAttribute('data-value') <= rating ?
                                '&#9733;' : '&#9734;';
                            s.classList.toggle('text-warning', s.getAttribute(
                                'data-value') <= rating);
                        });
                    });


                    star.addEventListener('mouseenter', () => {
                        const hoverValue = star.getAttribute('data-value');
                        stars.forEach(s => {
                            s.innerHTML = s.getAttribute('data-value') <=
                                hoverValue ? '&#9733;' : '&#9734;';
                        });
                    });

                    container.addEventListener('mouseleave', () => {
                        const currentRating = ratingInput.value || 0;
                        stars.forEach(s => {
                            s.innerHTML = s.getAttribute('data-value') <=
                                currentRating ? '&#9733;' : '&#9734;';
                        });
                    });
                });
            });
        });
    </script>
</x-layouts.guest>
