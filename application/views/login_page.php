<div class="container">
	<center><img src="<?php echo base_url('assets/img/logo.png'); ?>" class="img-responsive log-logo-t"></center>
	<div class="row">
		<div class="col s12 m6 l4 offset-m3 offset-l4" style="margin-top:-15px;margin-bottom:50px;">
			<div class="box-t" style="padding:40px 20px 30px 20px;border-top:4px solid #81BEF7;border-bottom:4px solid #81BEF7;">
				<div style="font-size:16pt;padding-bottom:10px;" align="center">
	      			MASUK PENGGUNA
	      		</div>
	      		<?php
	      		if($report==1){
	      		?>
	      			<center style="color:red">username/password salah</center>
	      		<?php
	      		}else{

	      		}
	      		?>
	      		<form action="<?php echo site_url('pengguna/loginProcess') ?>" method="post">
		        	<div class="input-field">
		          		<i class="material-icons prefix">person</i>
		          		<input id="username" name="username" type="text" maxlength="40" class="validate" required>
		          		<label for="username">username</label>
		        	</div>
		        	<div class="input-field">
		          		<i class="material-icons prefix">lock</i>
		          		<input id="password" name="password" type="password" maxlength="40" class="validate" required>
		          		<label for="password">password</label>
		        	</div>
		      		<br/>
		      		<button type="submit" style="width:100%;" class="waves-effect waves-light btn blue darken-1">Masuk</button>
		      	</form>
		      	<div style="margin-top:40px;font-size:9pt;" align="center">
		      		<hr/>
		      		<b>PETTA (Sistem Penawaran Tugas Akhir)</b><br/>
		      		Informatika/Ilmu Komputer &copy 2016
		      	</div>
			</div>
		</div>
	</div>
</div>