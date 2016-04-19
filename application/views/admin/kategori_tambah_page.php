<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">person</i>&nbsp;KATEGORI
				</div>
				<ul class="category-t">
					<li class="active"><a href="<?php echo site_url('kategori/tambah'); ?>">(+) Tambah Kategori</a></li>
					<li><a href="<?php echo site_url('kategori/data'); ?>">List Kategori</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<h5>+ Kategori</h5>
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Hapus Kategori Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">done</i> Tambah Kategori Berhasil</div>';
					}
				}
				?>
				<div class="row">
					<div class="col s12 m8 l6 offset-m2 offset-l3" align="center">
						<form action="<?php echo site_url('kategori/insertKategori') ?>" method="post">
				        	<div class="input-field">
				          		<input id="kategori" name="kategori" type="text" maxlength="40" class="validate" required>
				          		<label for="kategori">nama kategori</label>
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