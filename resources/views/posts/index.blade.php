@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    @foreach ($posts as $post)
                        <div class="post">
                            <div class="post-content">{{ $post->content }}</div>
                            @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="img-fluid">
                            @endif
                            <div class="post-meta">
                                <small>Posted by {{ $post->user->name }} on {{ $post->created_at->format('Y-m-d H:i') }}</small>
                                @if (Auth::id() === $post->user_id)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection