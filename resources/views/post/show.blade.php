<x-layouts.guest page-title="Show Post And Comments">
        <div class="container mt-5">

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $data->tittle }}</h1>
                    <p class="card-text">{{ $data->content }}</p>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3>Comments</h3>
                </div>
                <div class="card-body">
                    @if (isset($data->comments) && count($data->comments) > 0)
                        @foreach ($data->comments as $comment)
                            <div class="mb-3">
                                <p class="mb-1">
                                    <strong>{{ $comment->user_name }}</strong> says:
                                </p>
                                <p class="text-muted">{{ $comment->content }}</p>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endif
                </div>
            </div>


            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3>Add a Comment</h3>
                </div>
                <div class="card-body">
                    @php
                        $user = App\Models\User::first();
                    @endphp
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="post_id" value="{{ $data->id }}">
                        <div class="mb-3">
                            <textarea name="content" class="form-control" rows="4" placeholder="Write your comment..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Comment</button>
                    </form>
                </div>
            </div>
        </div>
</x-layouts.guest>
