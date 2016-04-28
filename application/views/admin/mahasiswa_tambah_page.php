<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">person</i>&nbsp;Mahasiswa
				</div>
				<ul class="category-t">
					<li class="active"><a href="<?php echo site_url('mahasiswa/tambah'); ?>">(+) Tambah Mahasiswa</a></li>
					<li><a href="<?php echo site_url('mahasiswa/data'); ?>">List Mahasiswa</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<h5>+ Mahasiswa Baru</h5>
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Tambah Mahasiswa Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Hapus Tema Gagal</div>';
					}
				}
				?>
				<div class="row">
					<div class="col s12 m8 l6 offset-m2 offset-l3" align="center">
						<form action="<?php echo site_url('mahasiswa/insertMahasiswa') ?>" method="post">
				        	<div class="input-field">
				          		<i class="material-icons prefix">person</i>
				          		<input id="username" name="username" type="text" maxlength="14" class="validate" required>
				          		<label for="username">username</label>&nbsp;<span class="error" id="reportUsername"></span>
				        	</div>
				        	<div class="input-field">
				          		<i class="material-icons prefix">lock</i>
				          		<input id="password" name="password" type="password" maxlength="20" class="validate" required>
				          		<label for="password">password</label>
				        	</div>
				        	<div class="input-field">
				          		<input id="nim" name="nim" type="text" maxlength="14" class="validate" required>
				          		<label for="nim">NIM</label>&nbsp;<span class="error" id="reportNim"></span>
				        	</div>
				        	<div class="input-field">
				          		<input id="nama" name="nama" type="text" maxlength="40" class="validate" required>
				          		<label for="nama">Nama</label>&nbsp;<span class="error" id="reportNama"></span>
				        	</div>
				        	<div class="input-field">
				          		<input id="email" name="email" type="email" maxlength="100" class="validate" required>
				          		<label for="email">E-mail</label>&nbsp;<span class="error" id="reportEmail"></span>
				        	</div>
				        	<div class="input-field">
				          		<input id="telepon" name="telepon" type="text" pattern="[0-9]{1,12}" maxlength="12" class="validate" required>
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
<script type="text/javascript">
	$(document).ready(function(){
		var check1=0;
		$("#nim").bind("keyup change", function(){
		var nim = $(this).val();
		$.ajax({
			url:'cekData/mahasiswa/nim/'+nim,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#reportNim").text("");
					 $('button[type="submit"]').prop('disabled','');
					 $("#username").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nama").prop("disabled", '');
					 $("#email").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportNim").text("*nim sudah ada");
					 $('button[type="submit"]').prop('disabled',true);
					 $("#username").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nama").prop("disabled", true);
					 $("#email").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
		$("#nama").bind("keyup change", function(){
		var nama = $(this).val();
		$.ajax({
			url:'cekData/mahasiswa/nama_mahasiswa/'+nama,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#reportNama").text("");
					 $('button[type="submit"]').prop('disabled','');
					 $("#username").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nim").prop("disabled", '');
					 $("#email").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportNama").text("*nama sudah ada");
					 $('button[type="submit"]').prop('disabled',true);
					 $("#username").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nim").prop("disabled", true);
					 $("#email").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
		$("#email").bind("keyup change", function(){
		var email = $(this).val();
		$.ajax({
			url:'cekData/mahasiswa/email/'+email,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#reportEmail").text("");
					check1=1;
					 $('button[type="submit"]').prop('disabled','');
					 $("#username").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nama").prop("disabled", '');
					 $("#nim").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportEmail").text("*email sudah ada");
					check1=0;
					 $('button[type="submit"]').prop('disabled',true);
					 $("#username").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nama").prop("disabled", true);
					 $("#nim").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
		$("#username").bind("keyup change", function(){
		var username = $(this).val();
		$.ajax({
			url:'cekData/pengguna/username/'+username,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#reportUsername").text("");
					check1=1;
					 $('button[type="submit"]').prop('disabled','');
					  $("#nim").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nama").prop("disabled", '');
					 $("#email").prop("disabled", '');
					 $("#dosen").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportUsername").text("*username sudah ada");
					check1=0;
					 $('button[type="submit"]').prop('disabled',true);
					 $("#nim").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nama").prop("disabled", true);
					 $("#email").prop("disabled", true);
					 $("#dosen").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
	});
</script>