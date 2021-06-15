@extends('layouts.app')

@section('content')

<div class="container">
    <h4>Welcome back, {{ Auth::user()->name }} !</h4>
</div>
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="c_color">
                <div class="card-header"id="h_color"> <b>DASHBOARD</b> </div>
                    <div class="card-body" id="card_some">
                        <div class="container" id="regis_btns">
                            <div class="row justify-content-center"  id="regis_btn">
                                {{-- <button type="button" id="btn_regis" class="btn btn-danger" onclick="window.location='{{ route('employees') }}'">Register</button> --}}
                                <button type="button" id="btn_regis" onclick="window.location='{{ route('persons.create') }}'" class="btn btn-danger">Register</button>
                            </div>
                            </div>
                            <div class="container" id="regis_btns">
                            <div class="row justify-content-center"id="regis_btn">
                                <button type="button" id="btn_regis" class="btn btn-success" onclick="window.location='{{ route('persons.index') }}'">View</button>
                            </div>
                        </div>
                </div>
            </div>
            <br><br>
            <div class="card" id="c_color">
                <div class="card-header" id="h_color"> <b>CONTACT TRACING</b> </div>
                    <div class="card-body" id="card_some">
                        <div class="container" id="regis_btns">
                        <div class="row justify-content-center" id="regis_btn">
                            <button type="button" id="btn_regis" class="btn btn-primary" onclick="window.location='{{ route('search') }}'" target="_blank">Scan For Tracing</button>
                        </div>
                        </div>
                        <div class="container" id="regis_btns">
                        <div class="row justify-content-center"id="regis_btn">
                            <a target="_blank" class="btn btn-info" id="btn_regis" href="pdflogs">Print Reports</a>
                        </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>

@endsection
