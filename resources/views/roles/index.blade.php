@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Check Course Audit</h2>
        </div>
    </div>
</div>

{!! Form::model($roles, ['method' => 'PATCH','route' => ['roles.update', 1]]) !!}
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
    @for($i=1; $i<=$semester; $i++)
        <?php $totalCredit=0; $averageGrade = 0;?>
        <tr>
            <th class="p-3 mb-2 bg-primary text-white" >Semester {{ $i }}</th>
        </tr>
        <?php $n=0; $p=0;?>
        @foreach ($studentCourse as $key => $course) 
            @if($course->semester == $i)
            
                <tr>
                    <?php $n++; ?>
                    <td>{{ $n }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->type_of_course }}</td>
                    <td>{{ $course->credit }}</td>
                    
                    <div class="form-group" type="hidden">
                        <input name="course_id[]" type="hidden" value="{{$course->id}}">
                    </div>
                 
                    <td>
                        @if($i <= $inputGrade)
                            <div class="form-group"> 
                                <select name="grade[]" id="grade" class="form-control custom-select">
                                    @foreach($list_grade as $item)
                                    <option value="{{ $item['numberGrade'] }}" {{ ( $item['numberGrade'] == $course->grade) ? 'selected' : '' }}> 
                                        {{ $item['letterGrade'] }} 
                                    </option>
                                    @endforeach
                                    <?php $totalCredit+=$course->credit; ?>
                                    <?php ++$countAllCourse; ?>
                                    <?php $averageGrade += $course->grade; $allCourseGrade+= $course->grade;?>
                                    <?php $p++; ?>
                                </select>
                            </div>
                        @else
                        <div class="form-group" type="hidden">
                            <input name="studyOrNot[]" type="hidden" value='Yes'>
                        </div>
                        @endif
                        
                    </td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td>Credit: </td>
            <td>{{ $totalCredit }}</td>
            <?php if($p!=0) {
                $averageGrade=number_format((float)$averageGrade/$p, 2, '.', '');
            }
                ?>
            <td>{{ $averageGrade }}</td>
        </tr>
    @endfor
   
</table>
<div>  
    <?php if($countAllCourse != 0) {
        $answer = number_format((float)$allCourseGrade/$countAllCourse, 2, '.', ''); 
        }
        else {
            $answer = 0;
        }   
    ?>
    Cumulative GPA: {{ $answer }}
</div>
<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#demoModal">Check Course</button>
<button type="submit" class="btn btn-primary">Check Grade</button>
</form>

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
                        <p>{{ $item }}: {{ $list_type_of_course_count[$key] }}</p>
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