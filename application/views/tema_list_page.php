<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">book</i>&nbsp;TEMA TUGAS AKHIR
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('tema/tambah'); ?>">(+) Tambah Tema</a></li>
					<li><a href="<?php echo site_url('tema/riwayat'); ?>">Riwayat <?php if(isset($notif)) echo $notif; ?></a></li>
					<li class="active"><a href="<?php echo site_url('tema/data'); ?>">List Tema</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<ul class="collection" style="border:0px;">
					<?php 
					if($query->num_rows() > 0){
					foreach($query->result() as $result){ ?>
					<li class="collection-item avatar">
			      		<img src="<?php echo base_url('assets/img/dosen/noava.png'); ?>" alt="" class="circle">
			      		<div class="row" style="margin-bottom:-5px;">
			      			<div class="col s8 m6 l6">
			      				<a href="<?php echo site_url('profil/'.$result->id_pengguna.''); ?>"><div class="dosen-t"><?php echo htmlspecialchars($result->nama_dosen); ?></div></a>
			      			</div>
			      			<div class="col s4 m6 l6" align="right">
			      				<a href="#" class="ketchup tooltip" title="<?php for($i=1;$i<=10;$i++){ echo "Firhan<br/>"; }; ?>"><i class="material-icons tiny">grade</i>&nbsp;10 Peminat</a>
			      			</div>
			      		</div>
			      		<span class="title"><b><?php echo htmlspecialchars($result->judul); ?></b></span>
			      		<p style="margin-bottom:5px;">
			      			<?php if(strlen(htmlspecialchars($result->keterangan)) < 200){ echo htmlspecialchars($result->keterangan); }else{ echo substr(htmlspecialchars($result->keterangan), 0, 200).'...'; } ?>
			      		</p>
			      		<?php echo getTags($result->id_tema); ?>
			      		<div align="right" style="margin-top:10px;">
		      				<a href="#" class="btn btn-small waves-light waves-effect grey lighten-1">Ubah</a>
		      				<a href="#" class="btn btn-small waves-light waves-effect red">Hapus</a>
		      				<a href="#" class="btn btn-small waves-light waves-effect">Lihat Detil</a>
		      			</div>
			    	</li>
			    	<?php 
			    	}
			    	}else{
			    		echo '<center><i class="material-icons tiny">error</i>Tidak ada Data</center>';
			    	} ?>
			    </ul>
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
?>