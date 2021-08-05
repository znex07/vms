@extends('layouts.app')

@section('content')


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('css/visitor_regis.css') }}" rel="stylesheet">
<link rel="stylesheet" href="style.css">

<div class="container" >

    <div class="card">


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

            {!! QrCode::size(250)->generate( Session::get('uniq_id') ); !!}
        </div>
    @endif

    {{-- registration body --}}
    <div class="row justify-content-center">
        {{-- this is the style of the div, to change overall design, delete the class="card" --}}
        <div class="card" style="height: 100% !important">
            {{-- this one is the card header --}}
            <div class="card-header"> <strong>VISITORS REGISTRATION</strong>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back</a>
                </div>

            </div>
            {{-- this will go to the Controller, check the web.php --}}
            <form action="{{ route('visitor.store') }}" method="POST" enctype="multipart/form-data">
                {{-- always add csrf in every form or even filling up data --}}
                @csrf
                {{-- the id used here are from the public/css/regis_item.css; if you can change or add css there. --}}
                <br>
                <div class="container  d-flex justify-content-center">
                    <div class="row" id="vis_regis">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                            <div class="col-xs-6 col-md-4">


                            <img src="/image/pic/default.png" alt="" id="profile_pic" style="height:100px; width: 100px" srcset="" class="mb-1 img-thumbnail">
                            <div class="form-group">
                                <input type="file" name="image" placeholder="Choose image" id="image">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                            </div>
                        </div>
                        <div class="row-g-2">
                            <div class="col-sm-6" id="vis_regis">
                            <div class="form-group float-left">
                                <label for="level">Person to visit:</label>
                                <input type="text" name="person_to_visit" id="" placeholder="Person to visit">
                            </div>
                            <div class="form-group float-left">
                                <label for="level">Destination:</label>
                                <input type="text" name="destination" id="" placeholder="Destination">
                            </div>
                            <div class="form-group float-left">
                                <label for="level">Purpose:</label>
                                <input type="text" name="purpose" id="" placeholder="Purpose">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="vis_regis">

                    <h5>Complete Name</h5>
                    <label>Last Name:</label>
                            <input type="text" placeholder="Lastname" name="last_name" id="regis_field" value="{{old('last_name')}}"><br>

                            <label>First Name:</label>
                            <input type="text" placeholder="Firstname" name="first_name" id="regis_field" value="{{old('first_name')}}"><br>

                            <label>Middle Name:</label>
                            <input type="text" placeholder="Middlename" name="middle_name" id="regis_field" value="{{old('middle_name')}}"><br>

                <hr>
                <h5>Complete Address</h5>

                <label>Floor No.</label>

                            <input type="text" placeholder="Floor No." name="floor_no" id="regis_field" value="{{old('floor_no')}}"><br>
                            <label>House/Room No.</label>
                            <input type="text" placeholder="House/Room No." name="house_no" id="regis_field" value="{{old('house_no')}}"><br>

                            <label>Street Name:</label>
                            <input type="text" placeholder="Street" name="street" id="regis_field" value="{{old('street')}}"><br>
                            <label>Barangay Name:</label>
                            <input type="text" placeholder="Barangay" name="barangay" id="regis_field" value="{{old('barangay')}}"><br>

                            <label>City:</label>
                            <input type="text" placeholder="City" name="city" id="regis_field"   value="{{old('city')}}"><br>
                              <hr>
                            <h5>Contact Info</h5>
                            <label>Phone/Cp No.</label>
                              <input type="text" placeholder="Phone Number" name="contact_no" id="regis_field"  value="{{old('contact_no')}}"><br>

                              <label>Email Address:</label>
                              <input type="text" placeholder="Email" name="email" id="regis_field" value="{{old('email')}}"><br>



                              <div class="container" id="regis_btns">
                              <div class="row justify-content-center card-footer"id="regis_btn">
                                  <button type="submit" name="btn-regis" class="btn btn-info" id="btn_regis_form" >REGISTER</button><br>
                              </div>
                            </div>


                         </div>
                         </div>

                     </form>
             </div>
                 </div>
                 </div>
         <script>
             $(document).ready(function(){
                 $("#image").change(function(){
                     var input = this;
                     var url = $(this).val();
                     var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                     if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                     {
                         var reader = new FileReader();

                         reader.onload = function (e) {
                         $('#profile_pic').attr('src', e.target.result);
                         }
                     reader.readAsDataURL(input.files[0]);
                     }
                     else
                     {
                         $('#profile_pic').attr('src', '/image/default.png');
                     }
                 });
             });
         </script>
         @endsection
