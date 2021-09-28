<?php 
	$id = $this->session->userdata('id');
    $username = $this->session->userdata('nama');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Buku Kita</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><a id="home" href="<?php echo base_url('welcome'); ?>">Home</a></li>
			</ul>
			<?php 
			if (empty($id)) { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a id="Register" href="#">Daftar</a></li>
				<li><a id="login" href="#">Login</a></li>
			</ul>
			<?php }else{ ?>
			<ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello , <?php echo $username; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('Favorit/getIduser') ?>/<?=$id?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Favorit</a></li>
                        <li><a href="<?php echo base_url('Login/logout'); ?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        <?php } ?>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

<script>
$('#login').ready(function(){
  $("#login").click(function(){
    $.ajax({url: "<?php echo base_url('Login'); ?>", success: function(result){
      $("body").html(result);
    }});
  });
});
$('#Register').ready(function(){
  $("#Register").click(function(){
    $.ajax({url: "<?php echo base_url('Register'); ?>", success: function(result){
      $("body").html(result);
    }});
  });
});
</script>

