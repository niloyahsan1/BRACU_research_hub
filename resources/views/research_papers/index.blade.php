@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Public Research Papers</h2>
    @foreach($papers as $paper)
        <div class="card mt-3">
            <div class="card-body">
                <h4>{{ $paper->title }}</h4>
                <p>{{ $paper->abstract }}</p>
                <small>By {{ $paper->user->name }} | {{ $paper->created_at->diffForHumans() }}</small>

                <div class="mt-2">
                    <form method="POST" action="{{ route('research-papers.like', $paper) }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-primary">Like ({{ $paper->likes->count() }})</button>
                    </form>
                </div>

                <div class="mt-3">
                    <h5>Comments</h5>
                    @foreach($paper->comments as $comment)
                        <div class="mb-2">
                            <strong>{{ $comment->user->name }}:</strong> 
                            {{ $comment->body }} 
                            <em>({{ $comment->created_at->diffForHumans() }})</em>
                        </div>
                    @endforeach

                    <form method="POST" action="{{ route('research-papers.comment', $paper) }}">
                        @csrf
                        <textarea name="body" class="form-control mb-2" placeholder="Comment and tag using @username"></textarea>
                        <button class="btn btn-sm btn-success">Post Comment</button>
                    </form>
                </div>

                @if($paper->visibility == 'private' && $paper->user_id !== auth()->id())
                    <form method="POST" action="{{ route('research-papers.request-access', $paper) }}" class="mt-3">
                        @csrf
                        <button class="btn btn-warning">Request Access</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
