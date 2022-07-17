@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $studyPlanName }} Study Plan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('study_plans.create', $id) }}"> Add Course</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('study_plans.list_study_plan_index') }}">Back</a>
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
            <th>Course</th>
            <th>Semester</th>
            <th>Credit</th>
            <th>Year Level</th>
            {{-- <th width="280px">Action</th> --}}
        </tr>
	    @foreach ($sth as $item)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $item->code_name }}</td>
            <td>{{ $item->semester }}</td>
            <td>{{ $item->credit }}</td>
            <td>{{ $item->year_level }}</td>
	        {{-- <td>
                <form action="{{ route('study_plans.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
	        </td> --}}
	    </tr>
	    @endforeach
    </table>
    {{-- {!! $list_course->links('pagination::bootstrap-4') !!}  --}}


@endsection