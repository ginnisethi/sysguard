@extends('sysguard::layouts.master')
@section('content-header')
    <h1>Menu</h1>
    <a href="{{ route('menu.index') }}">Back to index</a>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! BootstrapForm::openHorizontal(['model' => $menu, 'store' => 'menu.store']) !!}
                <div class="box-body">
                    @include('sysguard::resource.menu.form')
                    {!! BootstrapForm::submit('Add'); !!}
                </div>
                {!! BootstrapForm::close() !!}
            </div>
        </div>
    </div>
@stop