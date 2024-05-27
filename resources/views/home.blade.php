@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="mb-3">
                                <strong>{{ $post->user->name }}</strong>
                                <p>{{ $post->content }}</p>
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
