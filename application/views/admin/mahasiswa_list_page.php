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
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Hapus Tema Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Hapus Tema Gagal</div>';
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
									<a class="btn-floating blue tooltipped" data-tooltip="Lihat Mahasiswa" data-delay="1"><i class="material-icons">zoom_in</i></a>
									<a class="btn-floating grey tooltipped" data-tooltip="Ubah Mahasiswa" data-delay="1"><i class="material-icons">settings</i></a>
									<a class="del btn-floating red tooltipped" href="#!" id="<?php echo $result->id_pengguna; ?>" data-tooltip="Hapus Mahasiswa" data-delay="1"><i class="material-icons">clear</i></a>
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
<?php
function getTotalPeminatan($id){
	$ci =& get_instance();
	$q = "SELECT * FROM peminatan WHERE id_pengguna=".$id."";
	$query = $ci->db->query($q);
	echo $query->num_rows();
}
?>