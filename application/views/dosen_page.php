<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<center><h4>DAFTAR DOSEN</h4></center>
	<div class="row">
		<?php for($i=1;$i<=14;$i++){ ?>
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="card">
			    	<div class="card-image waves-effect waves-block waves-light">
			      		<img class="activator" src="<?php echo base_url('assets/img/dosen/noava.png'); ?>">
			    	</div>
				    <div class="card-content">
				      	<span class="card-title activator grey-text text-darken-4">
				      		Firhan Faisal Ali Balweel, S.KOM
				      		<i class="material-icons right">more_vert</i>
				      	</span>
				    	<div align="right">
				    		<a href="{{ URL('events/'.$result->id_event.'') }}"><i class="material-icons tiny">visibility</i> Lihat</a>
				    	</div>
				    </div>
				    <div class="card-reveal">
				      	<span class="card-title grey-text text-darken-4">
				      		Firhan Faisal Ali Balweel, S.KOM
				      		<i class="material-icons right">close</i>
				      	</span>
				      	<br/>
			      		<b>Telepon:</b><br/>08453543453<br/>
			      		<b>E-Mail:</b><br/>firhan.faisal1995@gmail.com
				    </div>
			  	</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>