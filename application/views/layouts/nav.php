<?php if(($this->session->userdata('levelpetta')==2) || ($this->session->userdata('levelpetta')==3)){?>
<ul id="dropdown1" class="dropdown-content">
  <li><a href="<?php echo site_url('profil'); ?>"><span class="material-icons left icon-t">settings</span>&nbsp;&nbsp;PROFIL</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo site_url('pengguna/logoutProcess'); ?>">KELUAR</a></li>
</ul>
<?php } else{?>
<ul id="dropdown1" class="dropdown-content">
  <li class="divider"></li>
  <li><a href="<?php echo site_url('pengguna/logoutProcess'); ?>">KELUAR</a></li>
</ul>
<?php }?>
<!-- <ul id="dropdown2" class="dropdown-content">
  <li><a href="<?php echo site_url('profil'); ?>"><span class="material-icons left icon-t">settings</span>&nbsp;&nbsp;PROFIL</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo site_url('pengguna/logoutProcess'); ?>">KELUAR</a></li>
</ul> -->
<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper blue">
      		<a href="#" class="brand-logo"><img src="<?php echo base_url('assets/img/head_icon.png'); ?>" class="logo-t"></a>
      		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color:#0489B1">menu</i></a>
      		<ul class="right hide-on-med-and-down">
            <?php if($this->session->userdata('levelpetta')==1){ ?>
              <li class="<?php if(isset($menu01)) echo 'active'; ?>"><a href="<?php echo site_url('dashbor'); ?>">Dashbor</a></li>
              <li class="<?php if(isset($menu1)) echo 'active'; ?>"><a href="<?php echo site_url('tema'); ?>">Beranda</a></li>
              <li class="<?php if(isset($menu02)) echo 'active'; ?>"><a href="<?php echo site_url('dosen/data'); ?>">Dosen</a></li>
              <li class="<?php if(isset($menu03)) echo 'active'; ?>"><a href="<?php echo site_url('mahasiswa/data'); ?>">Mahasiswa</a></li>
              <li class="<?php if(isset($menu04)) echo 'active'; ?>"><a href="<?php echo site_url('kategori/data'); ?>">Kategori</a></li>
            <?php }else{ ?>
              <li class="<?php if(isset($menu1)) echo 'active'; ?>"><a href="<?php echo site_url('tema'); ?>">Beranda</a></li>
        			<li class="<?php if(isset($menu2)) echo 'active'; ?>"><a href="<?php echo site_url('dosen'); ?>">Dosen</a></li>
              <?php if($this->session->userdata('levelpetta')==2){ ?>
              <li class="<?php if(isset($menu32)) echo 'active'; ?>"><a href="<?php echo site_url('tema/riwayat'); ?>"><i class="large material-icons" style="float:left;">book</i>&nbsp;Tema <span id="notifta"></span></a></li>
              <?php } ?>
              <li class="<?php if(isset($menu3)) echo 'active'; ?>"><a href="<?php echo site_url('pesan'); ?>"><i class="large material-icons" style="float:left;">email</i>&nbsp;Pesan <span id="notif"></span></a></li>
        		<?php } ?>
            <li class="<?php if(isset($menu4)) echo 'active'; ?>"><a href="#" class="dropdown-button" data-activates="dropdown1"><i class="large material-icons" style="float:left;">person</i>&nbsp;<?php echo htmlspecialchars($this->session->userdata('namapetta')); ?><i class="material-icons right">arrow_drop_down</i></a></li>
      		</ul>
      		<ul class="side-nav" id="mobile-demo">
            <li class="<?php if(isset($menu1)) echo 'active'; ?>"><a href="<?php echo site_url('tema'); ?>">Beranda</a></li>
            <li class="<?php if(isset($menu2)) echo 'active'; ?>"><a href="<?php echo site_url('dosen'); ?>">Dosen</a></li>
            <?php if($this->session->userdata('levelpetta')==2){ ?>
            <li class="<?php if(isset($menu32)) echo 'active'; ?>"><a href="<?php echo site_url('tema/riwayat'); ?>"><i class="large material-icons" style="float:left;">book</i>&nbsp;Tema <span id="notifta"></span></a></li>
            <?php } ?>
            <li class="<?php if(isset($menu3)) echo 'active'; ?>"><a href="<?php echo site_url('pesan'); ?>"><i class="large material-icons" style="float:left;">email</i>&nbsp;Pesan <span id="notif2"></span></a></li>
            <li class="<?php if(isset($menu4)) echo 'active'; ?>"><a href="#" class="dropdown-button" data-activates="dropdown2"><i class="large material-icons" style="float:left;">person</i>&nbsp;<?php echo htmlspecialchars($this->session->userdata('namapetta')); ?><i class="material-icons right">arrow_drop_down</i></a></li>
      		</ul>
    	</div>
  	</nav>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-tiny blue">
      <i id="i_up" class="large material-icons tooltipped" data-position="top" data-tooltip="Scroll ke Atas" data-delay="1">keyboard_arrow_up</i>
    </a>
  </div>
<script type="text/javascript">
$(document).ready(function(){
  $("#i_up").click(function(){
    $('html, body').animate({scrollTop:0}, 'slow');
  });
  var host = location.protocol + '//' + location.host + '/';
  setInterval(function(){
    $.ajax({
      url:host+'PETTA/pengguna/getNotification',
      data:{},
      success:function(data){
        $("#notif").html(data);
        $("#notif2").html(data);
      }
    });
  }, 500);
});
</script>