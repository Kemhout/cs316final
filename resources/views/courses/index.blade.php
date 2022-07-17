@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Course</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('courses.create') }}"> Create New Course</a>
            </div>
            <form method="GET" action="{{ url('my-search') }}">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ old('search') }}">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info">Search</button>
                    </div>
                </div>
            </form>
        </div>

    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Search --}}

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Code Name</th>
            <th>Type Of Course</th>
            <th>Credit</th>
            <th width="280px">Action</th>
        </tr>
	
            @foreach ($courses as $course)

	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $course->name }}</td>
	        <td>{{ $course->code_name }}</td>
            <td>{{ $course->type_of_course }}</td>
            <td>{{ $course->credit }}</td>
	        <td>
                <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('courses.edit',$course->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
	        </td>
	    </tr>
	    @endforeach
        
        
    </table>

    {{-- live wire --}}
    {{-- @foreach ($major as $item)
        <div>
            <input wire:model="transmissions.{{ $item }}" type="checkbox" value="{{ $item }}" />
            <label>{{ $item }}</label>
        </div>
    @endforeach --}}

    {!! $courses->links('pagination::bootstrap-4') !!}

@endsection