@extends('layouts.dashboard')

@section('content')
    
    <div class="container">
        <h1>Area personale</h1>
        <div>
            <div>Benvenuto: {{ $user->name }}</div>

            {{-- @if ($user->userInfo)
                <div>Phone: {{ $user->userInfo->phone }}</div>
                <div>Address: {{ $user->userInfo->address }}</div>
            @endif --}}
            
            {{-- dopo aver passato trai i data di HomeController userInfo --}}
            @if ($userInfo)
                <div>Phone: {{ $userInfo->phone }}</div>
                <div>Address: {{ $userInfo->address }}</div>
            @endif
            
        </div>
    </div>
    
@endsection