@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Rincian Grup</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $item = $data['item']; ?>
            @if ($data['item'] != null)
                @if (Auth::user()->hasAccess('group/update/' . $item->id))
                    <a href="{{ URL::to('group/update/' . $item->id) }}" class="btn btn-primary" title="Sunting"><span class="glyphicon glyphicon-pencil"></span></a>
                @endif
                @if (Auth::user()->hasAccess('group/delete/' . $item->id))
                    <a href="{{ URL::to('group/delete/' . $item->id) }}" class="btn btn-danger"title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
                @endif
            @endif
                @if (Auth::user()->hasAccess('group'))
                    <a href="{{ URL::to('group') }}" class="btn btn-default" title="Kembali ke Daftar"><span class="glyphicon glyphicon-list"></span></a>
                @endif
            <br><br>
            @if ($data['item'] != null)
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <tr>
                        <th class="col-md-3">Nama Grup</th>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Level Grup</th>
                        <td>{{ $item->level }}</td>
                    </tr>
                    <tr>
                        <th>Hak Akses</th>
                        <td>
                        @if ($item->permission->count() == 0)
                            <span class="text-muted">Tidak terdaftar di permission apapun</span>
                        @endif
                        @foreach ($item->permission as $permission)
                            <li><a href="{{ URL::to('permission/detail/' . $permission->id) }}">{{ $permission->route }}</a></li>
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Menu</th>
                        <td>
                        @if ($item->menu->count() == 0)
                            <span class="text-muted">Tidak terdaftar di menu apapun</span>
                        @endif
                        @foreach ($item->menu as $menu)
                            <li><a href="{{ URL::to('menu/detail/' . $menu->id) }}">{{ $menu->name }}</a></li>
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Enabled</th>
                        <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</section>
@stop