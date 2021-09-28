<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Link</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Tahun Terbit</th>
            <th scope="col">Penulis</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
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
            var idbuku = this.hash.replace('#', '');
            hapusData(idbuku);
        });

        $('.linkEdit').on('click', function () {
            var hashClean = this.hash.replace('#', '');
            loadMenu('<?= base_url('buku/form_edit/')?>' + hashClean);
        });

    }

    function hapusData(idbuku) {
        var url = 'http://localhost/api/buku/delete_buku?idbuku=' + idbuku;

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
                loadKonten('http://localhost/api/buku/list_buku');
            },
            error: function(jqXHR, textStatus, errorMsg) {
                alert('Error: ' + errorMsg);
            }
        })
    }

    loadKonten('http://localhost/api/buku/list_buku');
</script>