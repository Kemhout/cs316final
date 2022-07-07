@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($user->getRoleNames()[0] == "Admin")
                        <?php $class_array = array("bg-primary","bg-danger","bg-success","bg-warning"); ?>
                        <div class="row">
                            @foreach($arrMajorCount as $key => $item)
                                <div class="card text-white {{ $class_array[$key] }} mb-3" style="max-width: 18rem;">
                                    <div class="card-header">{{ $item }} Student: </div>
                                    <div class="card-body">
                                    <h5 class="card-title"><h2>{{ $arrMajorCountStudent[$key] }}<i class="fa-solid fa-people-simple"></i></h2></h5>
                                    </div>
                                </div>
                                @if($key % 2 !== 0)
                                <div class="text-white bg-muted mb-3" style="max-width: 7rem;"></div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Show User</h2>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Major:</strong>
                                    {{ $user->major }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Academic Year:</strong>
                                    {{ $user->ac }}
                                </div>
                            </div>
                        </div>                  
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
