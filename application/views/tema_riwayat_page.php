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
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							<a href="#" class="notif-t">Firhan</a> meminati tema TA <a href="#" class="notif-t">Pembuatan Sistem Pendeteksi Meno-pause dengan metode Jaringa...</a>
						</div>
						<div class="col s3" align="right">
							23 Mar 2016, 10:42
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>