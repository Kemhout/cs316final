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
        <a class="btn btn-success" href="{{ route('assign.create') }}">Assign Study Plan</a> 
    </div>
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Study Plan</th>
        <th>Department</th>
        <th>Academic Year</th>
        <th width="280px">Action</th>
    </tr>
        @foreach ($findStudyPlan as $key => $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->department }}</td>
            <td>{{ $item->academic_year }}</td>
            <td>
                {{-- <a class="btn btn-primary" href="{{ route('assign.edit',$item->id) }}">Edit</a> --}}
                {!! Form::open(['method' => 'DELETE','route' => ['assign.destroy', $item->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>
</div>

<?php $m = 1; ?>

{{-- {!! $findStudyPlan->links('pagination::bootstrap-4') !!} --}}
@endsection
