<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">people</i>&nbsp;MAHASISWA
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('mahasiswa/tambah'); ?>">(+) Tambah Mahasiswa</a></li>
					<li class="active"><a href="<?php echo site_url('mahasiswa/data'); ?>">List Mahasiswa</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Tambah Mahasiswa Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Hapus Mahasiswa Berhasil</div>';
					}else if($this->input->get('balasan')==3){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Update Mahasiswa Berhasil</div>';
					}
				}
				?>
				<table class="table">
					<thead>
						<tr>
							<td>No</td>
							<td>NIM</td>
							<td>Nama</td>
							<td>Peminatan</td>
							<td>Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($query->num_rows() > 0){
						$no=1;foreach($query->result() as $result){ ?>
							<tr>
								<td width="7%"><?php echo $no; ?></td>
								<td width="30%"><?php echo htmlspecialchars($result->nim); ?></td>
								<td width="30%"><?php echo htmlspecialchars($result->nama_mahasiswa); ?></td>
								<td width="10%"><?php getTotalPeminatan($result->id_pengguna); ?></td>
								<td width="15%">
									<a href="#infoModal" id="<?php echo $result->id ?>" class="info btn-floating blue tooltipped modal-trigger" data-tooltip="Lihat Mahasiswa" data-delay="1"><i class="material-icons">zoom_in</i></a>
									<a href="#modalEdit" id="<?php echo $result->id ?>" class="edit btn-floating grey tooltipped modal-trigger" data-tooltip="Ubah Mahasiswa" data-delay="1"><i class="material-icons">settings</i></a>
									<a class="del btn-floating red tooltipped" href="<?php echo site_url('mahasiswa/delete/'.$result->id_pengguna.''); ?>" class="material-icons" onclick="return confirm('Hapus Mahasiswa?')" data-tooltip="Hapus Mahasiswa" data-delay="1"><i class="material-icons left">clear</i></a>
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

<div id="modalEdit" class="modal" style="width: 40%;height: auto;">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  			 <i class="medium material-icons prefix">account_circle</i>
  				<h4 class="modal-title"> Ubah Informasi</h4>
  			</div>
  			<div class="modal-body">
				<form action="edit" id="editform" method="post" enctype="multipart/form-data">
					<div class="form-group input-field col s12">
				        <input placeholder="Placeholder" id="EditNim" name="EditNim" class="form-control" type="text" class="validate" required="required">
				        <label for="Editmhs_nim">Nim</label>&nbsp;<span class="error" id="reportNim"></span>
			        </div>
			        <div class="form-group input-field col s12">
				        <input placeholder="Placeholder" id="EditNama" name="EditNama" class="form-control" type="text" class="validate" required="required" pattern="[a-z,A-Z]{6,40}">
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
<div id="infoModal" class="modal" role ="modal" style="width: 40%;height: auto;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<i class="medium material-icons prefix">account_circle</i>
				<h3 class="modal-title"><span class="glyphicon glyphicon-eye-open"></span> Info Mahasiswa</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label style="font-size: 16px;font-weight: bold;color: black">Nim</label>
					<div id="infoNim"></div>
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
function getTotalPeminatan($id){
	$ci =& get_instance();
	$q = "SELECT * FROM peminatan WHERE id_pengguna=".$id."";
	$query = $ci->db->query($q);
	echo $query->num_rows();
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id;var id1;var editCheck;
		//GET DATA
		$(".edit").click(function(){
		 id = $(this).attr('id');
			$.ajax({
				url:'getData/'+id,
				data:{send:true},
				success:function(data){
					/*$("#EditmhsNim").val(namaOld);//Tidak usah sesuai urutan yang penting ID nya bener
					$("#EditmhsName").val(data['nameMhs']);//Id buat naro hasil nya, sedangkan yang (data[''])*/
					nimOld = data['nim'];
					namaOld = data['nama_mahasiswa'];
					emailOld = data['email'];
					teleponOld = data['telepon'];
					$("#EditNim").val(nimOld);// di dapet dari controller
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
		$("#EditNim").bind("keyup change", function(){
			var nim = $(this).val();
			$.ajax({
				url:'cekDataEdit/mahasiswa/nim/'+nim+'/'+nimOld,
				data:{send:true, value:nim},
				success:function(data){
					if(data==1){
						$("#reportNim").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNama").prop("disabled", '');
						 $("#EditEmail").prop("disabled", '');
						 $("#EditTelepon").prop("disabled", '');
					}else{
						$("#reportNim").text("*nim sudah ada");
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
				url:'cekDataEdit/mahasiswa/nama_mahasiswa/'+nama+'/'+namaOld,
				data:{send:true, value:nama},
				success:function(data){
					if(data==1){
						$("#reportNama").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNim").prop("disabled", '');
						 $("#EditEmail").prop("disabled", '');
						 $("#EditTelepon").prop("disabled", '');
					}else{
						$("#reportNama").text("*nama sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNim").prop("disabled", true);
						 $("#EditEmail").prop("disabled", true);
						 $("#EditTelepon").prop("disabled", true);
					}
				}
			});
		});
		$("#EditEmail").bind("on change", function(){
			var email = $(this).val();
			$.ajax({
				url:'cekDataEdit/mahasiswa/email/',
				data:{send:true, value:email},
				success:function(data){
					if(data==1){
						$("#reportEmail").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNim").prop("disabled", '');
						 $("#EditNama").prop("disabled", '');
						 $("#EditTelepon").prop("disabled", '');
						 editCheck=1;
					}else{
						$("#reportEmail").text("*email sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNim").prop("disabled", true);
						 $("#EditNama").prop("disabled", true);
						 $("#EditTelepon").prop("disabled", true);
						 editCheck=0;
					}
				}
			});
		});$("#EditTelepon").bind("on change", function(){
			var telepon = $(this).val();
			$.ajax({
				url:'cekData/mahasiswa/telepon/'+telepon,
				data:{send:true, value:telepon},
				success:function(data){
					if(data==1){
						$("#reportTelepon").text("");
						 $('button[type="submit"]').prop('disabled','');
						 $("#EditNim").prop("disabled", '');
						 $("#EditNama").prop("disabled", '');
						 $("#EditEmail").prop("disabled", '');
						 editCheck=1;
					}else{
						$("#reportTelepon").text("*telepon sudah ada");
						 $('button[type="submit"]').prop('disabled',true);
						 $("#EditNim").prop("disabled", true);
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
					$("#infoNim").text(data['nim']);
					$("#infoNama").text(data['nama_mahasiswa']);
					$("#infoEmail").text(data['email']);
					$("#infoTelepon").text(data['telepon']);	
				}
			});
		});
	});
</script>