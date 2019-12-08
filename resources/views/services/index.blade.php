@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Услуги клиники</h3>
    @foreach ($services as $service)
        <p><a href="{{ route('services') }}/{{ $service->id }}">{{ $service->title }}</a></p>
    @endforeach
    {{ $services->links() }}
</div>
@endsection
