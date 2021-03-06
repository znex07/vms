<!DOCTYPE html>
<html>
<head>
<Title>REPORT LOGS</Title>
</head>
<header></header>
{{-- NOTE: That the styles are should be here, make it simple, complicated css cannot work here unless you find a way --}}
<style>
    table, td, th{
        border: 1px solid black;
    }
    body{
        text-align: center;
    }
</style>
<body>

    {{-- you can customize these headers to become more flexible. Like changing the address for the user.   --}}
    <p><h3>{{Auth::user()->name}} Log Reports</h3> <br> 7461 Bagtikan Street, Makati City, Metro Manila, Philippines</p>
    <pre>This log report shouldn't be disclosed to the public as it contains personal information. Only to the eyes of the administrator.</pre>
    <br>



    {{-- these are the reports showed on the pdf. --}}
    <table class="table table-bordered" style="width: 100%; text-align:center; border:1px solid black">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Complete Name</th>
            <th>Address</th>
            <th>Email / Contact Number</th>
            <th>Status</th>
            <th>Level</th>
        </tr>
        @foreach ($lists as $log)
        <tr>
            <td>{{Carbon\Carbon::parse($log->date)->format('d M Y')}}</td>
            <td>{{Carbon\Carbon::parse($log->time)->format('h:i:s A')}}</td>
            <td>{{$log->last_name}}, {{$log->first_name}} {{$log->middle_name}}</td>
            <td>{{$log->house_no}} {{$log->street}} {{$log->barangay}}</td>
            <td>{{$log->email}} / {{$log->contact_no}}</td>
            <td>{{$log->status}}</td>
            <td>{{$log->level}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>
