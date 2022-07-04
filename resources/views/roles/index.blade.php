@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Check Course Audit</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
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
     <th>Name</th>
     <th width="280px">Require</th>
  </tr>
    {{-- <form action="{{ route('roles.calcucatekk') }}" method="POST"> --}}
    @csrf
    @for($i=1; $i<3; $i++)
        <tr>
            <th class="p-3 mb-2 bg-primary text-white" >Semester {{ $i }}</th>
        </tr>
        <?php $n=0; ?>
        @foreach ($studentCourse as $key => $course)
            @if($course->semester === $i)
                <tr>
                    <td>{{ ++$n }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->require }}</td>
                </tr>
            @endif
        @endforeach
    @endfor
    </form>
</table>

{!! $roles->render() !!}

@endsection