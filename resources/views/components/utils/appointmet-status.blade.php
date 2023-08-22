@props(['status' => 'started'])

@php
switch ($status) {
case 'started':
$class = 'success';
break;
case 'postponed':
$class = 'warning';
break;
case 'cancelled':
$class = 'danger';
break;
default:
$class = 'info';
}
@endphp

<span class="badge badge-light-{{ $class }}">{{ $status }}</span>
