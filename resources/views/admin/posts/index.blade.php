@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <h1>Archivio privato dei post</h1>

       <div class="row row-cols-3">
           @foreach ($posts as $post)
               <div class="col">
                    <div>
                        {{-- style="max-width: 540px;" --}}
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                                    <div class="btn_back_card">
                                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ Str::substr($post->title, 0, 35) . '...' }}
                                        </h5>
                                        <p class="card-text">
                                            {{ Str::substr($post->content, 0, 110) . '...' }}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $post->updated_at }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           @endforeach

       </div>
    </div>
    
@endsection