@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Kelola Hak Akses</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('permission/create') }}" class="btn btn-primary" title="Tambah"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
    <div class="row">
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered" id="table-permission">
                <thead>
                    <tr>
                        <th style="width:40px;">No.</th>
                        <th>Rute Hak Akses</th>
                        <th class="col-md-1">Enabled</th>
                        <th class="col-md-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td><a href="{{ URL::to('permission/detail/' . $item->id) }}" title="">{{ $item->route }}</a></td>
                        <td class="text-center">{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <a href="{{ URL::to('permission/update/' . $item->id) }}" class="btn btn-primary btn-xs"title="Sunting"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{ URL::to('permission/delete/' . $item->id) }}" class="btn btn-danger btn-xs"title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('permission/create') }}" class="btn btn-primary" title="Tambah"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $(function() {
            $('#table-permission').dataTable();
        });
    });
</script>
@stop