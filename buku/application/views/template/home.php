<?php 
    $session_data = $this->session->userdata('logged_in');
    $id = $session_data['iduser'];
    $username = $session_data['namauser'];
?>
<?php $this->load->view('layout/base_start');?>
<div class="container-fluid">
 <div class="jumbotron">
    <div class="container">
			<h1>Baca Buku Online </h1>
			<p>Buku Kita - Baca Buku Online | Terlengkap dan terpercaya</p>
			<p>
				<a class="btn btn-primary btn-lg">Learn more</a>
			</p>
		</div>
	</div>
</div>

<div class="container" id="home">
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-success">
			<div class="panel-heading"><span class="glyphicon glyphicon-book"></span> Daftar Buku</div>
				<div class="panel-body">
					<?php foreach ($tb_buku as $key) { ;?>

						<div class="col-xs-6 col-sm-3">
							<div id="hover-cap-4col">
									<div class="caption">
										<a href="<?php echo base_url()?>welcome/detail/<?php echo $key->idbuku ?>">
										<center><img style="height: 300px; width: 200px; display: block; margin: auto; overflow: hidden; padding: 0; max-width: 320px;" src="http://localhost/api/foto/<?php echo $key->idbuku?>/<?php echo $key->cover?>" class="img-responsive center" width="50%"></center>
										<h5 align="center"><?php echo $key->judul ?></h5></a>
									</div>
							</div>
						</div>
									<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('layout/footer');?>