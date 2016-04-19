<?php $this->load->view('layouts/nav'); ?>


<?php if ($this->session->userdata("levelpetta")==2){?>
<div class="profile-t blue lighten-1">
<?php } else{?>
<div class="profile-t blue lighten-1" style="margin-bottom: 10px;">
<?php }?>
	<div class="container">
		<div class="row">
			<?php if ($this->session->userdata("levelpetta")==2){?>
			<?php foreach($query->result() as $result){?>
			<div class="col s12 m3 l3" align="center">
				<img style="height: 250px;width: 250px;" class="circle responsive-image profile-img-t" src="<?php echo base_url('assets/img/dosen/'.$result->foto_dosen); ?>">
			</div>
			<?php }?>
			<?php	}else {?>
			<div class="col s12 m3 l3" align="center" ></div>
			<?php }?>
			<div class="col s12 m9 l9 info-t" >
				<?php if ($this->session->userdata("levelpetta")==2){?><!-- DOSEN -->
					<?php foreach($query->result() as $result){?>
						<div style="font-size:18pt;">
							<?php echo $result->nama_dosen;?>
						</div>
						<div style="font-size:18pt;">
							<?php echo $result->email;?>
						</div>	
					<?php }?>
				<?php	}else if($this->session->userdata("levelpetta")==3){?><!-- MAHASISWA -->
					<?php foreach($row->result() as $result){?>
						<div style="font-size:18pt;">
							<?php echo $result->nama_mahasiswa; ?>
						</div>
						<div style="font-size:12pt;">
							<?php echo $result->email; ?>
						</div>
					<?php }?>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<div class="container pad-t" >
	<div class="row">
		<div class="col s12 m4 l3" >
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">account_circle</i>&nbsp;INFORMASI
				</div>
				<ul class="category-t">
				<?php if ($this->session->userdata("levelpetta")==2){?><!-- DOSEN -->
					<?php foreach($query->result() as $result){?>
					<li id="nip_dosen"><?php echo $result->nip?></li>
					<li id="nama_dosen"><?php echo $result->nama_dosen?></li>
					<li id="email_dosen"><?php echo $result->email?></li>
					<li id="telepon_dosen"><?php echo $result->telepon?></li>
					
					<?php }?>
					
				<?php	}else if($this->session->userdata("levelpetta")==3){?><!-- MAHASISWA -->
					<?php foreach($row->result() as $result){?>
					<li id="nim_mhs"><?php echo $result->nim;?></li>
					<li id="nama_mhs"><?php echo $result->nama_mahasiswa; ?></li>
					<li id="email_mhs"><?php echo $result->email; ?></li>
					<li id="telepon_mhs"><?php echo $result->telepon; ?></li>
					
					<?php }?>
					
				<?php }?>
				</ul>
				
				<div align="right">
					<!-- DOSEN -->
					<?php if ($this->session->userdata("levelpetta")==2){?>
						<a href="#modalEdit" class="edit waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">settings</i>&nbsp;ubah</a>

						<a href="#modalUpload" class="upload waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">assignment_ind</i>&nbsp;Upload</a>

					<!-- MAHASISWA -->
					<?php	}else if($this->session->userdata("levelpetta")==3){?>
					<a href="#modalEdit" class="edit waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">settings</i>&nbsp;ubah</a>
					<?php }?>
				</div>
			</div>
		</div>
		<div class="col s12 m8 l9">
			<?php foreach($query1->result() as $result){ ?>
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							<a href="#" class="notif-t"><?php echo htmlspecialchars($result->nama_mahasiswa); ?></a> meminati tema TA 
							<a href="<?php echo site_url('tema/detil/'.$result->id_tema.''); ?>" class="notif-t"><?php if(strlen(htmlspecialchars($result->judul)) < 50){ echo htmlspecialchars($result->judul); }else{ echo substr(htmlspecialchars($result->judul), 0, 50).'...'; } ?></a>
						</div>
						<div class="col s3" align="right">
							<?php echo tgl(date("Y-m-d", strtotime($result->waktu_peminatan))).", ".date("H:i", strtotime($result->waktu_peminatan));?>
						</div>
					</div>
				</div>
			</a>
			<?php } ?>
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
  	
  	<!-- Upload Modal Structure Start -->
    <div id="modalUpload" class="modal" style="width: 40%; height: auto">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  				 <i class="medium material-icons prefix">assignment_ind</i>
  					<h4 class="modal-title"> Upload Foto</h4>
  				</div>
  				<div class="modal-body">
					<form action="upload" id="tambahFormUpload" method="post" enctype="multipart/form-data">
					<?php echo validation_errors(); ?>
						<div class="file-field input-field">
						    <div class="btn">
						        <span>File</span>
						    	<input type="file" name="userfile" accept=".png,.jpg,.gif,.jpeg">
						    </div>
						    <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						    </div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" >Simpan</button>
						</div>	
					</form>
				</div>
  			</div>	
  		</div>
  	</div>
  	<!-- Upload Modal Structure End -->
  	<?php
function tgl($date){
  list($year, $month, $day) = explode('-', $date);
  switch ($month) {
        case "1" : $month="Januari";break;
        case "2" : $month="Februari";break;
        case "3" : $month="Maret";break;
        case "4" : $month="April";break;
        case "5" : $month="Mei";break;
        case "6" : $month="Juni";break;
        case "7" : $month="Juli";break;
        case "8" : $month="Agustus";break;
        case "9" : $month="September";break;
        case "10" : $month="Oktober";break;
        case "11" : $month="November";break;
        case "12" : $month="Desember";break;
    }
    return $day." ".$month." ".$year;
}

?>
<script type="text/javascript">
	$(document).ready(function(){
		var id;var id1;

		//GET DATA
		$(".edit").click(function(){
		 id = $(this).attr('id');
			$.ajax({
				url:'profil/getData/'+id,
				data:{send:true},
				success:function(data){
					/*$("#EditmhsNim").val(namaOld);//Tidak usah sesuai urutan yang penting ID nya bener
					$("#EditmhsName").val(data['nameMhs']);//Id buat naro hasil nya, sedangkan yang (data[''])*/
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
					url:'Profil/update/'+id,
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
		//UPLOAD FORM
		$('.upload').click(function(){
			id1 = $(this).attr('id');
		});
		$('#tambahFormUpload').submit(function(e){
			e.preventDefault();
			var formData = new FormData($(this)[0]);
			$.ajax({
				url:'Profil/Upload/'+id1,
				data:formData,
				type:'POST',
				contentType: false,
				processData: false,
				success:function(data){
					$("#modalUpload").hide();
					window.location.reload(true);
				}
			});
		});
		
	});
</script>