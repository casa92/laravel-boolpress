@extends('layouts.dashboard')

@section('content')
    <h2>{{ $category->name }}</h2>

    <ul>

        @forelse ($posts as $post)
            <li>
                <a href="{{ route('admin.posts.show', ['post' => $post->id ]) }}">{{ $post->title }}</a>
            </li>
        @empty
            <div>Non sono presenti post in questa categoria</div>
        @endforelse
    </ul>
    
@endsection