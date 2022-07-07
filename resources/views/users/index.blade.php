@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Student Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Last Name</th>
   <th>First Name</th>
   <th>Email</th>
   <th>Major</th>
   <th>Academic Year</th>
   <th>Year Level</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  @foreach($user->getRoleNames() as $userRole)
    @if($userRole=="Student")
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->first_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->major }}</td>
        <td>{{ $user->academic_year }}</td>
        <td>{{ $user->year_level }}</td>
        <td>
          {{$userRole}}
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
      </tr>
    @endif
  @endforeach
 @endforeach
</table>


{!! $data->links('pagination::bootstrap-4') !!}

@endsection