<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">book</i>&nbsp;TEMA TUGAS AKHIR
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('tema/tambah'); ?>">(+) Tambah Tema</a></li>
					<li><a href="<?php echo site_url('tema/riwayat'); ?>">Riwayat <?php if(isset($notif)) echo $notif; ?></a></li>
					<li class="active"><a href="<?php echo site_url('tema/data'); ?>">List Tema</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t" style="padding-bottom:20px;">
				<h5>Ubah Tema</h5>
				<?php foreach($query->result() as $result2){ ?>
				<div class="row">
					<div class="col s10 offset-s1">
						<?php
						if($this->input->get('balasan')!=null){
							if($this->input->get('balasan')==3){
								echo '<center class="error"><i class="material-icons tiny">error</i> Pilih terlebih dahulu bidang tema</center>';
							}else if($this->input->get('balasan')==2){
								echo '<center class="error"><i class="material-icons tiny">error</i> Terjadi Kesalahan, Gagal Menambahkan</center>';
							}
						}
						?>
						<form action="<?php echo site_url('tema/update/'.$result2->id_tema.''); ?>" method="post" id="submit">
							<div class="input-field">
						    	<select class="browser-default" id="kategori">
							      <option value="">Pilih Bidang</option>
							      <?php foreach($kategoriQuery->result() as $result){ ?>
							      <option value="<?php echo htmlspecialchars($result->id_kategori); ?>"><?php echo htmlspecialchars($result->nama_kategori); ?></option>
							      <?php } ?>
						    	</select>
						  	</div>
						  	<div id="kategori_pilih" style="margin-top:10px;margin-bottom:10px;">
						  		
						  	</div>
						  	<div id="report1" class="error"></div>
						  	<div class="input-field">
						    	<textarea id="judul" name="judul" class="materialize-textarea def-input" length="200" maxlength="200" required><?php echo htmlspecialchars($result2->judul); ?></textarea>
		            			<label for="judul">Judul</label>
		            			<input type="hidden" value="<?php echo htmlspecialchars($result2->judul); ?>" id="judul_lama">
						  	</div>
						  	<div class="input-field">
						    	<textarea id="keterangan" name="keterangan" class="materialize-textarea def-input" length="2000" maxlength="2000" required><?php echo htmlspecialchars($result2->keterangan); ?></textarea>
		            			<label for="keterangan">Keterangan</label>
						  	</div>
						  	<center><button type="submit" class="btn waves-effect waves-light">SIMPAN</a></center>
						</form>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var cek1=1;
	var host = location.protocol + '//' + location.host + '/';
	$("#kategori_pilih").load(host+'/PETTA/tema/getTags');
	$("#kategori").change(function(){
		var kategori = $(this).val();
		$.ajax({
			url:host+'PETTA/tema/appendTags/'+kategori,
			data:{},
			success:function(data){
				$("#kategori_pilih").load(host+'/PETTA/tema/getTags');
			}
		});
	});
	$("#judul").bind('keyup change', function(){
		var judul = $(this).val();
		var judulLama = $("#judul_lama").val();
		$.ajax({
			url:host+'PETTA/tema/checkEditTitle/'+judul+'/'+judulLama,
			data:{},
			success:function(data){
				if(data==1){
					cek1=1;
					$("#report1").text("");
				}else if(data==2){
					cek1=0;
					$("#report1").text("*Judul Tema sudah terpakai");
				}
			}
		});
	});
	$("#submit").submit(function(e){
		if(cek1==0){
			event.preventDefault();
			return false;
		}
	})
});
</script>