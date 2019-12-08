@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-0">{{ $service->title }}</h3>
    <ul>
        @foreach ($service->doctors as $doctor)
            <li>
                <a href="{{ route('doctors') }}/{{ $doctor->id }}">{{ $doctor->name }}</a>
                - {{ $doctor->pivot->price }} руб
            </li>
        @endforeach
    </ul>
</div>
@endsection
