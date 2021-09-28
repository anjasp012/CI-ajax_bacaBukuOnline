<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard &mdash; SatuBuku</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/snackbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
</head>

<body style="margin-top: 4px;">
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title"><?= $this->session->userdata('nama') ?></div>
                            <div class="dropdown-divider"></div>
                            <a onclick="setStatusNoActive('<?= $this->session->userdata('idUser') ?>')" href="<?php echo base_url(); ?>/login/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">Buku Kita</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">SB</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="<?php echo base_url(); ?>/dashboard/"><i class="fa fa-fire"></i><span>Dashboard</span></a></li>
                        <li class="menu-header">Menu</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-user"></i><span>User</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#" onclick="loadMenu('<?= base_url('/user') ?>')">Data User</a></li>
                                <li><a class="nav-link" href="#" onclick="loadMenu('<?= base_url('/user/form_add') ?>')">Add User</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-book"></i><span>Buku</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#" onclick="loadMenu('<?= base_url('/buku') ?>')">Data Buku</a></li>
                                <li><a class="nav-link" href="#" onclick="loadMenu('<?= base_url('/buku/form_add') ?>')">Add Buku</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="text-transform: uppercase;" id="title">SELAMAT DATANG <?= $this->session->userdata('nama') ?></h4>
                        </div>
                        <div class="card-body p-0" id="konten">
                            
                        </div>
                    </div>
                </section>
            </div>
            <!-- End -->

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; SatuBuku 2021
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/snackbar.min.js"></script>

    <!-- Template JS File -->
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

    <script>
        function loadMenu(url) {
            $.ajax(url, {
                type: 'GET',
                success: function(data, status, xhr) {
                    var objData = JSON.parse(data);

                    $('#konten').html(objData.konten);
                    $('#title').html(objData.title);
                    // $('.page-breadcrumb .page-title').html(objData.title);
                },
                error: function(jqXHR, textstatus, errorMsg) {
                    alert('Error : ' + errorMsg);
                }
            })
        }

        function setStatusNoActive(idUser) {
            var dataForm = {};
            dataForm['idUser'] = idUser;


            $.ajax('http://localhost/api/login/logout', {
                type: 'POST',
                data: dataForm,
            });
        }
    </script>


</body>

</html>