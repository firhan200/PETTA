<?php 
if(isset($_SESSION['tag'])){
$i = 0;
foreach($_SESSION['tag'] as $result){ 
?>
<span class="chip">
	<?php echo getName($result); ?>
	<i id="<?php echo $result; ?>" class="cancel material-icons">close</i>
</span>
<?php $i++; }
} ?>
<?php
function getName($id_kategori){
	$ci =& get_instance();
	$q = "SELECT * FROM kategori WHERE id_kategori=".$id_kategori."";
	$query = $ci->db->query($q);
	foreach($query->result() as $result){
		return $result->nama_kategori;
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	var host = location.protocol + '//' + location.host + '/';
	$(".cancel").click(function(){
		var num = $(this).attr('id');
		$.ajax({
			url:host+'PETTA/tema/removeTags/'+num,
			data:{},
			success:function(data){
				$("#kategori_pilih").load(host+'/PETTA/tema/getTags');
			}
		});
	});
});
</script>