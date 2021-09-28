        <div>
            <div class="card">
                <form id="formEdit" class="needs-validation">
                    <input type="hidden" class="form-user-input" name="idbuku" id="idbuku" />
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
        var link = "http://localhost/api/buku/update_buku/";

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

    function getDetail(idbuku) {
            var link = 'http://localhost/api/buku/detail_buku?idbuku=' + idbuku;

            $.ajax(link, {
                type: 'GET',
                success: function(data, status, xhr) {
                    var data_obj = JSON.parse(data);
                    if (data_obj['success']) {
                        var detail = data_obj['detail'];
                        $('#idbuku').val(detail['idbuku']);
                        $('#judul').val(detail['judul']);
                        $('#cover').val(detail['cover']);
                        $('#link').val(detail['link']);
                        $('#sinopsis').val(detail['sinopsis']);
                        $('#penerbit').val(detail['penerbit']);
                        $('#penulis').val(detail['penulis']);
                        $('#tahun').val(detail['tahun']);
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
        echo 'getDetail(' . $idbuku . ')';
        ?>
</script>