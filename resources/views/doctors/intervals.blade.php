@foreach ($intervals as $interval)
    <input type="radio" name="interval" id="interval{{ $interval->id}}" class="j-input"
           value="{{ $interval->pivot->id}}" required>
    <label for="interval{{ $interval->id}}">{{ $interval->time }}</label>
@endforeach
