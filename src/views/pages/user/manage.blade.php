@extends('sysguard::layouts.master')
@section('content')
    @include('sysguard::partials.flash-message')
<section class="content-header">
    <h1>Kelola Pengguna</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('user/create') }}" class="btn btn-primary" title="Tambah"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
    <div class="row">
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered" id="table-user">
                <thead>
                    <tr>
                        <th class="col-md-1">No.</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th class="col-md-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td><a href="{{ URL::to('user/detail/' . $item->id) }}" title="">{{ $item->name }}</a></td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ URL::to('user/update/' . $item->id) }}" class="btn btn-primary btn-xs"title="Sunting"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{ URL::to('user/delete/' . $item->id) }}" class="btn btn-danger btn-xs"title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('user/create') }}" class="btn btn-primary" title="Tambah"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $(function() {
            $('#table-user').dataTable();
            $('#flash-overlay-modal').modal();
        });
    });
</script>
@stop