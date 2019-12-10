@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        @foreach ($doctors as $doctor)
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h3 class="mb-0">
                            <a href="{{ route('doctors') }}/{{ $doctor->id }}">{{ $doctor->name }}</a>
                        </h3>
                        @foreach ($doctor->specialities as $speciality)
                            <span class="mb-1 text-muted">{{ $speciality->title }}</span>
                        @endforeach
                        <div class="card-text mb-auto">
                            <ul>
                                @foreach ($doctor->services as $service)
                                    <li>{{ $service->title }} - {{ $service->pivot->price }} руб</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <img src="{{ asset($doctor->image_path) }}" class="bd-placeholder-img card-img-right flex-auto d-none d-lg-block" height="250"/>
                </div>
            </div>
        @endforeach
    </div>
    {{ $doctors->links() }}
</div>
@endsection
