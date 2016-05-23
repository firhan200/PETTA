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
				        	<div class="input-field">
				          		<input id="EditEmail" value="<?php echo $result->email?>" name="EditEmail" type="email" maxlength="100" class="validate" required>
				          		<label for="email">Email</label>&nbsp;<span class="error" id="reportEmail"></span>
				        	</div>
				        	<div class="input-field">
				          		<input id="EditTelepon" value="<?php echo $result->telepon?>" name="EditTelepon" type="text" pattern="[0-9]{1,12}" maxlength="12" class="validate" required>
				          		<label for="telepon">Telepon</label>
				        	</div>
				      		<br/>
				      		<button type="submit" class="waves-effect waves-light btn blue darken-1">Tambah</button>
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
		$("form").submit(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
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

	});
</script>