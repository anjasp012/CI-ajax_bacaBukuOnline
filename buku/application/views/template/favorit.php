<?php ;
	$id = $this->session->userdata('id');
    $username = $this->session->userdata('nama');
?>

<?php $this->load->view('layout/base_start'); ?>
<div class="container">
<div class="container-fluid">
<div class="row">
<div class="panel panel-success">
<div class="panel-heading"><span class="glyphicon glyphicon-book"></span> Buku Favorit</div>
    <div class="panel-body">
        <?php foreach ($favorit as $key) { ;?>

            <div class="col-xs-6 col-sm-3">
                <div id="hover-cap-4col">
                        <div class="caption">
                            <a href="<?php echo base_url()?>welcome/detail/<?php echo $key->id_bukufavorit ?>">
                            <img style="max-height: 500px; display: block; margin: auto; height: 300px; width: 200px; overflow: hidden; padding: 0; max-width: 350px;" src="http://localhost/api/foto/<?php echo $key->id_bukufavorit?>/<?php echo $key->cover?>" class="img-responsive center">
                            <p class="text-center"><?php echo $key->judul; ?></p>
                            <br>
                            <center><a href="<?php echo site_url('favorit/delete') ?>/<?=$key->id_bukufavorit?>/<?=$id?>"><button type="button" class="btn btn-danger">Hapus</button></a></center>
                        </div>
                </div>
            </div>
                        <?php } ?>
    </div>
</div>
</div>
</div>
</div>