@extends('layouts.app')

@section('content')
<div class="container">


   {{-- notify success in the interactions --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
      <div class="col">

        <div class="card">
            <div class="card-header">
                <a class="btn btn-sm btn-dark" id="theme"> Night Theme</a>

                <div class="float-right">
                    <a class="btn btn-sm btn-success" href="{{ route('persons.create') }}"> Register new Entry</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-dark dt-responsive display nowrap" cellspacing="0" id="persons_table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>picture</th>
                    <th>Card No</th>
                    <th>Complete Name</th>
                    <th>Contact Number</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($persons as $person)
                <tr>
                    <td>{{$i++}}</td>
                    <td>
                        <img src="{{$person->path}}" alt="" id="profile_pic" style="height:50px; width: 50px" srcset="" class="mb-1 img-thumbnail">
                    </td>
                    <td>{{ $person->rf_id }}</td>
                    <td>{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</td>
                    <td>{{ $person->contact_no }}</td>
                    <td>{{ $person->level }}</td>
                    <td>
                        <form action="{{ route('persons.destroy',$person->id) }}" method="POST">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-sm btn-info" href="{{ route('persons.show',$person->id) }}">Show</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('persons.edit',$person->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
    </div>


</div>

<script>
    $(document).ready(function() {
        $('#theme').click(function(){
            if($(this).text() == 'Night Theme'){
                $('#persons_table').addClass('table-dark');
                $('#persons_table').removeClass('table-light');
                $(this).text('Day Theme');
            }else{
                $('#persons_table').addClass('table-light');
                $('#persons_table').removeClass('table-dark');
                $(this).text('Night Theme');
            }
        });
        $('#persons_table').DataTable({
            responsive: true,
            order: [],
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 5 }
            ],
        });
    });
</script>
@endsection
