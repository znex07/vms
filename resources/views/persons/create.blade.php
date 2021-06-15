@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                {{-- insert header here if you want --}}
            </div> 
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
    </div>

    {{-- if error appears then this will appear.  --}}
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

    {{-- success message will appear here if the registration successfull --}}
    @if ($message = Session::get('success'))
        <br>
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- registration body --}}
    <div class="row justify-content-center">
        {{-- this is the style of the div, to change overall design, delete the class="card" --}}
        <div class="card">
            {{-- this one is the card header --}}
            <div class="card-header"> <strong>REGISTRATION</strong></div>
            {{-- this will go to the Controller, check the web.php --}}
            <form action="{{ route('persons.store') }}" method="POST">
                {{-- always add csrf in every form or even filling up data --}}
                @csrf
                {{-- the id used here are from the public/css/regis_item.css; if you can change or add css there. --}}
                <br>
                <div class="container" id="regis_con_name">
                    <label for="level">Category:</label>
                    <select id="level" name="level">
                        <option value="visitor" selected >Visitor</option>
                        <option value="tenant">Tenant</option>
                        <option value="employee">Employee</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div> 
                <div class="container" id="regis_con">
                    <h5 id="regis_head">Complete Name</h5>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Lastname" name="last_name" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Firstname" name="first_name" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Middlename" name="middle_name" id="regis_field"><br>
                        </div>
                    </div>
                </div>
                <div class="container" id="regis_con">
                    <h5 id="regis_head">Full Address</h5>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Floor No." name="floor_no" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="House/Room No." name="house_no" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Street" name="street" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Barangay" name="barangay" id="regis_field"><br>
                        </div>
                    </div> <br>
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col-4">
                            <input type="text" placeholder="City" name="city" id="regis_field"><br>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="container" id="regis_con">
                    <h5 id="regis_head">Contact Number</h5>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Phone Number" name="contact_no" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Email" name="email" id="regis_field"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="RFID" name="rf_id" id="regis_field"><br>
                        </div>
                    </div>
                </div>   
                <br><br>
                <div class="container" id="regis_btns">
                <div class="row justify-content-center"id="regis_btn">
                    <button type="submit" name="btn-regis" class="btn btn-success" id="btn_regis_form" >REGISTER</button><br>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection