@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Hak Akses</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('permission/manage') }}" class="btn btn-primary" title="Kelola"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Kelola</a>
        </div>
        <div class="col-md-10 text-right">{{ $data['items']->links() }}</div>
    </div>
    <div class="row">
        <div class="col-md-5 pull-right text-right"><strong>Total data:</strong> <span class="badge alert-info">{{ $data['items']->getTotal() }}</span></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th style="width:40px;">No.</th>
                        <th>Rute Hak Akses</th>
                        <th class="col-md-1">Enabled</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = $data['items']->getFrom(); ?>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td><a href="{{ URL::to('permission/detail/' . $item->id) }}" title="">{{ $item->route }}</a></td>
                        <td class="text-center">{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('permission/manage') }}" class="btn btn-primary" title="Kelola"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Kelola</a>
        </div>
        <div class="col-md-10 text-right">{{ $data['items']->links() }}</div>
    </div>
</section>
@stop