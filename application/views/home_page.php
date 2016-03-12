<?php $this->load->view('layouts/nav'); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#filter_dosen").change(function(){
		var id_dosen = $(this).val();
		window.location.href = 'tema?dosen='+id_dosen;
	});
	$("#search_btn").click(function(){
		var keyword = $("#search").val();
		window.location.href = 'tema?cari='+keyword;
	});
});
</script>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">bookmark</i>&nbsp;KATEGORI
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('tema'); ?>">semua bidang</a></li>
					<?php foreach($queryKategori->result() as $result){ ?>
					<li <?php if(isset($filterKategori)){ if($filterKategori==$result->id_kategori){ echo 'class="active"'; } } ?>><a href="<?php echo site_url('tema?kategori='.$result->id_kategori.''); ?>"><?php echo htmlspecialchars($result->nama_kategori); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<div class="row filter-t">
					<div class="col s12 m6 l5">
						<div class="row">
							<div class="col s12 m8 l8">
								<div class="input-field">
							        <input id="search" type="text" placeholder="cari judul" value="<?php if(isset($filterCari)){ echo $filterCari; } ?>">
								</div>
							</div>
							<div class="col s12 m4 l4">
								<a href="#" id="search_btn" style="margin-top:20px;width:100%;" class="waves-light waves-effect btn blue darken-1">Cari</a>
							</div>
						</div>
					</div>
					<div class="col s12 m4 l4 offset-m2 offset-l3">
						<div class="input-field">
					    	<select class="browser-default" id="filter_dosen">
						      <option value="">Semua Dosen</option>
						      <?php foreach($queryDosen->result() as $result){ ?>
						      <option value="<?php echo $result->id_pengguna; ?>" <?php if(isset($filterDosen)){ if($filterDosen==$result->id_pengguna){ echo 'selected'; } } ?>><?php echo htmlspecialchars($result->nama_dosen); ?></option>
						      <?php } ?>
					    	</select>
					  	</div>
					</div>
				</div>
			</div>
			<ul class="collection">
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
		      				<a href="#" class="ketchup tooltip" title="<?php echo getPeminat($result->id_tema); ?>"><i class="material-icons tiny">grade</i>&nbsp;<?php echo getJumlahPeminat($result->id_tema); ?>&nbsp;Peminat</a>
		      			</div>
		      		</div>
		      		<span class="title"><b><?php echo htmlspecialchars($result->judul); ?></b></span>
		      		<p style="margin-bottom:5px;">
		      			<?php if(strlen(htmlspecialchars($result->keterangan)) < 200){ echo htmlspecialchars($result->keterangan); }else{ echo substr(htmlspecialchars($result->keterangan), 0, 200).'...'; } ?>
		      		</p>
		      		<div style="font-size:10pt;color:#61210B">
			      		<i><b>waktu post:</b> <?php echo date("d ", strtotime($result->tanggal_post)).$date[date("m", strtotime($result->tanggal_post))].date(" Y, H:i", strtotime($result->tanggal_post)); ?></i>
			      	</div>
		      		<?php echo getTags($result->id_tema); ?>
		      		<div align="right" style="margin-top:10px;">
	      				<a href="<?php echo site_url('tema/detil/'.$result->id_tema.''); ?>" class="btn btn-small waves-light waves-effect">Lihat Detil</a>
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
		echo $result->nama_mahasiswa.'<br/>';
	}
}
function getJumlahPeminat($id){
	$ci =& get_instance();
	$q = "SELECT * FROM peminatan P WHERE id_tema=".$id."";
	$query = $ci->db->query($q);
	return $query->num_rows();
}
?>