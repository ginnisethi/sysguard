@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Profil Pengguna</h1>
</section>
<section class="content">
<?php $item = $data['item']; ?>
    @if ($data['item'] != null)
        @if (!Auth::guest())
            @if (Auth::user()->getGroupRole()->id == Setting::getAdminGroup()->id)
            <a href="{{ URL::to('user/update/' . $item->id) }}" class="btn btn-primary" title="Sunting"><span class="glyphicon glyphicon-pencil"></span> Sunting</a>
            <a href="{{ URL::to('user/delete/' . $item->id) }}" class="btn btn-danger"title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
            @elseif (Auth::user()->id == $item->id)
            <a href="{{ URL::to('user/update') }}" class="btn btn-primary" title="Sunting"><span class="glyphicon glyphicon-pencil"></span> Sunting</a>
            @endif

            @if (Auth::user()->person_type != null)
            <?php 
                $person_type = '';
                Auth::user()->person_type == 'Lecturer' ? $person_type = 'Dosen' : $person_type = 'Mahasiswa';
             ?>
            <a href="{{ URL::to( strtolower(Auth::user()->person_type) . '/update') }}" class="btn btn-default" title="Sunting Data {{ $person_type }}"> <span class="glyphicon glyphicon-user"></span> Sunting Data {{ $person_type }}</a>
            @endif
        @endif
    <br><br>
    <div class="box box-info">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="{{ URL::to($item->img_path) }}" alt="Foto Pengguna" class="img-rounded">
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table table-striped table-hover table-bordered">
                        <tbody>
                        @if (!Auth::guest())
                            @if (Auth::user()->id == $item->id || Auth::user()->getGroupRole()->id == Setting::getAdminGroup()->id)
                            <tr>
                                <th class="col-md-3">Username</th>
                                <td>{{ $item->username }}</td>
                            </tr>
                            <tr>
                                <th>Kata Sandi</th>
                                <td><a href="{{ URL::to('user/change_password/' . $item->id) }}" title="">Ganti kata sandi</a></td>
                            </tr>
                            <tr>
                                <th>Grup</th>
                                <td>
                                @if ($item->group->count() == 0)
                                    <span class="text-muted">Tidak terdaftar di group apapun</span>
                                @endif
                                @foreach ($item->group as $group)
                                    <li><a href="{{ URL::to('group/detail/' . $group->id) }}">{{ $group->name }}</a></li>
                                @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Enabled</th>
                                <td>{{ $item->enabled ? '<span class="label label-success">Ya</span>' : '<span class="label label-default">Tidak</span>' }}</td>
                            </tr>
                            @endif
                        @endif
                            <tr>
                                <th>Nama</th>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td>{{ $item->email }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $item->address }}</td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td>{{ $item->contact }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>
                                    @if ($item->gender == 'l')
                                    Laki-laki
                                    @elseif ($item->gender == 'p')
                                    Perempuan
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
</section>
@stop