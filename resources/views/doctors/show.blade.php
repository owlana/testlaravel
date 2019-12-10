@extends('layouts.app')

@section('content')
<div class="container">
        <h3 class="mb-2">{{ $doctor->name }}</h3>
    <img src="{{ asset($doctor->image_path) }}" height="250"/>
    @foreach ($doctor->specialities as $speciality)
        <div class="mb-1 text-muted">{{ $speciality->title }}</div>
    @endforeach
    <ul>
        @foreach ($doctor->services as $service)
            <li>{{ $service->title }} - {{ $service->pivot->price }} руб</li>
        @endforeach
    </ul>
    <hr/>

    @guest
        <p><a href="{{ route('login') }}">Войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>, чтобы записаться на услугу</p>
    @else
        @if (count($doctor->schedules))
            <div class="j-form">
                <h4>Записаться на приём</h4>
                <form method="POST" action="{{ route('signup') }}">
                    {{ csrf_field() }}
                    <div class="j-input-error"></div>
                    <div class="row">
                        <div class="col-md-5 mb-3 j-input-wrap">
                            <label for="date">Дата</label>
                            <select class="custom-select d-block w-100 j-date-select" onChange="getIntervals()" id="date" name="date" required>
                                <option value="" selected>Выберите дату</option>
                                @foreach($doctor->schedules as $schedule)
                                    <option value="{{ $schedule->id }}">{{ $schedule->date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 j-input-wrap">
                            <span>Время</span>
                            <div id="time_radio"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3 j-input-wrap">
                            <label for="date">Услуга</label>
                            <select class="custom-select d-block w-100 j-input" id="service" name="service" required>
                                <option value="">Выберите услугу</option>
                                @foreach ($doctor->services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary j-form-submit" type="submit">Записаться</button>
                </form>
                <div class="j-form-success" style="display: none">
                    <p>Вы записаны!</p>
                </div>
                <div class="j-form-error" style="display: none">
                    <p>Ошибка записи</p>
                </div>
            </div>
        @endif
    @endguest
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>

    <script>
        function getIntervals(){
            $.ajax({
                type:'POST',
                url:'{{ route('getintervals') }}',
                data:{
                    _token: '{{ csrf_token() }}',
                    date: $("#date").val()
                },
                success:function(data){
                    $('#time_radio').html(data);
                }
            });
        }
    </script>
@endsection
