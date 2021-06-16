@extends('layouts.app')
@section('content')

<div class="container" id="s_container">
    <div id="s_box">
        <table class="s_table">
            <tr>
                <form action="trace" method="POST">
                    @csrf
                    <td>
                        <input class="text" placeholder="Input your unique code" name="code" autocomplete="off" autofocus id="s_field">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-danger" id="s_search">Search</button>
                    </td>
                </form>
                <td>
                    <button class="btn btn-primary" onclick="window.location='{{ route("home") }}'" id="s_bh">Back to Home</button>
                </td>
            </tr>
        </table>
    </div>
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
    <img src="/{{$list->path}}" alt="" id="profile_pic" style="height:250px; width: 250px" srcset="" class="mb-1 img-thumbnail">

    <h1><strong>{{$list->status}}</strong></h1> <br>
    <h3>{{$list->last_name}}, {{$list->first_name}} {{$list->middle_name}}</h3> <br>

    {{-- this is Carbon; a php library separates date and time. For the time and date format, check the Carbon documentation --}}
    {{Carbon\Carbon::parse($list->time)->format('h:i:s A')}} <br>
    {{Carbon\Carbon::parse($list->date)->format('d M Y')}}
    @endif

</div>
@endsection
