@extends('sysguard::layouts.master')
@section('content-header')
    <h1>User</h1>
    <a href="{{ route('user.index') }}">Back to index</a>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! BootstrapForm::horizontal(['model' => $user, 'store' => 'user.store']) !!}
                <div class="box-body">
                    @include('sysguard::resource.user.form')
                    {!! BootstrapForm::submit('Add'); !!}
                </div>
                {!! BootstrapForm::close() !!}
            </div>
        </div>
    </div>
@stop