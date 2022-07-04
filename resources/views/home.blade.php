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
                    @can('role-list')
                        <?php $class_array = array("bg-primary","bg-danger","bg-success","bg-warning"); ?>
                        <div class="row">
                            @for($i = 0; $i<3; $i++)
                                <div class="card text-white {{ $class_array[$i] }} mb-3" style="max-width: 18rem;">
                                    <div class="card-header">{{ $arrMajorCount[$i] }} Student: </div>
                                    <div class="card-body">
                                    <h5 class="card-title"><h2>{{ $arrMajorCountStudent[$i] }}<i class="fa-solid fa-people-simple"></i></h2></h5>
                                    </div>
                                </div>
                                @if($i % 2 !== 1)
                                <div class="text-white bg-muted mb-3" style="max-width: 7rem;"></div>
                                @endif
                            @endfor
                        </div>
                    @endcan
                    @cannot('role-list')
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
                    @endcannot
 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
