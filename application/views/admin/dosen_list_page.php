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
									<a class="btn-floating blue tooltipped" data-tooltip="Lihat Dosen" data-delay="1"><i class="material-icons">zoom_in</i></a>
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
					        <input placeholder="Placeholder" id="EditNip" name="EditNip" class="form-control" type="text" class="validate" required="required">
					        <label for="Editmhs_nim">Nip</label>
				        </div>
				        <div class="form-group input-field col s12">
					        <input placeholder="Placeholder" id="EditNama" name="EditNama" class="form-control" type="text" class="validate" required="required">
					        <label for="Editmhs_nama">Nama</label>
				        </div>
				        <div class="form-group input-field col s12">
					        <input placeholder="Placeholder" id="EditEmail" name="EditEmail" class="form-control" type="text" class="validate" required="required">
					        <label for="Editmhs_email">Email</label>
				        </div>
						<div class="form-group input-field col s12">
					        <input placeholder="Placeholder" id="EditTelepon" name="EditTelepon" class="form-control" type="number" class="validate" required="required">
					        <label for="Editmhs_telepon">telepon</label>
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
					$("#EditNip").val(data['nip']);// di dapet dari controller
					$("#EditNama").val(data['nama_dosen']);// di dapet dari controller
					$("#EditEmail").val(data['email']);// di dapet dari controller
					$("#EditTelepon").val(data['telepon']);
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
	});
</script>