        <div>
            <div class="card">
                <?php
                if (validation_errors() != false) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php
                }
                ?>
                <form id="formAdd">
                    <div class="card-body">
                        <div class="form-group col-md-7 col-12">
                            <label for="nama">Nama</label>
                            <input id="nama" type="text" class="form-control form-user-input" name="nama">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group col-md-7 col-12">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control form-user-input" name="email">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group col-md-7 col-12">
                            <label for="password" class="d-block">Password</label>
                            <input id="password" type="password" class="form-control pwstrength form-user-input" data-indicator="pwindicator" name="password">
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#formAdd').on('submit', function(e) {
        e.preventDefault();
        sendDataPost();
    });

    function sendDataPost() {
        var link = "http://localhost/api/user/add_user/";
        var dataForm = {};

        var allInput = $('.form-user-input');
        $.each(allInput, function(i, val) {
            dataForm[val['name']] = val['value'];
        });

        console.log(dataForm);

        $.ajax(link, {
            type: 'POST',
            data: dataForm,
            success: function(data, status, xhr) {
                var objData = JSON.parse(data);
                if (objData['success'] == 'TRUE') {
                    Snackbar.show({
                        text: objData['message'],
                        backgroundColor: '#6777ef',
                        textColor: '#fff',
                        actionText: '',
                        pos: 'bottom-right',
                    });
                } else {
                    Snackbar.show({
                        text: objData['message'],
                        backgroundColor: '#fc544b',
                        textColor: '#fff',
                        actionText: '',
                        pos: 'bottom-right',
                    });
                }
                loadMenu('<?= base_url('/user') ?>');
            },
            error: function(jqXHR, textStatus, errorMsg) {
                console.log('Error : ' + errorMsg);
            }
        });
    }
</script>