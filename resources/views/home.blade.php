@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Здравствуйте, {{ Auth::user()->name }}</div>
                <div class="card-body">
                    @if (count($appointments))
                        <h3>План записи к врачам</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Врач</th>
                                    <th>Услуга</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr id="appointment{{ $appointment->id }}">
                                        <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                        <td>{{ $appointment->name }}</td>
                                        <td>{{ $appointment->title }}</td>
                                        <td>
                                            <button class="btn btn-primary j-appointment-delete" onclick="deleteAppointment(this)"
                                                    data-appointment="{{ $appointment->id }}">Удалить</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Ваш план записи к врачам пуст.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>

    <script>
        function deleteAppointment(el){
            $.ajax({
                type:'POST',
                url:'{{ route('delappointment') }}',
                data:{
                    _token: '{{ csrf_token() }}',
                    appointment: $(el).data('appointment')
                },
                success:function(data){
                    if (!data.status) {
                        alert('Ошибка удаления');
                        return;
                    }
                    $('#appointment' + $(el).data('appointment')).remove();
                }
            });
        }
    </script>
@endsection
