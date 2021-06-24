@extends('layouts.app')
@section('content')

<div class="container" >
<div class="card" >
        <div class="card-header bg-light">

        <div class="float-right">
            <a class="btn btn-sm btn-primary" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to Home</a>
        </div>
        <h3>Scan RFID</h3>
        </div>


    <div class="container bg-light p-4 " >
        <div class="row text-center">
            <div class="col-md-6 border-right border-secondary " style="height: 500px; padding-right: 20px">
        <form action="trace" method="POST">
            @csrf
                    <div class="col">
                        <input class="text form-control form-control-lg border-success" placeholder="Input your unique code" name="code" autocomplete="off" autofocus>
                    </div>

                <div class="in-out py-3">

                    @if (empty($list))
                    @else
                    <label class="font-weight-bold text-center  {{$list->status == 'IN' ? 'text-primary':'text-danger'}}" style="font-size: 500% !important">{{$list->status}}</label> <br>
                    <h1>{{$list->last_name}}, {{$list->first_name}} {{$list->middle_name}}</h1> <br>

                        {{-- this is Carbon; a php library separates date and time. For the time and date format, check the Carbon documentation --}}
                        <h4> {{Carbon\Carbon::parse($list->time)->format('h:i:s A')}} </h4>
                        <h4>{{Carbon\Carbon::parse($list->date)->format('d M Y')}}</h4>


                        @endif
                    </div>
            </div>
        <div class="col-md-6 ">
            <div class="col">
                <button type="submit" class="btn btn-block btn-success btn-lg"  id="s_search">Search</button>
            </div>
        </form>

        {{-- appear error message if any --}}
            @if ($message = Session::get('error'))
            <div class="alert alert-danger mt-4">
                <p>{{ $message }}</p>
                </div>
            @endif
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

            {{-- conditional statements just to remove the constant error of missing variable; when the variable returns null it will view as empty. --}}
            @if (!empty($list))
                <img src="/{{$list->path}}" alt="" id="profile_pic" style="height:450px; width: 450px" srcset="" class="img-fluid" alt="responsive image">
            @endif
        </div>
</div>

</div>
@endsection
