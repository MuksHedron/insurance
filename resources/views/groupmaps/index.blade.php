@extends('layouts.app')

@section('title')
List of Group Maps
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Group Maps</h4>
    </div>
</div>

<form action="{{route('groupmaps.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('groupmaps.create') }}">Create</a>

    @if($groupmaps->isEmpty())
    <div class="alert alert-warning">
        The list of groupmaps is empty
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
                @foreach($groupmaps as $groupmap)
                <tr>
                    <th scope="row">{{$groupmap->id}}</th>
                    <td>{{$groupmap->name}}</td>
                    <td>{{$groupmap->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('groupmaps.edit', $groupmap->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('groupmaps.destroy',$groupmap->id)  }}" data-id="{{$groupmap->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $groupmaps->links() }}


    </div>


    @endif
    @endsection