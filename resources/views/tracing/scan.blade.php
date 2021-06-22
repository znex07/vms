@extends('layouts.app')
@section('content')

<div class="container" >
    <div id="s_box">
                <form action="trace" method="POST">
                    @csrf
                        
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="row">
                                        <input class="text" placeholder="Input your unique code" name="code" autocomplete="off" autofocus id="s_field">
                                        </div> 
                                     <div class="row mt-4">
                                        <div class="col-5">
                                            <button type="submit" class="btn btn-danger "  id="s_search">Search</button>
            
                                        </div>
                                        <div class="col-6">
                                            <a class="btn btn-primary" href="/home" id="s_bh">Back to Home</a>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                         {{-- appear error message if any --}}
                                    @if ($message = Session::get('error'))
                                    <div class="alert alert-danger">
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
                                    
                                    <br><br>
                                    {{-- conditional statements just to remove the constant error of missing variable; when the variable returns null it will view as empty. --}}
                                    @if (empty($list))
                                    @else

                                    
                                    <img src="/{{$list->path}}" alt="" id="profile_pic" style="height:450px; width: 450px" srcset="" class="img-fluid" alt="responsive image">

                                    <h1><strong>{{$list->status}}</strong></h1> <br>
                                    <h3>{{$list->last_name}}, {{$list->first_name}} {{$list->middle_name}}</h3> <br>

                                    {{-- this is Carbon; a php library separates date and time. For the time and date format, check the Carbon documentation --}}
                                    {{Carbon\Carbon::parse($list->time)->format('h:i:s A')}} <br>
                                    {{Carbon\Carbon::parse($list->date)->format('d M Y')}}
                                    @endif
                                </div>

                    
                            </form>
            
        
        
        
                        </div>
                       
        

</div>
@endsection
