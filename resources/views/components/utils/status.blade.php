@props(['status' => 0, 'active' => 'active', 'disabled' => 'disabled'])
@if ($status === 1)
<span class="badge badge-light-success">{{$active}}</span>
@else
<span class="badge badge-light-danger">{{$disabled}}</span>
@endif
