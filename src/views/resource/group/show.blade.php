@extends('sysguard::layouts.master')
@section('content-header')
    <h1>Group: {{ $group->name }}</h1>
    <a href="{{ route('group.index') }}">Back to index</a>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! BootstrapForm::horizontal(['model' => $group, 'update' => 'group.update']) !!}
                <div class="box-body">
                    @include('sysguard::resource.group.form')
                </div>
                {!! BootstrapForm::close() !!}
            </div>
        </div>
    </div>
@stop