@extends('layouts.master')

@section('content-header')
    @include('sysguard::partials.content-header', ['title' => $title])
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootstrapForm::openHorizontal(['model' => $example, 'store' => 'example.store']) !!}
            <div class="box-body">
                @include('sysguard::pages.example.form-fields')
            </div>
            {!! BootstrapForm::close() !!}
        </div>
    </div>
</div>

@stop

@section('custom-head')

@stop

@section('custom-foot')

@stop