@extends('layouts.app')
@section('content')

<div class="container py-6" id="s_container">
    <div class="container " style="height: 100%; padding-top:40px">
        <div class="card mb-3">

        <div class="card-header ">
            <h3 class="float-left">View Records</h3>
            <a class="btn btn-sm btn-primary float-right" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <div class="card-body">
            <form action="searchbyname" method="POST">
                @csrf
                <div class="row justify-content-center ">
                    <div class="col-md-4 p-2 border border-info rounded">
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker " >
                            <h6>FROM</h6>
                                <input placeholder="Select date" type="date" name="date_search1" class="form-control border border-success" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        {{-- TO --}}
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker " >
                                <h6>TO</h6>
                                <input placeholder="Select date" type="date" name="date_search2" class="form-control border border-success" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <h6>Search</h6>

                        <input class="text form-control border border-success" placeholder="search by name" name="name_person" autocomplete="off" autofocus >
                        <button type="submit" class="btn btn-success mt-3" id="s_search">View Logs</button>

                    </div>
                </div>
            </form>

        </div>
    </div>
    {{-- appear error message if any --}}
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
        <ul>
            @foreach ($errors->all() as $error)
                <h3><i class="fa fa-info-circle"></i> {{ $error }}</h3>
            @endforeach
        </ul>
    </div>
    @endif

    </div>
@endsection
