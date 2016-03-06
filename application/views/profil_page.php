<?php $this->load->view('layouts/nav'); ?>
<div class="profile-t blue lighten-1">
	<div class="container">
		<div class="row">
			<div class="col s12 m3 l3" align="center">
				<img class="circle responsive-image profile-img-t" src="<?php echo base_url('assets/img/dosen/noava.png'); ?>">
			</div>
			<div class="col s12 m9 l9 info-t">
				<div style="font-size:18pt;">
					Firhan
				</div>
				<div style="font-size:12pt;">
					firhan.faisal1995@gmail.com
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">account_circle</i>&nbsp;INFORMASI
				</div>
				<ul class="category-t">
					<li>Firhan</li>
					<li>firhan.faisal1995@gmail.com</li>
					<li>082372738231</li>
				</ul>
				<div align="right">
					<a href="#"><i class="material-icons tiny">settings</i>&nbsp;ubah</a>
				</div>
			</div>
		</div>
		<div class="col s12 m8 l9">
			<?php for($i=1;$i<=5;$i++){ ?>
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							Anda meminati tema TA <b>Pembuatan Sistem Pendeteksi Meno-pause dengan metode Jaringa...</b>
						</div>
						<div class="col s3" align="right">
							23 Mar 2016, 10:42
						</div>
					</div>
				</div>
			</a>
			<a href="#">
				<div class="history-t">
					<div class="row">
						<div class="col s9">
							Anda mengirim pesan ke <b>Firhan, S.KOM</b>
						</div>
						<div class="col s3" align="right">
							23 Mar 2016, 10:42
						</div>
					</div>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
</div>