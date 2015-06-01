@extends('sysguard::layouts.master')
@section('content-header')
    <h1>Group</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! BootstrapForm::openHorizontal(['model' => $group, 'store' => 'group.store']) !!}
                <div class="box-body">
                    @include('sysguard::resource.group.form')
                    {!! BootstrapForm::submit('Add'); !!}
                </div>
                {!! BootstrapForm::close() !!}
            </div>
        </div>
    </div>
@stop