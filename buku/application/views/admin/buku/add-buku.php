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
                            <label for="judul">Judul</label>
                            <input id="judul" type="text" class="form-control form-user-input" name="judul">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group">
						<label class="col-md-12">Cover</label>
							<div class="col-md-12">
								<input type="file" name="file" id="file">
					    </div>
                        
                        <div class="form-group col-md-7 col-12">
                            <label for="link">Link</label>
                            <input id="link" type="text" class="form-control form-user-input" name="link" placeholder="http://">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group col-md-7 col-12">
                            <label for="sinopsis">Sinopsis</label>
                            <textarea id="sinopsis" type="text" class="form-control form-user-input" name="sinopsis"></textarea>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group col-md-7 col-12">
                            <label for="penerbit">Penerbit</label>
                            <input id="penerbit" type="text" class="form-control form-user-input" name="penerbit">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-7 col-12">
                            <label for="penulis">Penulis</label>
                            <input id="penulis" type="text" class="form-control form-user-input" name="penulis">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-7 col-12">
                            <label for="tahun">Tahun Terbit</label>
                            <input id="tahun" type="text" class="form-control form-user-input" name="tahun">
                            <div class="invalid-feedback">
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
        var link = "http://localhost/api/buku/add_buku/";

        var dataForm = new FormData();
		var allInput = $('.form-user-input');

		$.each(allInput, function (i, val) {
			dataForm.append(val['name'], val['value']);
		});
		
		var file = $('#file')[0].files[0];
		dataForm.append('file', file);

		$.ajax(link, {
			type: 'POST',
			data: dataForm,
			contentType: false,
			processData: false,
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
                loadMenu('<?= base_url('/buku') ?>');
            },
            error: function(jqXHR, textStatus, errorMsg) {
                console.log('Error : ' + errorMsg);
            }
        });
    }
</script>