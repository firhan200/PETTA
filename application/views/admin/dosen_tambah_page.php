<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">person</i>&nbsp;DOSEN
				</div>
				<ul class="category-t">
					<li class="active"><a href="<?php echo site_url('dosen/tambah'); ?>">(+) Tambah Dosen</a></li>
					<li><a href="<?php echo site_url('dosen/data'); ?>">List Dosen</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<h5>+ Dosen Baru</h5>
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Hapus Tema Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Hapus Tema Gagal</div>';
					}
				}
				?>
				<div class="row">
					<div class="col s12 m8 l6 offset-m2 offset-l3" align="center">
						<form action="<?php echo site_url('dosen/insertDosen') ?>" method="post">
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
				        	<div class="input-field">
				          		<input id="nip" name="nip" type="text" maxlength="40" class="validate" required>
				          		<label for="nip">NIP</label>
				        	</div>
				        	<div class="input-field">
				          		<input id="nama" name="nama" type="text" maxlength="40" class="validate" required>
				          		<label for="nama">Nama</label>
				        	</div>
				        	<div class="input-field">
				          		<input id="email" name="email" type="email" maxlength="100" class="validate" required>
				          		<label for="email">E-mail</label>
				        	</div>
				        	<div class="input-field">
				          		<input id="telepon" name="telepon" type="text" pattern="[0-9]{1,40}" maxlength="40" class="validate" required>
				          		<label for="telepon">Telepon</label>
				        	</div>
				      		<br/>
				      		<button type="submit" class="waves-effect waves-light btn blue darken-1">Tambah</button>
				      	</form>
				      	<br/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>