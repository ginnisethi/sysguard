@extends('sysguard::layouts.master')
@section('content-header')
    <h1>Menus</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('menu.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="col-md-10 pull-right text-right"><strong>Total data:</strong> <span class="badge alert-info">{{ $menus->total() }}</span></div>
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
                                <th class="col-md-3">Name</th>
                                <th class="col-md-3">Parent</th>
                                <th class="col-md-4">URL</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = $menus->firstItem(); ?>
                        @foreach ($menus as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td><a href="{{ route('menu.show', $item->id) }}" title="">{{ $item->name }}</a></td>
                                <td>
                                    @if ($item->parent != null)
                                        {{ $item->parent->name }}
                                    @endif
                                </td>
                                <td>{{ $item->url }}</td>
                                <td>
                                    <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="{{ route('menu.destroy', $item->id) }}" class="btn btn-danger btn-xs" title="Delete"><span class="glyphicon glyphicon-remove"></span></a>
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
        <div class="col-md-12 text-right">{!! $menus->setPath(route('menu.index'))->render() !!}</div>
    </div>
@stop