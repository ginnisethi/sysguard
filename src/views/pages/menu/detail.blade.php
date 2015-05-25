@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Rincian Menu</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $item = $data['item']; ?>
            @if ($data['item'] != null)
            <a href="{{ URL::to('menu/update/' . $item->id) }}" class="btn btn-primary" title="Sunting"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="{{ URL::to('menu/delete/' . $item->id) }}" class="btn btn-danger"title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
            @endif
            <a href="{{ URL::to('menu') }}" class="btn btn-default" title="Kembali ke Daftar"><span class="glyphicon glyphicon-list"></span></a>
            <br><br>
            @if ($data['item'] != null)
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <tr>
                        <th class="col-md-3">Nama Menu</th>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <th>URL</th>
                        <td>{{ $item->url }}</td>
                    </tr>
                    <tr>
                        <th>Urutan</th>
                        <td>{{ $item->order }}</td>
                    </tr>
                    <tr>
                        <th>Parent</th>
                    @if ($item->parent != null)
                        <td><a href="{{ URL::to('menu/detail/' . $item->parent_id) }}" title="">{{ $item->parent->name . ' - ' . $item->parent->url }}</a></td>
                    @else
                        <td>Tidak ada</td>
                    @endif
                    </tr>
                    <tr>
                        <th>Child</th>
                        <td>
                        @if ($item->child->count() >0)
                            @foreach ($item->child as $child)
                                <li>
                                    <a href="{{ URL::to('menu/detail/' . $child->id) }}" title="">{{ $child->name . ' - ' . $child->url }}</a>
                                @if ($child->child->count() >0)
        <ul>

                                    @foreach ($child->child as $grandChild)
        <li>
                                    <a href="{{ URL::to('menu/detail/' . $grandChild->id) }}" title="">{{ $grandChild->name . ' - ' . $grandChild->url }}</a></li>
                                    @endforeach
                                    </ul>
                                @endif
                                </li>
                            @endforeach
                        @else
                            Tidak ada
                        @endif
                        </td>
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