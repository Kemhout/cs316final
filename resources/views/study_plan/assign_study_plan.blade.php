@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Assign Study Plan</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('study_plans.list_study_plan_index') }}"> Back</a>
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


{!! Form::open(array('route' => ['study_plans.assign_store_study_plan', $id],'method'=>'POST')) !!}
@csrf
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Department:</strong>
                <select name="department" class="form-control custom-select">
                @foreach($major as $item)
                    <option value="{{ $item }}" selected >{{ $item }}</option>
                @endforeach
                </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Academic Year:</strong>
                <select name="academic_year" class="form-control custom-select">
                @foreach($academic_year as $item)
                    <option value="{{ $item }}" selected >{{ $item }}</option>
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