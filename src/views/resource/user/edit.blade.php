@extends('sysguard::layouts.master')
@section('content-header')
    <h1>User Edit</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! BootstrapForm::openHorizontal(['model' => $user, 'update' => 'user.update']) !!}
                <div class="box-body">
                    @include('sysguard::resource.user.form')
                    {!! BootstrapForm::submit('Update'); !!}
                </div>
                {!! BootstrapForm::close() !!}
            </div>
        </div>
    </div>
@stop