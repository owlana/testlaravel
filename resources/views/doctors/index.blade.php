@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach ($doctors as $doctor)
            <li>
            	{{ $doctor->name }}
            	@foreach ($doctor->specialities as $speciality)
            		<br>{{ $speciality->title }}
            	@endforeach
            </li>
        @endforeach
    </ul>
    {{ $doctors->links() }}
</div>
@endsection
