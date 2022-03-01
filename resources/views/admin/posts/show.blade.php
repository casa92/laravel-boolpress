@extends('layouts.dashboard')

@section('content')
    <h1>
        {{ $post->title }}
    </h1>
    
    {{-- slug --}}
    <div class="mb-2">
        <strong>
            Slug:
            {{ $post->slug }}
        </strong>
    </div>

    {{-- categoria --}}
    <div class="mb-2">
        <strong>
            Category:
        </strong>
        {{ $post->category ? $post->category->name : 'nessuna' }}
        
    </div>

    {{-- categoria --}}
    <div class="mb-2">
        <strong>Tags:</strong>
        @forelse ($post->tags as $tag)
            {{ $tag->name }}{{ $loop->last ? '' : ',' }}
        @empty
            nessuno
        @endforelse
    </div>

    <p>
        {{ $post->content }}
    </p>

    <div class="post-buttons">
        <div class="single-button">
            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">
                <button type="submit" class="btn btn-primary">
                    Modifica
                </button>
            </a>
        </div>
    
        <div class="single-button">
            <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('DELETE')
    
                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>
        </div>
    </div>
    
@endsection