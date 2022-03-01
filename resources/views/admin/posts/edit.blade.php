@extends('layouts.dashboard')

@section('content')

    <section>
        <h2>Modifica post</h2>

        {{-- laravel Displaying The Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('PUT')


            <div class="mb-3">

                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title)}}">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Nessuna</option>
    
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach    
                </select>
            </div>

            <div class="mb-3">
               <h4>TAGS:</h4>
               @foreach ($tags as $tag)
                    <div class="form-check">
                        @if ($errors->any())
                            {{-- se sono presenti errori di validazione, decido se spuntare o meno la casella in base al valore dato da old() --}}
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                value="{{ $tag->id }}" 
                                id="tag-{{ $tag->id }}" 
                                name="tags[]" 
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                            >
                        @else
                            {{-- se non ci sono errori di validazione, decdo se spuntare la casella in base a $post->tags->contains --}}
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                value="{{ $tag->id }}" 
                                id="tag-{{ $tag->id }}" 
                                name="tags[]" 
                                {{ $post->tags->contains($tag) ? 'checked' : '' }}
                            >
                        @endif
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                   
               @endforeach
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ old('title', $post->content)}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
    
@endsection