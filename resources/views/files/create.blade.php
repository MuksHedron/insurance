@extends('layouts.app')

@section('title')
Create Case
@endsection



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Create Case') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{route('files.store')}}" enctype="multipart/form-data" class="row">
                        @include('files.partials.form',['create' => true ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection