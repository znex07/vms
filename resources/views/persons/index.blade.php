@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('persons.create') }}"> Register new Entry</a>
                <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>
            </div>
        </div>
    </div>
   <br>

   {{-- notify success in the interactions --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>picture</th>
            <th>Card No</th>
            <th>Complete Name</th>
            <th>Contact Number</th>
            <th>Position</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($persons as $person)
        <tr>
            <td>{{ ++$i }}</td>
            <td>
                <img src="{{$person->path}}" alt="" id="profile_pic" style="height:50px; width: 50px" srcset="" class="mb-1 img-thumbnail">
            </td>
            <td>{{ $person->rf_id }}</td>
            <td>{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</td>
            <td>{{ $person->contact_no }}</td>
            <td>{{ $person->level }}</td>
            <td>
                <form action="{{ route('persons.destroy',$person->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('persons.show',$person->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('persons.edit',$person->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $persons->links() !!}
</div>
@endsection
