<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; SatuBuku</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
</head>

<body id="#reload-wrapper">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <?php
                                if ($this->session->flashdata('error') != '') {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $this->session->flashdata('error');
                                    echo '</div>';
                                }
                                ?>
                                
                                <?php
                                if ($this->session->flashdata('success') != '') {
                                    echo '<div class="alert alert-primary" role="alert">';
                                    echo $this->session->flashdata('success');
                                    echo '</div>';
                                }
                                ?>
                                <form id="formRegister" novalidate>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input id="nama" type="text" class="form-user-input form-control" name="nama">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-user-input form-control" name="email">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-user-input form-control pwstrength" data-indicator="pwindicator" name="password">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                            <label class="custom-control-label" for="agree">Saya setuju dengan syarat dan ketentuan.</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah memiliki akun? <a href="http://localhost/buku/index.php/login/">Login Sekarang</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; SatuBuku 2021
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

    <script>
        $("#formRegister").on('submit', function(e) {
            e.preventDefault();
            registerProses();
        });

        function registerProses() {
            var link = "http://localhost/api/register/proses/";
            var dataForm = {};
            var allInput = $('.form-user-input');
            $.each(allInput, function(i, val) {
                dataForm[val['name']] = val['value'];
            });

            $.ajax(link, {
                type: 'POST',
                data: dataForm,
                success: function(data, status, xhr) {
                    var data_str = JSON.parse(data);
                    setSession(data_str['success'], data_str['message']);
                },
                error: function(jqXHR, textStatus, errorMsg) {
                    console.log('Error : ' + errorMsg);
                }
            });
        }

        function setSession(success, message) {
            var link = "http://localhost/buku/register/setSession";
            var dataForm = {};
            
            dataForm['success'] = success;
            dataForm['message'] = message;

            $.ajax(link, {
                type: 'POST',
                data: dataForm,
                success: function(data, status, xhr) {
                    $('body').load('#reload-wrapper')
                    // location.replace('http://localhost/buku/register');
                },
                error: function(jqXHR, textStatus, errorMsg) {
                    console.log('Error : ' + errorMsg);
                }
            });
        }
    </script>
</body>

</html>