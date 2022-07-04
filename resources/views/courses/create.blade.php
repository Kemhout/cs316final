@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Course</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
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


    <form action="{{ route('courses.store') }}" method="POST">
    	@csrf
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Code Name</strong>
		            <textarea class="form-control" style="height:150px" name="code_name" placeholder="Code Name"></textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Professor's Name</strong>
		            <textarea class="form-control" name="professor" placeholder="Professor"></textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type of Course:</strong>
                        <select name="type_of_course" class="form-control custom-select">
                        @foreach($typeOfCourse as $item)
                            <option value="{{ $item }}" selected >{{ $item }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                        <select name="department" class="form-control custom-select">
                        @foreach($chooseMajor as $item)
                            <option value="{{ $item }}" selected >{{ $item }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Credit</strong>
                        <select name="credit" class="form-control custom-select">
                        @foreach($credit as $item)
                            <option value="{{ $item }}" selected >{{ $item }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">         
                    <label><strong>Select Category :</strong></label><br/>
                    <select class="selectpicker" multiple data-live-search="true" name="cat[]">
                        @foreach($chooseMajor as $item)
                            <option value="{{ $item }}" selected >{{ $item }}</option>
                        @endforeach
                    </select>    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

{{-- <!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script> --}}
  

@endsection