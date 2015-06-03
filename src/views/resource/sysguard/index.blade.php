@extends('sysguard::layouts.master')
@section('content-header')
    <h1>Sysguard</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <ul>
                        <li><a href="{{ route('user.index') }}">User</a></li>
                        <li><a href="{{ route('group.index') }}">Group</a></li>
                        <li><a href="{{ route('menu.index') }}">Menu</a></li>
                        <li><a href="{{ route('permission.index') }}">Permission</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop