					<?php foreach ($list_buku->result() as $b) { ;?>

						<div class="col-xs-6 col-sm-3">
							<div id="hover-cap-4col">
									<div class="caption">
									<a href="<?php echo base_url()?>welcome/detail_buku/<?php echo $b->idbuku ?>" class="linkBuku">
										<center><img style="height: 300px; width: 200px; display: block; margin: auto; overflow: hidden; padding: 0; max-width: 320px;" src="http://localhost/api/foto/<?php echo $b->idbuku?>/<?php echo $b->cover?>" class="img-responsive center" width="50%"></center>
										<h5 align="center"><?php echo $b->judul ?></h5></a>
									</div>
							</div>
						</div>
									<?php } ?>