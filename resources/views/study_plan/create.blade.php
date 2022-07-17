@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Study Plan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('study_plans.edit_study_plan', $id) }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('study_plans.store') }}" method="POST">
    	@csrf
        <div class="row">
            {{-- {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Course:</strong>
                        <select data-live-search="true" class="form-control selectpicker" name="course">
                        @foreach($course as $item)
                            <option value="{{ $item }}" selected>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Semester:</strong>
                        <select name="semester" class="form-control custom-select">
                        @foreach($semester as $item)
                            <option value="{{ $item }}" selected >{{ $item }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Year Level:</strong>
                        <select name="year_level" class="form-control custom-select">
                        @foreach($year_level as $item)
                            <option value="{{ $item }}" selected >{{ $item }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <div class="form-group">
                <input name="studys_plan_group" type="hidden" value={{$id}}>
            </div>
            <input type="hidden" name="hidden_framework" id="hidden_framework" />
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    
    {!! Form::close() !!}
@endsection

