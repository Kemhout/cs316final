    @extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Study Plan Name</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('study_plans.create_studys_plan') }}"> Create New Study Plan</a>
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
            <th width="280px">Action</th>
        </tr>
        @foreach ($list_study_plan as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <form action="{{ route('study_plans.edit_study_plan', $item->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>

                <form action="{{ route('study_plans.destroy_study_plan', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

        {{-- {!! $list_study_plan->links('pagination::bootstrap-4') !!}  --}}
        

    @endsection