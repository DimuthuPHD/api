<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #e0e0e0;
        /* Use a lighter border color */
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f7f7f7;
        /* Slightly darker background color for headers */
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
        /* Alternate row background color */
    }

    .status {
        /* display: inline-block; */
        padding: 6px 10px;
        /* border-radius: 4px; */
        font-weight: bold;
        text-align: center;
    }

    .status.pending {
        background-color: #ffc107;
        color: #fff;
    }

    /* Define styles for different statuses */
    .status.approved {
        background-color: #28a745;
        color: #fff;
    }

    .status.canceled {
        background-color: #dc3545;
        color: #fff;
    }

    .status.started {
        background-color: #65db81;
        color: #fff;
    }

    .status.postponed {
        background-color: #ffc107;
        color: #000;
    }

    .status.cancelled {
        background-color: #e03748;
        color: #fff;
    }

    .status.default {
        background-color: #58d6e9;
        color: #fff;
    }
</style>

<table>
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Job Seeker</th>
            <th scope="col">Consultant</th>
            <th scope="col">Date</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Created on</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
        @php
        $from = \Carbon\Carbon::parse($appointment->slot->time_from)->format('h:i A');
        $to = \Carbon\Carbon::parse($appointment->slot->time_to)->format('h:i A');
        $created = \Carbon\Carbon::parse($appointment->created_at)->format('Y-M-d h:i A');

        switch ($appointment->status->name) {
        case 'started':
        $class = 'status started';
        break;
        case 'postponed':
        $class = 'status postponed';
        break;
        case 'cancelled':
        $class = 'status cancelled';
        break;
        default:
        $class = 'status default';
        }

        @endphp
        <tr>
            <td>#{{$appointment->id}}</td>
            <td>{{$appointment->jobSeeker->full_name}}</td>
            <td>{{$appointment->slot->consultant->full_name}}</td>
            <td>{{$appointment->date}}</td>
            <td>{{$from}}</td>
            <td>{{$to}}</td>
            <td>{{$created}}</td>
            <td class="{{$class}}">
                <span class="status {{ strtolower($appointment->status ? $appointment->status->name : 'N/A') }}">
                    {{$appointment->status ? $appointment->status->name : 'N/A'}}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
