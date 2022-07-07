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

{!! Form::model($roles, ['method' => 'PATCH','route' => ['roles.update', 2]]) !!}
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
@if ($fail_course !== NULL)
    @foreach($fail_course as $item)
        <div class="alert alert-danger">
            <p>{{ $item->name }}: is Failed.</p>
        </div>
    @endforeach
@endif
<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th>Type Of Course</th>
     <th>Credit</th>
     <th width="280px">Letter Grade</th>
  </tr>
    {{-- <form action="{{ route('roles.calcucatekk') }}" method="POST"> --}}
    @csrf
    <?php $allCourseGrade=0; $countAllCourse=0; ?>
    @for($i=1; $i<9; $i++)
        <?php $totalCredit=0; $averageGrade = 0;?>
        <tr>
            <th class="p-3 mb-2 bg-primary text-white" >Semester {{ $i }}</th>
        </tr>
        <?php $n=0; ?>
        @foreach ($studentCourse as $key => $course) 
            @if($course->semester == $i)
            <?php ++$countAllCourse; ?>
                <tr>
                    <?php $n++; ?>
                    <td>{{ $n }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->type_of_course }}</td>
                    <td>{{ $course->credit }}</td>
                    
                    <div class="form-group" type="hidden">
                        <input name="kk[]" type="hidden" value="{{$course->id}}">
                    </div>
                 
                    <td>
                        <div class="form-group"> 
                            <select name="grade[]" id="grade" class="form-control custom-select">
                                @foreach($list_grade as $item)
                                <option value="{{ $item['numberGrade'] }}" {{ ( $item['numberGrade'] == $course->grade) ? 'selected' : '' }}> 
                                    {{ $item['letterGrade'] }} 
                                </option>
                                @endforeach
                                <?php $averageGrade += $course->grade; $allCourseGrade+= $course->grade;?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php $totalCredit+=$course->credit; ?>
            @endif
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td>Credit: </td>
            <td>{{ $totalCredit }}</td>
            <?php $averageGrade=number_format((float)$averageGrade/$n, 2, '.', '');?>
            <td>{{ $averageGrade }}</td>
        </tr>
    @endfor
    </form>
</table>
<div>  
    Cumulative GPA: {{ number_format((float)$allCourseGrade/$countAllCourse, 2, '.', ''); }}
</div>
<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#demoModal">Check Course</button>
<button type="submit" class="btn btn-primary">Check Grade</button>

{!! $roles->render() !!}
	<!-- Modal Example Start-->
    <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Course Audit Check</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    @foreach($list_type_of_course as $key => $item) 
                        <p>{{ $item->type_of_course }}: {{ $list_type_of_course_count[$key] }}</p>
                        <p></p>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
<!-- Modal Example End-->
{!! Form::close() !!}
@endsection