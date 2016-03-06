<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">email</i>&nbsp;PESAN
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('pesan/pesan_baru'); ?>">(+) Tulis Pesan</a></li>
					<li <?php if(isset($submenu2)) echo 'class=active'; ?>><a href="<?php echo site_url('pesan'); ?>">Kotak Masuk <span class="badge-t">1 baru</span></a></li>
					<li <?php if(isset($submenu3)) echo 'class=active'; ?>><a href="<?php echo site_url('pesan/pesan_keluar'); ?>">Kotak Keluar</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<table class="table highlight">
					<thead>
						<tr>
							<td width="5%">No</td>
							<td width="30%"><?php if(isset($submenu2)){
								if($submenu2==true){
									echo 'Pengirim';
								}
							}else{
								if($submenu3==true){
									echo 'Penerima';
								}
							} ?></td>
							<td width="30%">Pesan</td>
							<td width="20%">Tanggal</td>
							<td width="25%">Aksi</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($query->num_rows() > 0){
							$i=1;foreach($query->result() as $result){ 
							?>
							<tr>
								<td><?php echo $i; ?>.</td>
								<td><?php echo getData($result->level, $result->id_penerima, $result->id_pengirim, $this->session->userdata('levelpetta')); ?></td>
								<td><?php if(strlen(htmlspecialchars($result->pesan)) < 30){ echo htmlspecialchars($result->pesan); }else{ echo substr(htmlspecialchars($result->pesan), 0, 32).'...'; } ?></td>
								<td><?php echo date("d ", strtotime($result->tanggal)).$date[date("m", strtotime($result->tanggal))].date(" Y, H:i", strtotime($result->tanggal)); ?></td>
								<td>
									<a class="btn-floating blue tooltipped" data-tooltip="Lihat Pesan" data-delay="1" href="<?php echo site_url('pesan/detil/'.getId($result->level, $result->id_penerima, $result->id_pengirim, $this->session->userdata('levelpetta')).''); ?>"><i class="material-icons">zoom_in</i></a>
									<a class="del btn-floating red tooltipped" href="#!" id="<?php echo $result->id_pesan; ?>" data-tooltip="Hapus Pesan" data-delay="1"><i class="material-icons">clear</i></a>
								</td>
							</tr>
							<?php 
							$i++; } 
						}else{
							echo '<tr><td colspan="5"><center><i class="material-icons tiny">error</i> Tidak Ada Pesan</center></td></tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.del').click(function(){
		var r = confirm("Hapus Pesan?");
		if (r == true) {
		    var id = $(this).attr('id');
			var host = location.protocol + '//' + location.host + '/';
			$.ajax({
				url:host+'PETTA/pesan/hapus/'+id,
				data:{},
				success:function(data){
					if(data==1){
						alert('Pesan berhasil di Hapus');
						setTimeout(function() { location.reload(); }, 1000);
					}else if(data==2){
						alert('Pesan Gagal di Hapus');
					}
				}
			});
		} else {
		}
	});
});
</script>
<?php
function getData($level, $id_penerima, $id_pengirim, $levelpetta){
	$ci =& get_instance();
	if($level!=$levelpetta){
		if($levelpetta==2){
			$q = "SELECT * FROM mahasiswa WHERE id_pengguna=".$id_pengirim."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->nama_mahasiswa;
			}
		}else{
			$q = "SELECT * FROM dosen WHERE id_pengguna=".$id_pengirim."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->nama_dosen;
			}
		}
	}else{
		if($levelpetta==2){
			$q = "SELECT * FROM mahasiswa WHERE id_pengguna=".$id_penerima."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->nama_mahasiswa;
			}
		}else{
			$q = "SELECT * FROM dosen WHERE id_pengguna=".$id_penerima."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->nama_dosen;
			}
		}
	}
}
function getId($level, $id_penerima, $id_pengirim, $levelpetta){
	$ci =& get_instance();
	if($level!=$levelpetta){
		if($levelpetta==2){
			$q = "SELECT * FROM mahasiswa WHERE id_pengguna=".$id_pengirim."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->id_pengguna;
			}
		}else{
			$q = "SELECT * FROM dosen WHERE id_pengguna=".$id_pengirim."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->id_pengguna;
			}
		}
	}else{
		if($levelpetta==2){
			$q = "SELECT * FROM mahasiswa WHERE id_pengguna=".$id_penerima."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->id_pengguna;
			}
		}else{
			$q = "SELECT * FROM dosen WHERE id_pengguna=".$id_penerima."";
			$query = $ci->db->query($q);
			foreach($query->result() as $result){
				return $result->id_pengguna;
			}
		}
	}
}
?>