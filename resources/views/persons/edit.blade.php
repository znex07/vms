@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            {{-- add header here if you want          --}}
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('persons.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    {{-- notify error if edit fails --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    {{-- check web.php for the routes; trace it from there. --}}
    <form action="{{ route('persons.update',$person->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            
                <div class="card">
                    <div class="card-header"> EDIT INDIVIDUAL </div>
                        <div class="card-body">
                            <div>
                                    {{-- put upload image here --}}
                            </div>
                                <div class="container" id="regis_con_name">
                                    <h5 id="regis_head">Complete Name</h5>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" placeholder="Lastname" value="{{ $person->last_name }}" name="last_name" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Firstname" value="{{ $person->first_name }}" name="first_name" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Middlename" value="{{ $person->middle_name }}" name="middle_name" id="regis_field"><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="container" id="regis_con">
                                    <h5 id="regis_head">Full Address</h5>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" placeholder="Floor No." value="{{ $person->floor_no }}" name="house_no" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="House/Room No." value="{{ $person->house_no }}" name="house_no" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Street" value="{{ $person->street }}" name="street" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Barangay" value="{{ $person->barangay }}" name="barangay" id="regis_field"><br>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col-4">
                                            <input type="text" placeholder="City" value="{{ $person->city }}" name="city" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                </div>
                                <div class="container" id="regis_con">
                                    <h5 id="regis_head">Contact Number</h5>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" placeholder="Phone Number" value="{{ $person->contact_no }}" name="contact_no" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Email" value="{{ $person->email }}" name="email" id="regis_field"><br>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="RFID" value="{{ $person->rf_id }}" name="rf_id" id="regis_field"><br>
                                        </div>
                                    </div>
                                </div><br><br>
                        </div>
                </div>
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection