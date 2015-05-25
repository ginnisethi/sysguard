@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Tambah Grup</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">


            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="">Nama Grup</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="">Level Grup</label>
                    <input type="number" class="form-control" name="level">
                </div>
                <div class="form-group">
                    <label for="">Hak Akses</label>
                    <div class="input-group">
                        <select class="selecter form-control" name="permission_id">
                            <option value="0"></option>
                        @foreach ($data['permissions'] as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->route }}</option>
                        @endforeach
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="addPermission">Tambah</button>
                        </span>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" id="noPermission">Tidak ada permission terdaftar</div>
                    <table class="table table-striped table-hover table-bordered" id="permission">
                        <tbody>
                            <tr class="sample">
                                <td>
                                    <a class="text">Rute permission</a>
                                    <input type="hidden" value="" name="permission_ids[]">
                                </td>
                                <td class="col-md-2 text-center"><button type="button" class="btn btn-warning btn-xs removePermission">Hapus</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="">Menu</label>
                    <div class="input-group">
                        <select class="selecter form-control" name="menu_id">
                            <option value="0"></option>
                        @foreach ($data['menus'] as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="addMenu">Tambah</button>
                        </span>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" id="noMenu">Tidak ada menu terdaftar</div>
                    <table class="table table-striped table-hover table-bordered" id="menu">
                        <tbody>
                            <tr class="sample">
                                <td>
                                    <a class="text">Nama menu</a>
                                    <input type="hidden" value="" name="menu_ids[]">
                                </td>
                                <td class="col-md-2 text-center"><button type="button" class="btn btn-warning btn-xs removeMenu">Hapus</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="">Enabled</label>
                    <select class="selecter form-control" name="enabled">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Simpan</button>
            </form>
        </div>
    </div>
</section>
@stop

@section('custom_foot')
    @include('sysguard::scripts.item-input-control')
    <script type="text/javascript">
        $(document).ready(function(){
            runItemInputControl(['menu', 'permission']);
        });
    </script>
@stop