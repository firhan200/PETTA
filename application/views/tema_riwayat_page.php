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
					<li class="active"><a href="<?php echo site_url('tema/riwayat'); ?>">Riwayat <?php if(isset($notif)) echo $notif; ?></a></li>
					<li><a href="<?php echo site_url('tema/data'); ?>">List Tema</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<?php foreach($query->result() as $result){ ?>
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							<a href="#" class="notif-t"><?php echo htmlspecialchars($result->nama_mahasiswa); ?></a> meminati tema TA 
							<a href="<?php echo site_url('tema/detil/'.$result->id_tema.''); ?>" class="notif-t"><?php if(strlen(htmlspecialchars($result->judul)) < 50){ echo htmlspecialchars($result->judul); }else{ echo substr(htmlspecialchars($result->judul), 0, 50).'...'; } ?></a>
						</div>
						<div class="col s3" align="right">
							<?php echo date("d ", strtotime($result->tanggal_post)).$date[date("m", strtotime($result->tanggal_post))].date(" Y, H:i", strtotime($result->tanggal_post)); ?>
						</div>
					</div>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
</div>