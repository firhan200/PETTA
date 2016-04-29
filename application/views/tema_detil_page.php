<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="box-t">
				<?php 
				if($query->num_rows() > 0){
				foreach($query->result() as $result){ ?>
				<div class="row">
					<div class="col s12 m6" style="margin-bottom:5px;">
						<a href="<?php echo $link; ?>" class="btn btn-s"><i class="material-icons left">replay</i>&nbsp;Kembali</a>
						<?php if($result->status_tema==1){ ?>
							<button class="btn disabled">Tema Tutup</button>
						<?php } ?>
					</div>
					<div class="col s12 m6" align="right">
						<?php if($self==1){ 
							if($result->status_tema==1){ ?>
								<a href="<?php echo site_url('tema/ubah_status/'.$result->id_tema.'/0'); ?>" style="margin-bottom:5px;" class="btn btn-small waves-light waves-effect green"><i class="material-icons left">done</i>Buka</a>
							<?php }else{ ?>
								<a href="<?php echo site_url('tema/ubah_status/'.$result->id_tema.'/1'); ?>" style="margin-bottom:5px;" class="btn btn-small waves-light waves-effect grey"><i class="material-icons left">clear</i>Tutup</a>
							<?php }
						?>
						<a href="<?php echo site_url('tema/ubah/'.$result->id_tema.''); ?>" style="margin-bottom:5px;" class="btn btn-small waves-light waves-effect blue"><i class="material-icons left">settings</i>Ubah</a>
			      		<a href="<?php echo site_url('tema/hapus/'.$result->id_tema.''); ?>" style="margin-bottom:5px;" class="btn btn-small waves-light waves-effect red" onclick="return confirm('Hapus Tema?')"><i class="material-icons left">delete</i>Hapus</a>
						<?php }else if($self==3 AND $result->status_tema==0){ ?>
						<a href="<?php echo site_url('tema/minat/'.$result->id_tema.''); ?>" style="margin-bottom:5px;" class="btn btn-small waves-light waves-effect blue"><i class="material-icons left">done</i>Minati</a>
						<?php }else if($self==4 AND $result->status_tema==0){ ?>
						<a href="<?php echo site_url('tema/batal_minat/'.$result->id_tema.''); ?>" style="margin-bottom:5px;" class="btn btn-small waves-light waves-effect red"><i class="material-icons left">clear</i>Batalkan</a>
						<?php } ?>
					</div>
				</div>
				<?php
				if($this->input->get('balasan')!=null){
					if($this->input->get('balasan')==1){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Ubah Tema Berhasil</div>';
					}else if($this->input->get('balasan')==2){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Ubah Tema Gagal</div>';
					}else if($this->input->get('balasan')==3){
						echo '<div class="alert alert-success" align="center"><i class="material-icons tiny">done</i> Anda Meminati Tema Ini.</div>';
					}else if($this->input->get('balasan')==4){
						echo '<div class="alert alert-danger" align="center"><i class="material-icons tiny">error</i> Terjadi Kesalahan, gagal meminati tema.</div>';
					}
				}
				?>
				<ul class="collection" style="border:0px;">
					<li class="collection-item avatar">
			      		<img src="<?php echo base_url('assets/img/dosen/noava.png'); ?>" alt="" class="circle">
			      		<div class="row" style="margin-bottom:-5px;">
			      			<div class="col s12 m12">
			      				<a href="<?php echo site_url('profil/'.$result->id_pengguna.''); ?>"><div class="dosen-t"><?php echo htmlspecialchars($result->nama_dosen); ?></div></a>
			      			</div>
			      		</div>
			      		<span class="title"><b><?php echo htmlspecialchars($result->judul); ?></b></span>
			      		<p style="margin-bottom:5px;">
			      			<?php echo htmlspecialchars($result->keterangan); ?>
			      		</p>
			      		<div style="font-size:10pt;color:#61210B">
				      		<i><b>waktu post:</b> <?php echo date("d ", strtotime($result->tanggal_post)).$date[date("m", strtotime($result->tanggal_post))].date(" Y, H:i", strtotime($result->tanggal_post)); ?></i>
				      	</div>
			      		<?php echo getTags($result->id_tema); ?>
			      		<br/>
			      		<br/>
			      		<h5>Peminat</h5>
			      		<hr/>
			      		<table class="table striped">
			      			<?php if($self==1){
			      					echo getPeminat($result->id_tema); 
			      				}else{
			      					echo getPeminatLainnya($result->id_tema); 
			      				}
			      			?>
			      		</table>
			    	</li>
			    </ul>
			    <?php 
		    	}
		    	}else{
		    		echo '<center><i class="material-icons tiny">error</i>Tidak ada Data</center>';
		    	} ?>
			</div>
		</div>
	</div>
</div>
<?php
function getTags($id){
	$ci =& get_instance();
	$q = "SELECT * FROM tag T, kategori K WHERE T.id_kategori=K.id_kategori AND T.id_tema=".$id."";
	$query = $ci->db->query($q);
	foreach($query->result() as $result){
		echo '<span class="chip">'.$result->nama_kategori.'</span>&nbsp';
	}
}
function getPeminat($id){
	$ci =& get_instance();
	$q = "SELECT * FROM peminatan P, mahasiswa M WHERE P.id_pengguna=M.id_pengguna AND id_tema=".$id." ORDER BY P.id DESC";
	$query = $ci->db->query($q);
	foreach($query->result() as $result){
		echo '<tr><td width="80%">'.$result->nama_mahasiswa.'</td>';
		if($result->status_peminatan==1){
			?>
			<td align="right"><a href="<?php echo site_url('tema/batalkan_peminat/'.$id.'/'.$result->id_pengguna.''); ?>" onclick="return confirm('Batalkan Peminatan Mahasiswa?')"><button type="button" class="btn waves-effect red">Batalkan</button></a></td>
			<?php
		}else{
			?>
			<td align="right"><a href="<?php echo site_url('tema/setujui_peminat/'.$id.'/'.$result->id_pengguna.''); ?>" onclick="return confirm('Setujui Peminatan Mahasiswa?')"><button type="button" class="btn waves-effect blue">Setujui</button></a></td>
			<?php
		}
		echo '</tr>';
	}
}
function getPeminatLainnya($id){
	$ci =& get_instance();
	$q = "SELECT * FROM peminatan P, mahasiswa M WHERE P.id_pengguna=M.id_pengguna AND id_tema=".$id." ORDER BY P.id DESC";
	$query = $ci->db->query($q);
	foreach($query->result() as $result){
		echo '<tr><td width="80%">'.$result->nama_mahasiswa.'</td></tr>';
	}
}
?>