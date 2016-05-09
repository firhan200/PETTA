<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		
		<div class="col s12 m12">
			<div class="box-t">
				<center><i class="medium material-icons">contact_phone</i><h5>Verifikasi</h5></center>	
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
				<?php foreach($row->result() as $result){?>
					<div class="col s12 m8 l6 offset-m2 offset-l3" align="center">
						<form action="" method="post" id="<?php echo $result->id?>">
				        	<!-- <div class="input-field">
				          		<input id="EditNim" value="<?php echo $result->nim?>" name="EditNim" type="text" maxlength="20" >
				          		<label for="nim"><b>Nim</b></label>&nbsp;<span class="error" id="reportNim"></span>
				        	</div>
				        	<div class="input-field">
				          		<input id="EditNama" value="<?php echo $result->nama_mahasiswa?>" name="EditNama" type="text" maxlength="40" >
				          		<label for="nama"><b>Nama</b></label>&nbsp;<span class="error" id="reportNama"></span>
				        	</div> -->
				        	<div class="input-field">
				          		<input id="EditEmail" value="<?php echo $result->email?>" name="EditEmail" type="email" maxlength="100" class="validate" required>
				          		<label for="email">Email</label>&nbsp;<span class="error" id="reportEmail"></span>
				        	</div>
				        	<div class="input-field">
				          		<input id="EditTelepon" value="<?php echo $result->telepon?>" name="EditTelepon" type="text" pattern="[0-9]{1,12}" maxlength="12" class="validate" required>
				          		<label for="telepon">Telepon</label>
				        	</div>
				      		<br/>
				      		<?php echo $result->id?>
				      		<button type="submit" class="waves-effect waves-light btn blue darken-1">Tambah</button>
				      		<a href="" id="<?php echo $result->id ?>" class="edit btn-floating grey tooltipped " data-tooltip="Ubah Dosen" data-delay="1"><i class="material-icons">settings</i></a>
				      	</form>
				      	<br/>
					</div>
				<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var check1=0;

		/*$(".edit").click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			alert(id);
		});

		$("submit").click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			alert(id);
		});*/
		$("form").submit(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			alert(id);
				var formData = new FormData($(this)[0]);
				$.ajax({
					url:'mahasiswa/updateVerif/'+id,
					data:formData,
					type:'POST',
					contentType: false,
					processData: false,
					success:function(data){
						window.location.reload(true);
					}
				});
		});


		/*$("#nip").bind("keyup change","on change", function(){
		var nip = $(this).val();
		$.ajax({
			url:'cekData/dosen/nip/'+nip,
			data:{send:true,value:nip},
			success:function(data){
				if(data==1){
					$("#reportNip").text("");
					check1=1;
					 $('button[type="submit"]').prop('disabled','');
					 $("#username").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nama").prop("disabled", '');
					 $("#email").prop("disabled", '');
					 $("#dosen").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportNip").text("*nip sudah ada");
					check1=0;
					 $('button[type="submit"]').prop('disabled',true);
					 $("#username").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nama").prop("disabled", true);
					 $("#email").prop("disabled", true);
					 $("#dosen").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
		$("#nama").bind("keyup change","on change", function(){
		var nama = $(this).val();
		$.ajax({
			url:'cekData/dosen/nama_dosen/'+nama,
			data:{send:true, value:nama},
			success:function(data){
				if(data==1){
					$("#reportNama").text("");
					 $('button[type="submit"]').prop('disabled','');
					 $("#username").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nip").prop("disabled", '');
					 $("#email").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportNama").text("*nama sudah ada");
					 $('button[type="submit"]').prop('disabled',true);
					 $("#username").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nip").prop("disabled", true);
					 $("#email").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
		$("#email").bind("keyup change","on change", function(){
		var email = $(this).val();
		$.ajax({
			url:'cekData/dosen/email/',
			data:{send:true, value:email},
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
		$("#username").bind("keyup change","on change", function(){
		var username = $(this).val();
		$.ajax({
			url:'cekData/pengguna/username/'+username,
			data:{send:true,value:username},
			success:function(data){
				if(data==1){
					$("#reportUsername").text("");
					check1=1;
					 $('button[type="submit"]').prop('disabled','');
					 $("#nip").prop("disabled", '');
					 $("#password").prop("disabled", '');
					 $("#nama").prop("disabled", '');
					 $("#email").prop("disabled", '');
					 $("#dosen").prop("disabled", '');
					 $("#telepon").prop("disabled", '');
				}else{
					$("#reportUsername").text("*username sudah ada");
					check1=0;
					 $('button[type="submit"]').prop('disabled',true);
					 $("#nip").prop("disabled", true);
					 $("#password").prop("disabled", true);
					 $("#nama").prop("disabled", true);
					 $("#email").prop("disabled", true);
					 $("#dosen").prop("disabled", true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});*/
	});
</script>