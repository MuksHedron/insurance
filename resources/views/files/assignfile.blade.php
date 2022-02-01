@extends('layouts.app')

@section('title')
Assign File
@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Assign File') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>Sub LOB</td>
                                <td>{{$file->sublobs->name }}</td>
                            </tr>
                            <tr>
                                <td>Policy No</td>
                                <td>{{$file->policyno }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$file->name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$file->address }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>{{$file->locations->name }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$file->cities->name }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{$file->states->name }}</td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>{{$file->pincode }}</td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{$file->mobile1 }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{$file->mobile2 }}</td>
                            </tr>
                            <tr>
                                <td>Mail ID</td>
                                <td>{{$file->email }}</td>
                            </tr>
                      
                            <tr>
                                <td>Client</td>
                                <td>{{$file->clients->name ?? ''}}</td>
                            </tr>

                            <tr>

                            </tr>

                        </tbody>
                    </table>


                    <form method="POST" action="{{route('files.updateassignfile')}}" enctype="multipart/form-data" class="row">
                        @csrf
                        <input name="getFileId" type="hidden" class="form-control" id="fileid" value="{{$file->id}}">
                        <div>
                            <select id='filteruser' name="filteruser" class="form-control" style="width: 200px">
                                @isset($users)
                                @if($users != null)
                                <option value="">Select Users</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->users->id }}" @isset($users) @endisset>{{ $user->users->name  }} </option>
                                @endforeach
                                @endif
                                @endisset
                            </select>
                        </div>

                        <div class="form-group row mb-0" style="margin-top: 30px;">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection