<?php $this->load->view('layouts/nav'); ?>
<div class="profile-t blue lighten-1">
	<div class="container">
		<div class="row">
			<div class="col s12 m3 l3" align="center">
				<img class="circle responsive-image profile-img-t" src="<?php echo base_url('assets/img/dosen/noava.png'); ?>">
			</div>
			<div class="col s12 m9 l9 info-t">
				<div style="font-size:18pt;">
					<?php echo $row->nama_mahasiswa; ?>
				</div>
				<div style="font-size:12pt;">
					<?php echo $row->email; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">account_circle</i>&nbsp;INFORMASI
				</div>
				<ul class="category-t">
					<li><?php echo $row->nim;?></li>
					<li><?php echo $row->nama_mahasiswa; ?></li>
					<li><?php echo $row->email; ?></li>
					<li><?php echo $row->telepon; ?></li>
				</ul>
				<div align="right">
				<!-- <a href="#"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editModal">Ubah</button></a> -->
					<a href="#modal1" class="waves-effect waves-light modal-trigger"><i class="material-icons tiny">settings</i>&nbsp;ubah</a>
					<a href="#modalUpload" class="waves-effect waves-light modal-trigger"><i class="material-icons tiny">assignment_ind</i>&nbsp;Upload</a>
				</div>
			</div>
		</div>
		<div class="col s12 m8 l9">
			<?php for($i=1;$i<=5;$i++){ ?>
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							Anda meminati tema TA <b>Pembuatan Sistem Pendeteksi Meno-pause dengan metode Jaringa...</b>
						</div>
						<div class="col s3" align="right">
							23 Mar 2016, 10:42
						</div>
					</div>
				</div>
			</a>
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							Anda mengirim pesan ke <b>Firhan, S.KOM</b>
						</div>
						<div class="col s3" align="right">
							23 Mar 2016, 10:42
						</div>
					</div>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
</div>

	<!-- Edit Modal Structure Start -->
    <div id="modal1" class="modal" style="width: 40%;">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  				 <i class="medium material-icons prefix">account_circle</i>
  					<h4 class="modal-title"> Ubah Informasi</h4>
  				</div>
  				<div class="modal-body">
					<form action="edit" id="editform" method="post" enctype="multipart/form-data">
						<div class="form-group input-field col s12">
							<label>Nama </label><span class="error" id="editreport1"></span>
							<input type="text" id="editNama" name="ubahNama" class="form-control" maxlength="100" required>
						</div>
						<div class="form-group input-field col s12">
							<label>E-mail </label><span class="error" id="editreport1"></span>
							<input type="text" id="editEmail" name="ubahEmail" class="form-control" maxlength="100" required>
						</div>
						<div class="form-group input-field col s12">
							<label>Telephone </label><span class="error" id="editreport1"></span>
							<input type="text" id="editTelephone" name="ubahTelephone" class="form-control" maxlength="100" required>
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
					<form action="edit" id="editForm" method="post" enctype="multipart/form-data">
						<div class="file-field input-field">
						    <div class="btn">
						        <span>File</span>
						    	<input type="file">
						    </div>
						    <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						    </div>
						</div>
					</form>
				</div>
  			</div>	
  		</div>
  	</div>
  	<!-- Upload Modal Structure End -->