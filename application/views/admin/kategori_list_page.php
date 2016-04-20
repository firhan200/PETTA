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
									<!-- <a class="del btn-floating red tooltipped" href="#!" id="<?php echo $result->id_kategori; ?>" data-tooltip="Hapus Kategori" data-delay="1"><i class="material-icons">clear</i></a> -->
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
<script type="text/javascript">
	/*$(document).ready(function(){
		$("#nama").bind("keyup change", function(){
		var nama = $(this).val();
		$.ajax({
			url:'kategori/cekData/kategori/nama'+nama,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#report1").text("");
					check1=1;
				}else{
					$("#report1").text("*nama kategori sudah terpakai");
					check1=0;
					}
				}
			});
		});
	
		$("#nama").bind("keyup change", function(){
		var nama = $(this).val();
		$.ajax({
			url:'cekData/kategori/nama'+nama,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#report1").text("");
					check1=1;
				}else{
					$("#report1").text("*nama kategori sudah terpakai");
					check1=0;
					}
				}
			});
		});
	});*/
</script>