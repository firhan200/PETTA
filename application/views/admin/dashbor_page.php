<?php $this->load->view('layouts/nav'); ?>
<div class="container pad-t">
	<div class="row">
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="row">
					<div class="col s6">
						<h3><?php echo $totalDosen; ?></h3>
						<div class="d-title">
							Dosen
						</div>
					</div>
					<div class="col s6" align="right">
						<i class="material-icons large">person</i>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="row">
					<div class="col s6">
						<h3><?php echo $totalMahasiswa; ?></h3>
						<div class="d-title">
							Mahasiswa
						</div>
					</div>
					<div class="col s6" align="right">
						<i class="material-icons large">people</i>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="row">
					<div class="col s6">
						<h3><?php echo $totalTema; ?></h3>
						<div class="d-title">
							Tema
							<div style="position:absolute;">
								<b><?php echo $totalTemaBuka; ?></b> Buka, <b><?php echo $totalTema-$totalTemaBuka; ?></b> Tutup
							</div>
						</div>
					</div>
					<div class="col s6" align="right">
						<i class="material-icons large">book</i>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m4 l3">
			<div class="box-t">
				<div class="row">
					<div class="col s6">
						<h3><?php echo $totalPeminatan; ?></h3>
						<div class="d-title">
							Peminatan
						</div>
					</div>
					<div class="col s6" align="right">
						<i class="material-icons large">star</i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<h4>Peminatan Tema</h4>
		<canvas id="charts" height="50px"></canvas>
	</div>
</div>
<!-- javascript -->
<script type="text/javascript" src="<?php echo base_url('assets/Chart.js-master/Chart.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	//get data
	$.ajax({
		url:'dashbor/getDataPeminatan',
		data:{},
		success:function(data){
			var myLabel = data['judul'];
			var myData = data['peminat'];
			Chart.defaults.global.responsive = true; //responsive chart
			var data = {
				labels: myLabel,
				datasets: [
					{
						label: "Peminatan",
						fillColor: "rgba(220,190,190,0.2)",
						strokeColor: "#FE642E",
						pointColor: "#FE642E",
						HighlightFill: "#fff",
						HighlightStroke: "rgba(151,187,205,1)",
						data: myData
					}
				]
			};
			var context = document.getElementById('charts').getContext('2d');
			var monthChart = new Chart(context).Bar(data);
		}
	});
});
</script>