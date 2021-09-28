        <div>
            <div class="card">
                <form id="formEdit" class="needs-validation">
                    <input type="hidden" class="form-user-input" name="id" id="id" />
                    <div class="card-body">
                        <div class="form-group col-md-7 col-12">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control form-user-input" required="">
                            <div class="invalid-feedback">
                                Masukan Nama dengan benar
                            </div>
                        </div>
                        <div class="form-group col-md-7 col-12">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control form-user-input" required="">
                            <div class="invalid-feedback">
                                Masukan email dengan benar
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#formEdit').on('submit', function(e) {
            e.preventDefault();
            sendDataPost();
        });

        function sendDataPost() {
            var link = "http://localhost/api/user/update_user/";
            var dataForm = {};

            var allInput = $('.form-user-input');
            $.each(allInput, function(i, val) {
                dataForm[val['name']] = val['value'];
            });

            $.ajax(link, {
                type: 'POST',
                data: dataForm,
                success: function(data, status, xhr) {
                    Snackbar.show({
                        text: 'Berhasil.',
                        backgroundColor: '#6777ef',
                        textColor: '#fff',
                        actionText: '',
                        pos: 'bottom-right',
                    });
                    loadMenu('<?= base_url('/user') ?>');
                },
                error: function(jqXHR, textStatus, errorMsg) {
                    console.log('Error : ' + errorMsg);
                }
            });
        }

        function getDetail(idUser) {
            var link = 'http://localhost/api/user/detail_user?id=' + idUser;

            $.ajax(link, {
                type: 'GET',
                success: function(data, status, xhr) {
                    var data_obj = JSON.parse(data);

                    if (data_obj['success']) {
                        var detail = data_obj['detail'];
                        $('#id').val(detail['id']);
                        $('#nama').val(detail['nama']);
                        $('#email').val(detail['email']);
                    } else {
                        Snackbar.show({
                            text: 'Data tidak ditemukan.',
                            backgroundColor: '#fc544b',
                            textColor: '#fff',
                            actionText: '',
                            pos: 'bottom-right',
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorMsg) {
                    alert('Error : ' + errorMsg);
                }
            });
        }

        <?php
        echo 'getDetail(' . $id . ')';
        ?>
    </script>