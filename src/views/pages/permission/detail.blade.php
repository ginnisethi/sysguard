@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Rincian Hak Akses</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $item = $data['item']; ?>
            @if ($data['item'] != null)
            <a href="{{ URL::to('permission/update/' . $item->id) }}" class="btn btn-primary" title="Sunting"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="{{ URL::to('permission/delete/' . $item->id) }}" class="btn btn-danger"title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
            @endif
            <a href="{{ URL::to('permission') }}" class="btn btn-default" title="Kembali ke Daftar"><span class="glyphicon glyphicon-list"></span></a>
            <br><br>
            @if ($data['item'] != null)
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <tr>
                        <th class="col-md-3">Rute Hak Akses</th>
                        <td>{{ $item->route }}</td>
                    </tr>
                    <tr>
                        <th>Grup pengakses</th>
                        <td>
                        @if ($item->group->count() >0)
                            @foreach ($item->group as $group)
                                <li>
                                    <a href="{{ URL::to('group/detail/' . $group->id) }}" title="">{{ $group->name }}</a>
                                </li>
                            @endforeach
                        @else
                            Tidak ada
                        @endif
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