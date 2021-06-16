@extends('layouts.app')

@section('content')
   <div class="container bg-light p-4">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> View Individual </h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('persons.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <br><br>
        {{-- this is the qrcode part; you can test the size of the qr; generated qr will based its value inside the ( )  --}}
        <div class="row justify-content-center">
            {!! QrCode::size(250)
                ->generate($person->uniq_id); !!}
        <img src="/{{$person->path}}" alt="" id="profile_pic" style="height:250px; width: 250px" srcset="" class="mb-1 img-thumbnail">
        </div>

        <br>
        <div id="s_container">
            <h1>{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</h1><br>
            <h3>Card No: @if (empty($person->rf_id))
                            None
                        @else
                        {{ $person->rf_id }}
                        @endif
             <br> Unique ID: {{ $person->uniq_id }}</h3><br>

            <h5 style="text-transform: capitalize">
                @if (empty($person->floor_no))
                    {{ $person->house_no }} {{ $person->street }}, {{ $person->barangay }}, {{ $person->city }} <br>
                @else
                    @if ($person->floor_no=='1')
                        {{ $person->floor_no }}st floor, Room No. <strong>{{ $person->house_no }}</strong>; <br> {{ $person->street }} St. {{ $person->barangay }}, {{ $person->city }} <br>
                    @elseif($person->floor_no=='2')
                        {{ $person->floor_no }}nd floor, Room No. <strong>{{ $person->house_no }}</strong>; <br> {{ $person->street }} St. {{ $person->barangay }}, {{ $person->city }} <br>
                    @elseif($person->floor_no=='3')
                        {{ $person->floor_no }}rd floor, Room No. <strong>{{ $person->house_no }}</strong>; <br> {{ $person->street }} St. {{ $person->barangay }}, {{ $person->city }} <br>
                    @else
                        {{ $person->floor_no }}th floor, Room No. <strong>{{ $person->house_no }}</strong>; <br> {{ $person->street }} St. {{ $person->barangay }}, {{ $person->city }} <br>
                    @endif
                @endif
            Contact No: {{ $person->contact_no }} <br>
            Email Address: {{ $person->email }} <br> <br>
            Category: <strong>{{ $person->level }}</strong></h5>
        </div>
        {{-- you can add individual history logs here for the view --}}
    </div>
@endsection
