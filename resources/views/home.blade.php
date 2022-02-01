@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}


                    <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Cases</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between"><span style="font-size:32px">{{$files->count()}}</span>
                                        <a class="small text-white stretched-link" href="{{route('files.index')}}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                           




                        </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>

                       






                        <div class="card-body">


                            @if($files->isEmpty())
                            <div class="alert alert-warning">
                                The list of files is empty
                            </div>
                            @else
                            <div class="table-responsive iq-card-body">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>

                                            <th scope="col">#Id</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Policy No</th> 
                                            <th scope="col">User Name</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">City</th>
                                            <th scope="col">State</th>

                                            <th scope="col">File Status</th>
                                            @if($role!="CRM")
                                            <th scope="col">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($files as $file)
                                        <tr>

                                            <td scope="row">{{$file->id}}</td>
                                            <td>{{$file->sublobs->name ?? ''}}</td>
                                            <td>{{$file->policyno ?? ''}}</td> 
                                            <td>{{$file->name ?? ''}}</td>
                                            <td>{{$file->locations->name ?? ''}}</td>
                                            <td>{{$file->cities->name ?? ''}}</td>
                                            <td>{{$file->states->name ?? ''}}</td>
                                            <td>{{$file->lookups->tag ?? ''}}</td>
                                            @if($role!="CRM")
                                            <td>
                                                <!-- <a class="btn btn-sm btn-primary" href="{{ route('files.edit', $file->id) }}" role="button">Edit File</a> -->

                                                @if(($role=="CVO" || $role=="TVO" || $role=="Vendor"))
                                                <a class="btn btn-sm btn-primary" href="{{ route('questionslob',['id' => $file->id] ) }}" role="button">Go To</a>
                                                @endif


                                                @if($role=="Processor" || $role=="QC")
                                                <a class="btn btn-sm btn-primary" href="{{ route('casetrackers.editcasetrackers',['id' => $file->id]) }}" role="button">{{$file->lookups->tag ?? ''}}</a>

                                                <a class="btn btn-sm btn-primary" href="{{ route('casetrackers.updatecasetrackersreturn',['id' => $file->id]) }}" role="button">Return</a>

                                                @endif

                                                @if(($role=="Assignor" || $role=="Administrator") && ($file->filestatusid==47  || $file->filestatusid==62 || $file->filestatusid==65 ))
                                                <a class="btn btn-sm btn-primary" href="{{ route('files.assignfile',['id' => $file->id]) }}" role="button">Assign</a>
                                                @endif



                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                                @if ($files->links()->paginator->hasPages())
                                <div class="d-felx justify-content-center">
                                    {{ $files->links() }}
                                </div>
                                @endif
                            </div>

                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection