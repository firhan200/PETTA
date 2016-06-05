<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">person</i>&nbsp;DOSEN
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('dosen/tambah'); ?>">(+) Tambah Dosen</a></li>
					<li class="active"><a href="<?php echo site_url('dosen/data'); ?>">List Dosen</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Tambah Dosen Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Hapus Dosen Berhasil</div>';
					}else if($this->input->get('balasan')==3){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Update Mahasiswa Berhasil</div>';
					}
				}
				?>
				<table class="table">
					<thead>
						<tr>
							<td>No</td>
							<td>NIP</td>
							<td>Nama</td>
							<td>Tema</td>
							<td>Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($query->num_rows() > 0){
						$no=1;foreach($query->result() as $result){ ?>
							<tr>
								<td width="7%"><?php echo $no; ?></td>
								<td width="30%"><?php echo htmlspecialchars($result->nip); ?></td>
								<td width="30%"><?php echo htmlspecialchars($result->nama_dosen); ?></td>
								<td width="10%"><?php getTotalTema($result->id_pengguna); ?></td>
								<td width="15%">
									<a href="#infoModal" id="<?php echo $result->id ?>" class="info btn-floating blue tooltipped modal-trigger" data-tooltip="Lihat Dosen" data-delay="1"><i class="material-icons">zoom_in</i></a>
									<a href="#modalEdit" id="<?php echo $result->id ?>" class="edit btn-floating grey tooltipped modal-trigger" data-tooltip="Ubah Dosen" data-delay="1"><i class="material-icons">settings</i></a>
									<a class="del btn-floating red tooltipped" href="<?php echo site_url('dosen/delete/'.$result->id_pengguna.''); ?>" class="material-icons" onclick="return confirm('Hapus Dosen?')" data-tooltip="Hapus Dosen" data-delay="1"><i class="material-icons left">clear</i></a>
								</td>
							</tr>
				    	<?php 
				    	$no++;}
				    	}else{
				    		echo '<center><i class="material-icons tiny">error</i>Tidak ada Data</center>';
				    	} ?>
				    </tbody>
		    	</table>
			</div>
		</div>
	</div>
</div>
<!-- Edit Modal Structure Start -->
<div id="modalEdit" class="modal" style="width: 40%;">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  			 <i class="medium material-icons prefix">account_circle</i>
  				<h4 class="modal-title"> Ubah Informasi</h4>
  			</div>
  			<div class="modal-body">
				<form action="edit" id="editform" method="post" enctype="multipart/form-data">
					<div class="form-group input-field col s12">
				        <input placeholder="Placeholder" id="EditNip" maxlength="20" name="EditNip" class="form-control" type="text" class="validate" required="required">
				        <label for="Editmhs_nim">Nip</label>&nbsp;<span class="error" id="reportNip"></span>
			        </div>
			        <div class="form-group input-field col s12">
				        <input placeholder="Placeholder" id="EditNama" name="EditNama" maxlength="20" class="form-control" type="text" class="validate" required="required" pattern="[a-z,A-Z]{1,40}">
				        <label for="Editmhs_nama">Nama</label>&nbsp;<span class="error" id="reportNama"></span>
			        </div>
			        <div class="form-group input-field col s12">
				        <input placeholder="Placeholder" id="EditEmail" name="EditEmail" class="form-control" type="text" class="validate" required="required">
				        <label for="Editmhs_email">Email</label>&nbsp;<span class="error" id="reportEmail"></span>
			        </div>
					<div class="form-group input-field col s12">
				        <input placeholder="Placeholder" id="EditTelepon" name="EditTelepon" class="form-control" type="number" class="validate" required="required">
				        <label for="Editmhs_telepon">telepon</label>&nbsp;<span class="error" id="reportTelepon"></span>
			        </div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" >Simpan</button>
					</div>				
				</form>
			</div>
  		</div>	
  	</div>
</div>
<!-- Edit Modal Structure End -->
<!-- Info Modal -->
<div id="infoModal" class="modal" role ="modal" style="width: 40%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<i class="medium material-icons prefix">account_circle</i>
				<h3 class="modal-title"><span class="glyphicon glyphicon-eye-open"></span> Info Dosen</h3>
			</div>
			<div class="modal-body">
				<center><div id="infofoto" alt="$result->foto_dosen"></div></center>
				<div class="form-group">
					<label style="font-size: 16px;font-weight: bold;color: black">Nip</label>
					<div id="infoNip"></div>
					<label style="font-size: 16px;font-weight: bold;color: black">Nama</label>
					<div id="infoNama"></div>
					<label style="font-size: 16px;font-weight: bold;color: black">Email</label>
					<div id="infoEmail"></div>
					<label style="font-size: 16px;font-weight: bold;color: black">Telepon</label>
					<div id="infoTelepon"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Info Modal end -->

<?php
function getTotalTema($id){
	$ci =& get_instance();
	$q = "SELECT * FROM tema T WHERE T.id_pengguna=".$id."";
	$query = $ci->db->query($q);
	echo $query->num_rows();
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id;var id1;

		//GET DATA
		$(".edit").click(function(){
		 id = $(this).attr('id');
			$.ajax({
				url:'getData/'+id,
				data:{send:true},
				success:function(data){
					/*$("#EditmhsNim").val(namaOld);//Tidak usah sesuai urutan yang penting ID nya bener
					$("#EditmhsName").val(data['nameMhs']);//Id buat naro hasil nya, sedangkan yang (data[''])*/
					nipOld= data['nip'];
					namaOld =data['nama_dosen'];
					emailOld =data['email'];
					teleponOld = data['telepon'];
					$("#EditNip").val(nipOld);// di dapet dari controller
					$("#EditNama").val(namaOld);// di dapet dari controller
					$("#EditEmail").val(emailOld);// di dapet dari controller
					$("#EditTelepon").val(teleponOld);
				}
			});
		});
		//EDIT FORM
		$("#editform").submit(function(e){
				e.preventDefault();
				var formData = new FormData($(this)[0]);
				$.ajax({
					url:'update/'+id,
					data:formData,
					type:'POST',
					contentType: false,
					processData: false,
					success:function(data){
						$("#modalEdit").hide();
						window.location.reload(true);
					}
				});
		});
		$("#EditNip").bind("keyup change", function(){
			var nip = $(this).val();
			$.ajax({
				url:'cekDataEdit/dosen/nip/'+nip+'/'+nipOld,
				data:{send:true, value:nip},
				success:function(data){
					if(data==1){
						$("#reportNip").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNama").prop("disabled", '');
						 $("#EditEmail").prop("disabled", '');
						 $("#EditTelepon").prop("disabled", '');
					}else{
						$("#reportNip").text("*nim sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNama").prop("disabled", true);
						 $("#EditEmail").prop("disabled", true);
						 $("#EditTelepon").prop("disabled", true);
					}
				}
			});
		});
		$("#EditNama").bind("on change", function(){
			var nama = $(this).val();
			$.ajax({
				url:'cekDataEdit/dosen/nama_dosen/'+nama+'/'+namaOld,
				data:{send:true, value:nama},
				success:function(data){
					if(data==1){
						$("#reportNama").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNip").prop("disabled", '');
						 $("#EditEmail").prop("disabled", '');
						 $("#EditTelepon").prop("disabled", '');
					}else{
						$("#reportNama").text("*nama sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNip").prop("disabled", true);
						 $("#EditEmail").prop("disabled", true);
						 $("#EditTelepon").prop("disabled", true);
					}
				}
			});
		});
		$("#EditEmail").bind("on change", function(){
			var email = $(this).val();
			$.ajax({
				url:'cekDataEdit/dosen/email/',
				data:{send:true, value:email},
				success:function(data){
					if(data==1){
						$("#reportEmail").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNip").prop("disabled", '');
						 $("#EditNama").prop("disabled", '');
						 $("#EditTelepon").prop("disabled", '');
						 editCheck=1;
					}else{
						$("#reportEmail").text("*email sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNip").prop("disabled", true);
						 $("#EditNama").prop("disabled", true);
						 $("#EditTelepon").prop("disabled", true);
						 editCheck=0;
					}
				}
			});
		});$("#EditTelepon").bind("on change", function(){
			var telepon = $(this).val();
			$.ajax({
				url:'cekData/dosen/telepon/'+telepon,
				data:{send:true, value:telepon},
				success:function(data){
					if(data==1){
						$("#reportTelepon").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNip").prop("disabled", '');
						 $("#EditNama").prop("disabled", '');
						 $("#EditEmail").prop("disabled", '');
						 editCheck=1;
					}else{
						$("#reportTelepon").text("*telepon sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNip").prop("disabled", true);
						 $("#EditNama").prop("disabled", true);
						 $("#EditEmail").prop("disabled", true);
						 editCheck=0;
					}
				}
			});
		});
		$(".info").click(function(){
			id = $(this).attr('id');
			$.ajax({
				url:'getData/'+id,
				data:{send:true},
				success:function(data){
					$("#infoNip").text(data['nip']);
					$("#infoNama").text(data['nama_dosen']);
					$("#infoEmail").text(data['email']);
					$("#infoTelepon").text(data['telepon']);
					$("#infofoto").html(data['foto_dosen']);
					/*if(($result->foto_dosen)!=null){
						$("#infofoto").html(data['foto_dosen']);
					}else if (($result->foto_dosen)==null){
						$(#infofoto).attr('src','/assets/img/dosen/noava.png' );
					}*/
								
				}
			});
		});
	});
</script>