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

<?php $m = 0; ?>

{{-- Academic Year --}}

<div style="max-width: 40rem;">
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('academic_years.create') }}">Create New Academic Year</a> 
    </div>
    <p>
        {!! Form::open(['method' => 'DELETE','route' => ['academic_years.destroy', 2],'style'=>'display:inline']) !!}
        {!! Form::submit('Delete Academic Year', ['class' => 'btn btn-danger']) !!}
    </p>

    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Year</th>
    </tr>
        @foreach ($ac as $key => $acItem)
        <?php ++$m; ?>
        <tr>
            <td>{{ $m }}</td>
            <div class="form-group" type="hidden">
                <input name="id" type="hidden" value="{{$m}}">
            </div>
            <td>{{ $acItem->year }}</td>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
</div>
<?php $m=0; ?>
{{-- Semester --}}
<div style="max-width: 40rem;">
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('semesters.create') }}">Create New Semester</a> 
    </div>
    <p>
        {!! Form::open(['method' => 'DELETE','route' => ['semesters.destroy', 2],'style'=>'display:inline']) !!}
        {!! Form::submit('Delete Semester', ['class' => 'btn btn-danger']) !!}
    </p>

    <table class="table table-bordered">
    <tr>
        <th>Semester</th>
    </tr>
        @foreach ($semesters as $key => $semesterItem)
        <?php $m++; ?>
        <tr>
            <td>{{ $semesterItem->id }}</td>
            <div class="form-group" type="hidden">
                <input name="id" type="hidden" value="{{$m}}">
            </div>
            {!! Form::close() !!}
        </tr>
        @endforeach
    </table>
</div>

<?php $m = 0; ?>

{!! $major->links('pagination::bootstrap-4') !!}
{!! $semesters->links('pagination::bootstrap-4') !!}
@endsection
