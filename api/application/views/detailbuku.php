<div class="col-xs-6 col-sm-3">
				<div id="hover-cap-4col">
						<div class="caption">
							<img style="max-height: 500px; display: block; margin: auto; height: 300px; width: 200px; overflow: hidden; padding: 0; max-width: 350px;" src="http://localhost/api/foto/<?php echo $list_buku->idbuku?>/<?php echo $list_buku->cover?>" class="img-responsive center">
						</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h4>Judul Buku : <?php echo $list_buku->judul?></h5>
				<h4>Pembuat : <?php echo $list_buku->penulis?></h5>
				<h4>Penerbit : <?php echo $list_buku->penerbit?></h5>
                <h4>Tahun Rilis : <?php echo $list_buku->tahun?></h5>
				<p>Ringkasan : <?php echo $list_buku->sinopsis?></p>
                <?php 
                if (! empty($id)) { ?>
                <a href="<?php echo site_url('subscribe/insert') ?>/<?=$b->idbuku?>/<?=$id?>"><button type="button" class="btn btn-primary" aria-label="Left Align">
				<span class="glyphicon glyphicon-play" aria-hidden="true"></span> Baca </button></a>
				<a href="<?php echo site_url('subscribe/insert') ?>/<?=$b->idbuku?>/<?=$id?>"><button type="button" class="btn btn-success" aria-label="Left Align">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambahkan Favorit </button></a>
                <?php }else{ ?>
				<a href="<?php echo base_url('Login'); ?>"><button type="button" class="btn btn-danger" aria-label="Left Align">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Baca </button></a>
                <a href="<?php echo base_url('Login'); ?>"><button type="button" class="btn btn-danger" aria-label="Left Align">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambahkan Favorit </button></a>
                <?php } ?>
			</div>