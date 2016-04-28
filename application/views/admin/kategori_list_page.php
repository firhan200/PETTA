<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons"></i>&nbsp;KATEGORI
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('kategori/tambah'); ?>">(+) Tambah Kategori</a></li>
					<li class="active"><a href="<?php echo site_url('kategori/data'); ?>">List Kategori</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Hapus Kategori Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Tambah Kategori Berhasil</div>';
					}
				}
				?>
				<table class="table">
					<thead>
						<tr>
							<td>No</td>
							<td>Nama Kategori</td>
							<td>Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($query->num_rows() > 0){
						$no=1;foreach($query->result() as $result){ ?>
							<tr>
								<td width="7%"><?php echo $no; ?></td>
								<td width="30%"><?php echo htmlspecialchars($result->nama_kategori); ?></td>
								<td width="10%">
									<!-- <a class="btn-floating blue tooltipped" data-tooltip="Lihat Kategori" data-delay="1"><i class="material-icons">zoom_in</i></a> -->
									<a href="#modalEdit" id="<?php echo $result->id_kategori ?>" class="edit btn-floating grey tooltipped modal-trigger" data-tooltip="Ubah Kategori" data-delay="1"><i class="material-icons">settings</i></a>
									<a class="del btn-floating red tooltipped" href="<?php echo site_url('kategori/delete/'.$result->id_kategori.''); ?>" class="material-icons" onclick="return confirm('Hapus Kategori?')" data-tooltip="Hapus Kategori" data-delay="1"><i class="material-icons left">clear</i></a>
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
					        <input placeholder="Placeholder" id="EditKategori" name="EditKategori" class="form-control" type="text" class="validate" required="required">
					        <label for="Editkategori">Kategori</label>
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
  	<!-- Edit Modal Structure End -->
<script type="text/javascript">
	$(document).ready(function(){
		var id;
		//GET DATA
		$(".edit").click(function(){
		 id = $(this).attr('id');
			$.ajax({
				url:'getData/'+id,
				data:{send:true},
				success:function(data){
					/*$("#EditmhsNim").val(namaOld);//Tidak usah sesuai urutan yang penting ID nya bener
					$("#EditmhsName").val(data['nameMhs']);//Id buat naro hasil nya, sedangkan yang (data[''])*/
					$("#EditKategori").val(data['nama_kategori']);// di dapet dari controller
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