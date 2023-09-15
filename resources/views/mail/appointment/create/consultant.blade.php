<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Confirmed</title>
</head>

<body>

    Hello, {{$appointment->slot->consultant->first_name}}
    <p>We are pleased to confirm the successful creation of an appointment for your upcoming visa consultation. Please
        review the appointment details below: </p>
    @php
    $from = \Carbon\Carbon::parse($appointment->slot->time_from)->format('h:i:A');
    $to = \Carbon\Carbon::parse($appointment->slot->time_to)->format('h:i:A');
    @endphp
    <ul>
        <li>Job Seeker : {{$appointment->jobSeeker->full_name}}</li>
        <li>Date : {{$appointment->slot->date}}</li>
        <li>Time : {{$from}} to {{$to}}</li>
    </ul>

    <b>Additional Information: </p>

        <ul>
            <li>
                Please make sure to arrive 15 minutes before the scheduled time.</li>
            <li>
                Prepare any necessary documents or materials as discussed during your previous communication with our
                team.
            </li>
            <li>
                Ensure that your internet connection and video conferencing setup are in
                good working condition.
            </li>
            <li>
                If you have any questions or require further information, feel free to contact our Hotline 0112-1234567.
            </li>
            <li>
                Prepare any specific information or guidance required for the client based on their case details.
            </li>
        </ul>

        <i>Thank you for your commitment to providing exceptional visa consultation services. </i>

        <p>Best Regards,</p>
        <p>Jobs</p>

</body>

</html>