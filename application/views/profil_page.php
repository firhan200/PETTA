<?php $this->load->view('layouts/nav'); ?>
<?php if ($this->session->userdata("levelpetta")==2){?>
<div class="profile-t blue lighten-1">
<?php } else{?>
<div class="profile-t blue lighten-1" style="margin-bottom: 10px;">
<?php }?>
	<div class="container">
		<div class="row">
			<?php if ($level==2){?>
			<?php foreach($query->result() as $result){?>
			<div class="col s12 m3 l3" align="center">
				<?php if($result->foto_dosen!=null){ ?><!--Setting Photo Whether it's exist or not -->
				<img style="height: 250px;width: 250px;" class="circle responsive-image profile-img-t" src="<?php echo base_url('assets/img/dosen/'.$result->foto_dosen); ?>">
				<?php }else{ ?>
				<img style="height: 250px;width: 250px;" class="circle responsive-image profile-img-t" src="<?php echo base_url('assets/img/dosen/noava.png'); ?>">
				<?php } ?>
			</div>
			<?php }?>
			<?php	}else {?>
			<div class="col s12 m3 l3" align="center"></div>
			<?php }?>
			<div class="col s12 m9 l9 info-t">
				<?php if ($level==2){?><!-- DOSEN -->
					<?php foreach($query->result() as $result){?>
						<div style="font-size:18pt;">
							<?php echo $result->nama_dosen;?>
						</div>
						<div style="font-size:18pt;">
							<?php echo $result->email;?>
						</div>	
					<?php }?>
				<?php	}else if($level==3){?><!-- MAHASISWA -->
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
<div class="container pad-t" style="margin-top:100px">
	<div class="row">
		<div class="col s12 m4 l3" >
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">account_circle</i>&nbsp;INFORMASI
				</div>
				<ul class="category-t">
				<?php if ($level==2){?><!-- DOSEN -->
					<?php foreach($query->result() as $result){?>
					<li id="nip_dosen"><?php echo $result->nip?></li>
					<li id="nama_dosen"><?php echo $result->nama_dosen?></li>
					<li id="email_dosen"><?php echo $result->email?></li>
					<li id="telepon_dosen"><?php echo $result->telepon?></li>	
					<?php }?>	
				<?php	}else if($level==3){?><!-- MAHASISWA -->
					<?php foreach($row->result() as $result){?>
					<li id="nim_mhs"><?php echo $result->nim;?></li>
					<li id="nama_mhs"><?php echo $result->nama_mahasiswa; ?></li>
					<li id="email_mhs"><?php echo $result->email; ?></li>
					<li id="telepon_mhs"><?php echo $result->telepon; ?></li>	
					<?php }?>	
				<?php }?>
				</ul>	
				<div align="right">
					<?php if($self==1){ ?>
						<a href="#modalPassword" class="pass waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">lock</i>&nbsp;ubah password</a>
						<!-- DOSEN -->
						<?php if ($level==2){?>
							<a href="#modalEdit" class="edit waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">settings</i>&nbsp;ubah</a>

							<a href="#modalUpload" class="upload waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">assignment_ind</i>&nbsp;Upload</a>

						<!-- MAHASISWA -->
						<?php	}else if($level==3){?>
						<a href="#modalEdit" class="edit waves-effect waves-light modal-trigger" id="<?php echo $result->id ?>"><i class="material-icons tiny">settings</i>&nbsp;ubah</a>
						<?php }?>
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
							<a href="<?php echo site_url('profil/index/'.$result->id_mahasiswa.''); ?>" class="notif-t"><?php echo htmlspecialchars($result->nama_mahasiswa); ?></a> meminati tema TA 
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
  					<h4 class="modal-title"> Ubah Informasi</h4>&nbsp;<span class="error" id="reportEmail"></span>
  				</div>
  				<div class="modal-body">
					<form action="edit" id="editform" method="post" enctype="multipart/form-data">
						<div class="form-group input-field col s12">
					        <input placeholder="Placeholder" id="EditEmail" name="EditEmail" class="form-control" type="email" class="validate" required="required">
					        <label for="Editmhs_email">Email</label>
				        </div>
						<div class="form-group input-field col s12">
					        <input placeholder="Placeholder" id="EditTelepon" pattern="[0-9]{1,12}" maxlength="12" name="EditTelepon" class="form-control" type="text" class="validate" required="required">
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

  	<!-- password Modal Structure Start -->
    <div id="modalPassword" class="modal" style="width: 40%;">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  				 <i class="medium material-icons prefix">lock</i>
  					<h4 class="modal-title"> Ubah Password</h4>
  				</div>
  				<div class="modal-body">
					<form id="passform">
						<div class="error" align="center" id="reportpass"></div>
						<div class="input-field">
					        <input id="oldpass" name="oldpass" type="password" class="validate" required="required">
					        <label for="oldpass">Password Lama <span class="error" id="reportpass1"></span></label>
				        </div>
						<div class="input-field">
					        <input id="newpass" name="newpass" type="password" class="validate" required="required">
					        <label for="newpass">Password Baru <span class="error" id="reportpass2"></span></label>
				        </div>
				        <div class="input-field">
					        <input id="confirmnewpass" name="confirmnewpass" type="password" class="validate" required="required">
					        <label for="confirmnewpass">Ulangi Password Baru <span class="error" id="reportpass3"></span></label>
				        </div>
						<div class="modal-footer">
							<button type="submit" id="btn_pass" class="btn waves-effect">Simpan</button>
						</div>				
					</form>
				</div>
  			</div>	
  		</div>
  	</div>
  	<!-- password Modal Structure End -->
  	
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
		$("#btn_pass").prop('disabled', true);
		//ubah password
		$("#newpass").bind('keyup change', function(){
			var newpass = $(this).val();
			var confirmnewpass = $("#confirmnewpass").val();
			if(newpass.length < 6){
				$("#btn_pass").prop('disabled', true);
				$("#reportpass2").text("*password minimal 6 karakter");
			}else{
				$("#btn_pass").prop('disabled', false);
				is_same(newpass, confirmnewpass);
				$("#reportpass2").text("");
			}
		});
		$("#confirmnewpass").bind('keyup change', function(){
			var confirmnewpass = $(this).val();
			var newpass = $("#newpass").val();
			is_same(newpass, confirmnewpass);
		});
		$("#passform").submit(function(e){
			var formData = new FormData($(this)[0]);
			$.ajax({
				url:'pengguna/ubahPassword',
				data:formData,
				type:'POST',
				contentType: false,
				processData: false,
				success:function(data){
					if(data==1){
						$("#reportpass").text("");
						alert('Berhasil merubah password');
						$('#modalPassword').closeModal();
						$("#oldpass").val('');
						$("#newpass").val('');
						$("#confirmnewpass").val('');
					}else if(data==2){
						$("#reportpass").text("*Password lama salah");
					}else if(data==3){
						$("#reportpass").text("*Password dan Ulangi Password tidak sama");
					}else if(data==4){
						$("#reportpass").text("*Terjadi kesalahan, gagal merubah password");
					}
				}
			});
			return false;
		});
		function is_same(newpass, confirmpass){
			if(newpass!=confirmpass){
				$("#btn_pass").prop('disabled', true);
				$("#reportpass3").text("*password tidak sama");
			}else{
				$("#btn_pass").prop('disabled', false);
				$("#reportpass3").text("");
			}
		}

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
		$("#EditEmail").bind("keyup change","on change", function(){
		var email = $(this).val();
		$.ajax({
			url:'profil/cekData/email/',
			data:{send:true, value:email},
			success:function(data){
				if(data==1){
					$("#reportEmail").text("");
					$('button[type="submit"]').prop('disabled','');
					$("#telepon").prop("disabled", '');
				}else{
					$("#reportEmail").text("*email sudah ada");
					 $('button[type="submit"]').prop('disabled',true);
					 $("#telepon").prop("disabled", true);
					}
				}
			});
		});
	});
</script>