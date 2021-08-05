@extends('layouts.app')

@section('content')
<div class="container" >


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
        <div class="card" style="height: 100% !important">
            {{-- this one is the card header --}}
            <div class="card-header"> <strong>REGISTRATION</strong>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back</a>
                </div>

            </div>
            {{-- this will go to the Controller, check the web.php --}}
            <form action="{{ route('persons.store') }}" method="POST" enctype="multipart/form-data">
                {{-- always add csrf in every form or even filling up data --}}
                @csrf
                {{-- the id used here are from the public/css/regis_item.css; if you can change or add css there. --}}
                <br>
                <div class="container  d-flex justify-content-center">

                    <div class="row">
                        <div class="col-md-6">
                            <img src="/image/pic/default.png" alt="" id="profile_pic" style="height:70px; width: 70px" srcset="" class="mb-1 img-thumbnail">
                            <div class="form-group">
                                <input type="file" name="image" placeholder="Choose image" id="image">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" id="regis_con_name">
                            <div class="form-group float-left">
                                <label for="level">Category:</label>
                                <select id="level" name="level">
                                    <option value="tenant" selected>Tenant</option>
                                    <option value="employee">Employee</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="container" id="regis_con">
                    <h5 id="regis_head">Complete Name</h5>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Lastname" name="last_name" id="regis_field" value="{{old('last_name')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Firstname" name="first_name" id="regis_field" value="{{old('first_name')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Middlename" name="middle_name" id="regis_field" value="{{old('middle_name')}}"><br>
                        </div>
                    </div>
                </div>
                <div class="container" id="regis_con">
                    <h5 id="regis_head">Full Address</h5>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Floor No." name="floor_no" id="regis_field" value="{{old('floor_no')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="House/Room No." name="house_no" id="regis_field" value="{{old('house_no')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Street" name="street" id="regis_field" value="{{old('street')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Barangay" name="barangay" id="regis_field" value="{{old('barangay')}}"><br>
                        </div>
                    </div> <br>
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col-4">
                            <input type="text" placeholder="City" name="city" id="regis_field" value="{{old('city')}}"><br>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="container" id="regis_con">
                    <h5 id="regis_head">Contact Number</h5>
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Phone Number" name="contact_no" id="regis_field" value="{{old('contact_no')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Email" name="email" id="regis_field" value="{{old('email')}}"><br>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="RFID" name="rf_id" id="regis_field" value="{{old('rf_id')}}"><br>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="container" id="regis_btns">
                <div class="row justify-content-center card-footer"id="regis_btn">
                    <button type="submit" name="btn-regis" class="btn btn-success" id="btn_regis_form" >REGISTER</button><br>
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
