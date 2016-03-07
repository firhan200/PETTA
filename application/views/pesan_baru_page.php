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
					<li><a href="<?php echo site_url('pesan'); ?>">Kotak Masuk <?php if(isset($notif)) echo $notif; ?></a></li>
					<li><a href="<?php echo site_url('pesan/pesan_keluar'); ?>">Kotak Keluar</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t" style="padding-bottom:20px;">
				<h5>+ Pesan Baru</h5>
				<div class="row">
					<div class="col s10 offset-s1">
						<form action="<?php echo site_url('pesan/kirim'); ?>" method="post">
							<div class="input-field">
						    	<select class="browser-default" name="penerima" required>
							      <option value="">Pilih Penerima</option>
							      <?php foreach($receiverQuery->result() as $result){ ?>
							      <option value="<?php echo htmlspecialchars($result->id_pengguna); ?>"><?php if($for==1){ echo htmlspecialchars($result->nama_dosen); }else{ echo htmlspecialchars($result->nama_mahasiswa); } ?></option>
							      <?php } ?>
						    	</select>
						  	</div>
						  	<div class="input-field">
						    	<textarea id="pesan" name="pesan" class="materialize-textarea" length="320" maxlength="320" required></textarea>
		            			<label for="pesan">Pesan</label>
						  	</div>
						  	<center><button type="submit" class="btn waves-effect waves-light">KIRIM</a></center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>