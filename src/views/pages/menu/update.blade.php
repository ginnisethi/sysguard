@extends('sysguard::layouts.master')
@section('content')
<section class="content-header">
    <h1>Sunting Menu</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            @if ($data['item'] != null)
            <?php $item = $data['item']; ?>

            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="">Nama Menu </label>
                    <input type="text" class="form-control" value="{{ $item->name }}" name="name">
                </div>
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control" value="{{ $item->url }}" name="url">
                </div>
                <div class="form-group">
                    <label for="">Urutan</label>
                    <input type="number" class="form-control" value="{{ $item->order }}" name="order">
                </div>
                <div class="form-group">
                    <label for="">Parent</label>
                    <select class="selecter form-control" name="parent_id">
                        <option value="0" @if ($item->parent_id == 0) {{ 'selected' }} @endif >Tanpa parent</option>
                    @foreach ($data['items'] as $item)
                        <option value="{{ $item->id }}" @if ($item->parent_id == $item->id) {{ 'selected' }} @endif >{{ $item->name . ' - ' . $item->url }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Enabled</label>
                    <select class="selecter form-control" name="enabled">
                        <option value="1" @if ($item->enabled == '1') {{ 'selected' }} @endif >Ya</option>
                        <option value="0" @if ($item->enabled == '0') {{ 'selected' }} @endif >Tidak</option>
                    </select>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Simpan</button>
            </form>
            @endif
        </div>
    </div>
</section>
@stop