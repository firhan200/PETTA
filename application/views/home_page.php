<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row" style="margin-bottom:20px;">
		<div class="col s12 m6 l5">
			<div class="row">
				<div class="col s12 m8 l8">
					<div class="input-field">
						<i class="material-icons prefix">search</i>
				        <input id="search" type="text" placeholder="cari tema">
					</div>
				</div>
				<div class="col s12 m4 l4">
					<a href="#" style="margin-top:20px;width:100%;" class="waves-light waves-effect btn blue darken-1">Cari</a>
				</div>
			</div>
		</div>
		<div class="col s12 m4 l4 offset-m2 offset-l3">
			<div class="input-field">
		    	<select class="browser-default">
			      <option value="">Saring Tema</option>
			      <option value="1">Option 1</option>
			      <option value="2">Option 2</option>
			      <option value="3">Option 3</option>
		    	</select>
		  	</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m3">
			<div class="box-t">
				<div class="content-title-t blue">
					KATEGORI
				</div>
				<ul class="category-t">
					<li><a href="#">Bidang Tema</a></li>
					<li><a href="#">Bidang Tema</a></li>
					<li><a href="#">Bidang Tema</a></li>
				</ul>
			</div>
		</div>
		<div class="col s12 m9">
			<ul class="collection">
		    	<li class="collection-item avatar">
		      		<img src="<?php echo base_url('assets/img/dosen/noava.png'); ?>" alt="" class="circle">
		      		<div class="row" style="margin-bottom:-5px;">
		      			<div class="col s8 m6 l6">
		      				<a href="#"><div class="dosen-t">Firhan, S.KOM</div></a>
		      			</div>
		      			<div class="col s4 m6 l6" align="right">
		      				<a href="#" class="ketchup tooltip" title="<?php for($i=1;$i<=10;$i++){ echo "Firhan<br/>"; }; ?>">10 Peminat</a>
		      			</div>
		      		</div>
		      		<span class="title"><b>Judul Tema TA</b></span>
		      		<p>
		      			Paragraf keterangan untuk judul tema TA Paragraf keterangan untuk judul tema TA
		      			Paragraf keterangan untuk judul tema TA Paragraf keterangan untuk judul tema TA
		      			Paragraf keterangan untuk jud...
		      		</p>
		      		<span class="chip">Bidang Tema</span>
		      		<span class="chip">Bidang Tema</span>
		      		<span class="chip">Bidang Tema</span>
		      		<div align="right">
		      			<a href="#" class="btn btn-small waves-light waves-effect blue">Minat</a>
		      			<a href="#" class="btn btn-small waves-light waves-effect gray">Lihat Detil</a>
		      		</div>
		    	</li>
		    	<li class="collection-item avatar">
		      		<img src="<?php echo base_url('assets/img/dosen/noava.png'); ?>" alt="" class="circle">
		      		<div class="row" style="margin-bottom:-5px;">
		      			<div class="col s8 m6 l6">
		      				<a href="#"><div class="dosen-t">Firhan, S.KOM</div></a>
		      			</div>
		      			<div class="col s4 m6 l6" align="right">
		      				<a href="#" class="ketchup tooltip" title="<?php for($i=1;$i<=4;$i++){ echo "Firhan<br/>"; }; ?>">4 Peminat</a>
		      			</div>
		      		</div>
		      		<span class="title"><b>Judul Tema TA</b></span>
		      		<p>
		      			Paragraf keterangan untuk judul tema TA Paragraf keterangan untuk judul tema TA
		      			Paragraf keterangan untuk judul tema TA Paragraf keterangan untuk judul tema TA
		      			Paragraf keterangan untuk jud...
		      		</p>
		      		<span class="chip">Bidang Tema</span>
		      		<div align="right">
		      			<a href="#" class="btn btn-small waves-light waves-effect red">Batalkan</a>
		      			<a href="#" class="btn btn-small waves-light waves-effect gray">Lihat Detil</a>
		      		</div>
		    	</li>
		  	</ul>
		</div>
	</div>
</div>