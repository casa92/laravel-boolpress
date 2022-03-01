@extends('layouts.dashboard')

@section('content')

    <h1>Lista categorie:</h1>

    <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('admin.category_list', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
    
@endsection