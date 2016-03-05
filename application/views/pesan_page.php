<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					<i class="material-icons">email</i>&nbsp;PESAN
				</div>
				<ul class="category-t">
					<li><a href="#">(+) Tulis Pesan</a></li>
					<li class="active"><a href="#">Kotak Masuk <span class="badge-t">1 baru</span></a></li>
					<li><a href="#">Kotak Keluar</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<table class="table highlight">
				<thead>
					<tr>
						<td width="5%">No</td>
						<td width="15%">Pengirim</td>
						<td width="45%">Pesan</td>
						<td width="20%">Tanggal</td>
						<td width="25%">Aksi</td>
					</tr>
				</thead>
				<tbody>
					<?php for($i=1;$i<=10;$i++){ ?>
					<tr>
						<td><?php echo $i; ?>.</td>
						<td>Firhan, S.KOM</td>
						<td>Saya menyetujui anda untuk mengambil tema TA den...</td>
						<td>17 Mar 2016, 14:22</td>
						<td>
							<a class="btn-floating blue" href="#"><i class="material-icons">zoom_in</i></a>
							<a class="del modal-trigger btn-floating red" href="#deleteModal"><i class="material-icons">clear</i></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>