@isset($slots)
@if ($slots->count() > 0)
@foreach ($slots as $key => $slot)
@php
$from = \Carbon\Carbon::parse($slot->time_from)->format('h:i:A');
$to = \Carbon\Carbon::parse($slot->time_to)->format('h:i:A');
@endphp
<label class="form-check-label slot-tile" for="slot_{{$key}}">
    <input class="form-check-input" id="slot_{{$key}}" type="radio" name="slot_id" value="{{$slot->id}}" {{
        $default==$slot->id ? 'checked' : null}}>
    <span class="date">
        {{\Carbon\Carbon::parse($slot->date)->format('d-M-Y')}}
    </span>
    <span class="time">
        from {{$from}} to {{$to}}
    </span>
</label>
@endforeach
@else
<p>No Slots available</p>
@endif
@endisset