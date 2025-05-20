@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Research Papers</h2>
    <a href="{{ route('research-papers.create') }}" class="btn btn-primary mb-3">Add New Paper</a>

    @foreach($papers as $paper)
        <div class="card mt-3">
            <div class="card-body">
                <h4>{{ $paper->title }}</h4>
                <p>{{ $paper->abstract }}</p>
                <span class="badge bg-info text-white">{{ ucfirst($paper->visibility) }}</span>
                <span class="float-end">{{ $paper->created_at->diffForHumans() }}</span>
            </div>
        </div>
    @endforeach
</div>
@endsection
