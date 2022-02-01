@extends('layouts.app')

@section('title')
Edit Case
@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Edit Case') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('files.update', $file->id) }}" enctype="multipart/form-data" class="row">
                        @method('PATCH')
                        @include('files.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection