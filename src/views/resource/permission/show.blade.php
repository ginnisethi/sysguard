@extends('sysguard::layouts.master')
@section('content-header')
    <h1>Permission: {{ $permission->name }}</h1>
    <a href="{{ route('permission.index') }}">Back to index</a>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! BootstrapForm::horizontal(['model' => $permission, 'update' => 'permission.update']) !!}
                <div class="box-body">
                    @include('sysguard::resource.permission.form')
                </div>
                {!! BootstrapForm::close() !!}
            </div>
        </div>
    </div>
@stop