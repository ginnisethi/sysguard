@extends('layouts.master')

@section('content-header')
    @include('sysguard::partials.content-header', ['title' => $title])
@stop

@section('content')

@if (Session::has('flash_message'))
    @include('sysguard::partials.flash-message')
@endif

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('example.create') }}" class="btn btn-social btn-primary">
            <i class="fa fa-plus"></i> Add
        </a>
        <br><br>
        <div class="box box-primary">
            <div class="box-body table-responsive">
                <button class="btn btn-default btn-sm checkbox-check" data-toggle="tooltip" title="Select All"><i class="glyphicon glyphicon-check"></i></button>&nbsp;
                <button class="btn btn-default btn-sm checkbox-uncheck" data-toggle="tooltip" title="Deselect All"><i class="glyphicon glyphicon-unchecked"></i></button>&nbsp;
                <button class="btn btn-danger btn-sm destroy-many" data-url="{{ route('example.destroy-many') }}" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></button>&nbsp;
                <br><br>
                
                <table id="index" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="no-sort" style="width=5px"></th>
                            <th>No.</th>
                            <th class="col-md-3">Nama</th>
                            <th class="col-md-3">Email</th>
                            <th class="col-md-2">Birthday</th>
                            <th>Gender</th>
                            <th class="col-md-2">Start Date</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach ($examples as $item)
                        <tr>
                            <td><input type="checkbox" value="{{ $item->id }}"></td>
                            <td id="{{$i}}-sasa" >{{ $i++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->birthdate }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>
                                <a class="btn btn-xs btn-default" data-toggle="tooltip" title="Show" href="{{ route('example.show', $item->id) }}">
                                    <i class="glyphicon glyphicon-new-window"></i>
                                </a>
                                <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit" href="{{ route('example.edit', $item->id) }}">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <button class="btn btn-xs btn-danger destroy" data-toggle="tooltip" data-url="{{ route('example.destroy', $item->id) }}" title="Delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('custom-head')
<link rel="stylesheet" type="text/css" href="{{ asset('/datatables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/adminlte/plugins/iCheck/flat/blue.css') }}">
@stop

@section('custom-foot')
<script type="text/javascript" src="{{ asset('/datatables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript">
    function iCheckInit() 
    {
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    }

    $(document).ready(function(){
        var table = $('#index');
        var datatable = table.DataTable({
            "order": [[ 1, "asc" ]],
            "columnDefs": [ { "targets": 'no-sort', "searchable": false, "orderable": false, "visible": true } ]
        });

        iCheckInit();
        
        $('#index').on('draw.dt', function () {
            iCheckInit();
        });

        $('.checkbox-check').click(function(){
            $("input[type='checkbox']", "#index").iCheck("check");
        });

        $('.checkbox-uncheck').click(function(){
            $("input[type='checkbox']", "#index").iCheck("uncheck");
        });
    });
</script>
@stop