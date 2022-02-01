@extends('layouts.app')

@section('title')
List of Client Gsts
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Client Gsts</h4>
    </div>
</div>

<form action="{{route('clientgsts.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('clientgsts.create') }}">Create</a>

    @if($clientgsts->isEmpty())
    <div class="alert alert-warning">
        The list of clientgsts is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($clientgsts as $clientgst)
                <tr>
                    <th scope="row">{{$clientgst->id}}</th>
                    <td>{{$clientgst->name}}</td>
                    <td>{{$clientgst->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('clientgsts.edit', $clientgst->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('clientgsts.destroy',$clientgst->id)  }}" data-id="{{$clientgst->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $clientgsts->links() }}


    </div>


    @endif
    @endsection