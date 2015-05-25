<div id="modal-delete" class="modal modal-primary fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data tersebut?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
            {!! Form::open() !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                <button type="submit" class="btn btn-danger">Hapus</button>
            {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal-delete-many" class="modal modal-primary fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data tersebut?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
            {!! Form::open() !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                <input type="hidden" name="ids">
                <button type="submit" class="btn btn-danger">Hapus</button>
            {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>