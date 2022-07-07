@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Academic Management</h2>
        </div>

    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div style="max-width: 40rem;">
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('majors.create') }}">Create New Major</a> 
    </div>
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Full Name</th>
        <th>Short Name</th>
        <th width="280px">Action</th>
    </tr>
        @foreach ($major as $key => $majorItem)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $majorItem->full_name }}</td>
            <td>{{ $majorItem->short_name }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('majors.edit',$majorItem->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['majors.destroy', $majorItem->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>
</div>

{!! $major->render() !!}

@endsection
