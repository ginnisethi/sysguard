<!-- jQuery UI 1.11.2 -->
<script src="{{ asset('/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/adminlte/dist/js/app.min.js') }}" type="text/javascript"></script>

<!-- SIMTA ITS script -->
<script type="text/javascript">
    function showModalDelete(modalName, url, title, body, ids) 
    {
        var modal = $('#' + modalName).clone();

        $('.modal-footer form', modal).attr('action', url);

        if (title) {
            $('.modal-title', modal).text(title);
        }
        if (body) {
            $('.modal-body p', modal).text(body);
        }
        if (ids) {
            $('input[name=ids]', modal).val(JSON.stringify(ids));
        }

        modal.modal();
    }

$(document).ready(function(){
    // button destroy handler, showing modal confirmation
    $('button.destroy').click(function(){
        var url = $(this).data('url');
        showModalDelete('modal-delete', url);
    });
    $('button.destroy-many').click(function(){
        var ids = [];
        $('tr td div.checked input[type=checkbox]').each(function(){
            ids.push(this.value);
        });

        if (ids.length == 0) {
            return;
        }

        var url = $(this).data('url');
        var message = 'Anda yakin ingin menghapus ' + ids.length + ' data tersebut?';
        showModalDelete('modal-delete-many', url, false, message, ids);
    });

});
</script>