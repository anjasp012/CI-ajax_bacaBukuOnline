<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td align="right">
                <a href="#" class="btn btn-warning">Edit</a>
                <a href="#" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
    </tbody>

</table>

<script>
    function loadKonten(url) {
        $.ajax(url, {
            type: 'GET',
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);
                $('#table').html(objData);
                reload_event();
            },
            error: function(jqXHR, textstatus, errorMsg) {
                alert('Error : ' + errorMsg);
            }
        })
    }

    function reload_event() {
        $('.linkHapus').on('click', function() {
            var idUSer = this.hash.replace('#', '');
            hapusData(idUSer);
        });

        $('.linkEdit').on('click', function () {
            var hashClean = this.hash.replace('#', '');
            loadMenu('<?= base_url('user/form_edit/')?>' + hashClean);
        });

    }

    function hapusData(idUser) {
        var url = 'http://localhost/api/user/delete_user?id=' + idUser;

        $.ajax(url, {
            type: 'GET',
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);
                Snackbar.show({
                    text: objData['message'],
                    backgroundColor: '#6777ef',
                    textColor: '#fff',
                    actionText: '',
                    pos: 'bottom-right',
                });
                loadKonten('http://localhost/api/user/list_user');
            },
            error: function(jqXHR, textStatus, errorMsg) {
                alert('Error: ' + errorMsg);
            }
        })
    }

    loadKonten('http://localhost/api/user/list_user');
</script>