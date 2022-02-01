@extends('layouts.app')

@section('title')
List of Cities
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Cities</h4>
    </div>
</div>

<form action="{{route('cities.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('cities.create') }}">Create</a>

    @if($cities->isEmpty())
    <div class="alert alert-warning">
        The list of cities is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                <tr>
                    <th scope="row">{{$city->id}}</th>
                    <td>{{$city->name}}</td>
                    <td>{{$city->states->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('cities.edit', $city->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('cities.destroy',$city->id)  }}" data-id="{{$city->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $cities->links() }}


    </div>


    @endif
    @endsection