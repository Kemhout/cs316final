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


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
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
    @for($i=1; $i<3; $i++)
        <?php $totalCredit=0; ?>
        <tr>
            <th class="p-3 mb-2 bg-primary text-white" >Semester {{ $i }}</th>
        </tr>
        <?php $n=0; ?>
        @foreach ($studentCourse as $key => $course)
            @if($course->semester === $i)
                <tr>
                    <td>{{ ++$n }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->type_of_course }}</td>
                    <td>{{ $course->credit }}</td>
                    <td>
                        <div class="form-group">
                            <select name="major" class="form-control custom-select">
                                @foreach($list_grade as $item)
                                <option value="{{ $item['letterGrade'] }}" {{ ( $item['letterGrade'] == $course->name) ? 'selected' : '' }}> 
                                    {{ $item['letterGrade'] }} 
                                </option>
                                @endforeach
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
            <td>Total Credit: </td>
            <td>{{ $totalCredit }}</td>
            <td></td>
        </tr>
    @endfor
    </form>
</table>
<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#demoModal" wire:click="boot('rad')">Click Here</button>
<a wire:click="boot('rad')">Set MY Tile</a>
@livewire('post')
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
                    @livewire('post')
                    @livewireScripts
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Example End-->
@endsection