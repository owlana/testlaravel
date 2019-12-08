@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-0">{{ $doctor->name }}</h3>
    <img src="" width="200" height="250"/>
    @foreach ($doctor->specialities as $speciality)
        <div class="mb-1 text-muted">{{ $speciality->title }}</div>
    @endforeach
    <ul>
        @foreach ($doctor->services as $service)
            <li>{{ $service->title }} - {{ $service->pivot->price }} руб</li>
        @endforeach
    </ul>
</div>
@endsection
