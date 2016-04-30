<?php $this->load->view('layouts/nav'); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("html, body").animate({ scrollTop: $(document).height()-$(window).height()-150 });
});
</script>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">email</i>&nbsp;PESAN
				</div>
				<ul class="category-t">
					<li><a href="<?php echo site_url('pesan/pesan_baru'); ?>">(+) Tulis Pesan</a></li>
					<li><a href="<?php echo site_url('pesan'); ?>">Kotak Masuk <?php if(isset($notif)) echo $notif; ?></a></li>
					<li><a href="<?php echo site_url('pesan/pesan_keluar'); ?>">Kotak Keluar</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<div class="box-t">
				<div class="row">
					<div class="col s10 offset-s1" align="left">
						<ul class="collection msg-t" style="border:0px;">
							<?php 
							foreach($query->result() as $result){ 
							if($result->id_pengirim!=$this->session->userdata('idpetta')){	
							$info = getData($result->id_pengirim, $this->session->userdata('levelpetta'));
							?>
					    	<li class="collection-item avatar in-t">
					      		<img src="<?php echo base_url('assets/img/dosen/'.$info['foto'].''); ?>" alt="" class="circle">
					      		<div class="dosen-t">
					      			<div class="row">
					      				<div class="col s6">
							      			<a href="<?php echo site_url('profil/index/'.$info['id']); ?>"><?php echo htmlspecialchars($info['nama']); ?></a>
							      			<div style="margin-top:-5px;">
							      				<b><?php echo htmlspecialchars($info['ni']); ?></b>
							      			</div>
							      		</div>
							      		<div class="col s6 msg-date-t" align="right">
							      			<?php echo date("d ", strtotime($result->tanggal)).$date[date("m", strtotime($result->tanggal))].date(" Y, H:i", strtotime($result->tanggal)); ?>
							      		</div>
							      	</div>
					      		</div>
					      		<p style="margin-top:-15px;">
					      			<?php echo htmlspecialchars($result->pesan); ?>
					      		</p>
					    	</li>
					    	<?php 
					    	}else{
					    		if($result->hapus2==0){
					    	?>
					    	<li class="collection-item avatar out-t">
					      		<img src="<?php echo base_url('assets/img/dosen/noava.png'); ?>" alt="" class="circle">
					      		<div class="dosen-t">
					      			<div class="row">
					      				<div class="col s6">
							      			<b>Saya</b>
							      		</div>
							      		<div class="col s6 msg-date-t" align="right">
							      			<?php echo date("d ", strtotime($result->tanggal)).$date[date("m", strtotime($result->tanggal))].date(" Y, H:i", strtotime($result->tanggal)); ?>
							      		</div>
							      	</div>
					      		</div>
					      		<p style="margin-top:-15px;">
					      			<?php echo htmlspecialchars($result->pesan); ?>
					      		</p>
					    	</li>
					    	<?php	
					    		}
					    	}
					    	} 
					    	?>						
					  	</ul>
					</div>
				</div>
				<form action="<?php echo site_url('pesan/kirim/'.$this->uri->segment('3').''); ?>" method="post">
					<div class="row">
						<div class="input-field col s10 offset-s1">
					    	<textarea id="pesan" name="pesan" class="materialize-textarea" length="320" maxlength="320"></textarea>
	            			<label for="pesan">Pesan</label>
					  	</div>
					  	<center><button type="submit" class="btn waves-effect waves-light">BALAS</a></center>
					  </div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
function getData($idUser, $level){
	$ci =& get_instance();
	if($level==2){
		$q = "SELECT * FROM mahasiswa WHERE id_pengguna=".$idUser."";
		$query = $ci->db->query($q);
		foreach($query->result() as $result){
			$data['id'] = $result->id_pengguna;
			$data['nama'] = $result->nama_mahasiswa;
			$data['foto'] = 'noava.png';
			$data['ni'] = 'NIP : '.$result->nim;
		}
	}else if($level==3){
		$q = "SELECT * FROM dosen WHERE id_pengguna=".$idUser."";
		$query = $ci->db->query($q);
		foreach($query->result() as $result){
			$data['id'] = $result->id_pengguna;
			$data['nama'] = $result->nama_dosen;
			$data['foto'] = $result->foto_dosen;
			$data['ni'] = 'NIP : '.$result->nip;
		}
	}
	return $data;
}
?>