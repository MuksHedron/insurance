@extends('layouts.app')

@section('title')
Edit Group Map
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Group Map</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('groupmaps.update', $groupmap->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('groupmaps.partials.form')
    </form>
</div>

@endsection