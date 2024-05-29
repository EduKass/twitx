@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control" placeholder="What's on your mind?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Create Post</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $post->user->name }}</strong>
                                    @if($post->user_id == auth()->id())
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </div>
                                <p>{{ $post->content }}</p>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    @else
                        <p>No posts yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
