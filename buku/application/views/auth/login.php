<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; SatuBuku</title>

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
                                <h4>Login</h4>
                            </div>

                            <div class="card-body" id="reload-wrapper">
                                <?php
                                if ($this->session->flashdata('error') != '') {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $this->session->flashdata('error');
                                    echo '</div>';
                                }
                                ?>

                                <form id="formLogin" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="nama" type="nama" class="form-control form-user-input" name="nama" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Masukan email dengan benar
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="#" class="text-small">
                                                    Lupa Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control form-user-input" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Masukan password dengan benar
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Belum memiliki akun? <a href="<?php echo base_url(); ?>index.php/register/">Buat Sekarang</a>
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

    <!-- JS Ajax -->
    <script>
        $("#formLogin").on('submit', function(e) {
            e.preventDefault();
            checkLogin();
        });

        function checkLogin() {
            var link = "http://localhost/api/login/proses/";
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
                    setSession(data_str['user']);
                },
                error: function(jqXHR, textStatus, errorMsg) {
                    console.log('Error : ' + errorMsg);
                }
            });
        }

        function setSession(user) {
            var link = "http://localhost/buku/login/setSession";
            var dataForm = {};

            dataForm['data'] = user;

            $.ajax(link, {
                type: 'POST',
                data: dataForm,
                success: function(data, status, xhr) {
                    var data_str = JSON.parse(data);
                    if (data_str['success'] == 'TRUE') {
                        location.replace('http://localhost/buku/dashboard');
                    } else {
                        $('body').load('#reload-wrapper')
                    }
                },
                error: function(jqXHR, textStatus, errorMsg) {
                    console.log('Error : ' + errorMsg);
                }
            });
        }
    </script>

</body>

</html>