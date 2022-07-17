@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New Course</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($courses, ['method' => 'PATCH','route' => ['courses.update', $courses->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Code name</strong>
            {!! Form::text('code_name', null, array('placeholder' => 'Code Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type of Course:</strong>
                <select name="type_of_course" class="form-control custom-select">
                    @foreach ($chooseTypeOfCourse as $key => $value)
                        <option value="{{ $value }}" {{ ( $value == $selectedID) ? 'selected' : '' }}> 
                            {{ $value }} 
                        </option>
                    @endforeach  
                </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Credit: </strong>
                <select name="credit" class="form-control custom-select">
                    @foreach ($credit as $key => $value)
                        <option value="{{ $value }}" {{ ( $value == $selectedCredit) ? 'selected' : '' }}> 
                            {{ $value }} 
                        </option>
                    @endforeach  
                </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
@endsection

