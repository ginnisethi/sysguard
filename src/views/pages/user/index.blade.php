@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Pengguna</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('user/manage') }}" class="btn btn-primary" title="Kelola"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Kelola</a>
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
                        <th class="col-md-1">No.</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Kontak</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = $data['items']->getFrom(); ?>
                @foreach ($data['items'] as $item)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td><a href="{{ URL::to('user/detail/' . $item->id) }}" title="">{{ $item->name }}</a></td>
                        <td>
                            @if ($item->gender == 'l')
                            Laki-laki
                            @elseif ($item->gender == 'p')
                            Perempuan
                            @endif
                        </td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->contact }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('user/manage') }}" class="btn btn-primary" title="Kelola"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Kelola</a>
        </div>
        <div class="col-md-10 text-right">{{ $data['items']->links() }}</div>
    </div>
</section>
@stop