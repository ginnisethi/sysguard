@extends('sysguard::layouts.master')
@section('content-header')
    <h1>User</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12 pull-right text-right"><strong>Total data:</strong> <span class="badge alert-info">{{ $data['items']->total() }}</span></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th class="col-md-5">Name</th>
                                <th class="col-md-5">E-mail</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = $data['items']->firstItem(); ?>
                        @foreach ($data['items'] as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td><a href="{{ route('user.show', $item->id) }}" title="">{{ $item->name }}</a></td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="{{ route('user.destroy', $item->id) }}" class="btn btn-danger btn-xs" title="Delete"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">{!! $data['items']->setPath(route('user.index'))->render() !!}</div>
    </div>
@stop