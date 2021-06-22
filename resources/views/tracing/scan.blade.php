@extends('layouts.app')
@section('content')

<div class="container" >
    <div id="s_box">
                <form action="trace" method="POST">
                    @csrf
                        
                    <div class="container bg-light p-4 " >
                        <div class="row ">
                            <div class="col-md-6 p-3 border-right border-primary"" style="height: 500px">
                                    <div class="row">
                                        <input class="text mx-3 form-control form-control-lg border-success" placeholder="Input your unique code" name="code" autocomplete="off" autofocus id="s_field">
                                        </div> 
                                     <div class="row mt-4">
                                        <div class="col-5 mx-3">
                                            <button type="submit" class="btn btn-danger "  id="s_search">Search</button>
            
                                        </div>
                                        <div class="col-6">
                                            <a class="btn btn-primary" href="/home" id="s_bh">Back to Home</a>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12 p-4"">
                                        @if (empty($list))
                                    @else
                                        <h1 class="font-weight-bold">{{$list->status}}</h1> <br>
                                        <h3>{{$list->last_name}}, {{$list->first_name}} {{$list->middle_name}}</h3> <br>

                                        {{-- this is Carbon; a php library separates date and time. For the time and date format, check the Carbon documentation --}}
                                        <h3> {{Carbon\Carbon::parse($list->time)->format('h:i:s A')}} </h3>
                                        <h3>{{Carbon\Carbon::parse($list->date)->format('d M Y')}}</h3>
                                    

                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6 ">
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
                                    
                                    {{-- conditional statements just to remove the constant error of missing variable; when the variable returns null it will view as empty. --}}
                                    @if (!empty($list))
                                        <img src="/{{$list->path}}" alt="" id="profile_pic" style="height:450px; width: 450px" srcset="" class="img-fluid" alt="responsive image">
                                    @endif
                                </div>

                    
                            </form>
            
        
        
        
                        </div>
                       
        

</div>
@endsection
