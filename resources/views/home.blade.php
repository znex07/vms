@extends('layouts.app')

@section('content')



<div class="container " style="height: 100vh !important;">
    <div class="row justify-content-center">
            <div class="container mb-2 bg-light">
                <h4 class="py-4 text-center">Welcome back, {{ Auth::user()->name }} !</h4>
            </div>
            <div class="col-md-6">

            <div class="card " id="c_color" >
                <div class="card-header"id="h_color"><i class="fa fa-users-cog"> </i> <b>DASHBOARD</b> </div>
                    <div class="card-body" id="card_some">
                        <div class="container" id="regis_btns">
                            <div class="row justify-content-center"  id="regis_btn">
                                {{-- <button type="button" id="btn_regis" class="btn btn-danger" onclick="window.location='{{ route('employees') }}'">Register</button> --}}
                                <button type="button"  onclick="window.location='{{ route('persons.create') }}'" class="btn btn-block btn-danger"><i class="fa fa-user"> </i> Register</button>
                            </div>
                            <div class="row justify-content-center"id="regis_btn">
                                <button type="button"  class="btn btn-block btn-success" onclick="window.location='{{ route('persons.index') }}'"><i class="fa fa-list"> </i> View</button>
                            </div>
                            </div>
                </div>
            </div>
        </div>
            <div class="col-md-6">

                <div class="card " id="c_color">
                    <div class="card-header" id="h_color"> <i class="fa fa-search"> </i> <b>CONTACT TRACING</b> </div>
                    <div class="card-body " id="card_some">
                        <div class="container justify-content-center" id="regis_btns">
                            <div class="row" id="regis_btn">
                                <a type="button"  class="btn btn-primary btn-block" href="search" ><i class="fa fa-qrcode"></i> For Tracing</a>
                            </div>
                            <div class="row "id="regis_btn">
                                <a  class="btn btn-info btn-block"  href="reports"><i class="fa fa-print"> </i> Print Reports</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
</div>

@endsection
