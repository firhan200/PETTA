<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">email</i>&nbsp;PESAN
				</div>
				<ul class="category-t">
					<li class="active"><a href="<?php echo site_url('pesan/pesan_baru'); ?>">(+) Tulis Pesan</a></li>
					<li><a href="<?php echo site_url('pesan'); ?>">Kotak Masuk <span class="badge-t">1 baru</span></a></li>
					<li><a href="#">Kotak Keluar</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t" style="padding-bottom:20px;">
				<h5>+ Pesan Baru</h5>
				<form>
					<div class="input-field">
				    	<select class="browser-default">
					      <option value="">Penerima</option>
					      <option value="1">Option 1</option>
					      <option value="2">Option 2</option>
					      <option value="3">Option 3</option>
				    	</select>
				  	</div>
				  	<div class="input-field">
				    	<textarea id="pesan" class="materialize-textarea" length="320" maxlength="320"></textarea>
            			<label for="pesan">Pesan</label>
				  	</div>
				  	<center><a href="#" class="btn waves-effect waves-light">KIRIM</a></center>
				</form>
			</div>
		</div>
	</div>
</div>