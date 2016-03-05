<ul id="dropdown1" class="dropdown-content">
  <li><a href="#"><span class="material-icons left icon-t">settings</span>&nbsp;&nbsp;PROFIL</a></li>
  <li class="divider"></li>
  <li><a href="#">KELUAR</a></li>
</ul>
<ul id="dropdown2" class="dropdown-content">
  <li><a href="#"><span class="material-icons left icon-t">settings</span>&nbsp;&nbsp;PROFIL</a></li>
  <li class="divider"></li>
  <li><a href="#">KELUAR</a></li>
</ul>
<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper blue">
      		<a href="{{ URL() }}" class="brand-logo"><img src="{{ asset('assets/img/logocolor.png') }}" class="logo-t"></a>
      		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color:#0489B1">menu</i></a>
      		<ul class="left hide-on-med-and-down" style="margin-left:10em;">
            <li class="<?php if(isset($menu1)) echo 'active'; ?>"><a href="<?php echo site_url(''); ?>">Beranda</a></li>
      			<li class="<?php if(isset($menu2)) echo 'active'; ?>"><a href="<?php echo site_url('dosen'); ?>">Dosen</a></li>
      		</ul>
      		<ul class="right hide-on-med-and-down">
            <li class="<?php if(isset($menu3)) echo 'active'; ?>"><a href="<?php echo site_url('pesan'); ?>"><i class="large material-icons" style="float:left;">email</i>&nbsp;Pesan <span class="new badge">1</span></a></li>
      			<li class="<?php if(isset($menu4)) echo 'active'; ?>"><a href="#" class="dropdown-button" data-activates="dropdown1"><i class="large material-icons" style="float:left;">person</i>&nbsp;Firhan<i class="material-icons right">arrow_drop_down</i></a></li>
      		</ul>
      		<ul class="side-nav" id="mobile-demo">
            <li class="<?php if(isset($menu1)) echo 'active'; ?>"><a href="<?php echo site_url(''); ?>">Beranda</a></li>
            <li class="<?php if(isset($menu2)) echo 'active'; ?>"><a href="<?php echo site_url('dosen'); ?>">Dosen</a></li>
            <li class="<?php if(isset($menu3)) echo 'active'; ?>"><a href="<?php echo site_url('pesan'); ?>"><i class="large material-icons" style="float:left;">email</i>&nbsp;Pesan <span class="new badge">1</span></a></li>
            <li class="<?php if(isset($menu4)) echo 'active'; ?>"><a href="#" class="dropdown-button" data-activates="dropdown2"><i class="large material-icons" style="float:left;">person</i>&nbsp;Firhan<i class="material-icons right">arrow_drop_down</i></a></li>
      		</ul>
    	</div>
  	</nav>
</div>