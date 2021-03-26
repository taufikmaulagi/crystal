<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title><?=$main['nama']?> | Daftar</title>
  <meta name="description" content="<?=$main['deskripsi']?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?=base_url('public/')?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('public/')?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('public/')?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('public/')?>css/font.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url('public/')?>css/app.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url('public/')?>js/datepicker/datepicker.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="<?=base_url('public/')?>js/ie/html5shiv.js"></script>
    <script src="<?=base_url('public/')?>js/ie/respond.min.js"></script>
    <script src="<?=base_url('public/')?>js/ie/excanvas.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="<?=base_url('public/images/'.$main['favicon'])?>">
</head>
<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <center><img src="./../public/images/<?=$main['logo']?>" style="width:40%;"></center>
      <div class="navbar-brand block" style="color:#d9d9d9"><?=$main['deskripsi_pendek']?></div>
      <section class="panel panel-default bg-white m-t-sm">
        <header class="panel-heading text-center">
          <strong>Daftar</strong>
        </header>
        <form action="<?=base_url('auth/signup')?>" method="post" class="panel-body wrapper-lg" autocomplete="off">
        <?php if(!empty($this->session->flashdata('message'))){
            $color = "danger";
            if($this->session->flashdata('status') == "success")
              $color = "success";
            echo '<div class="alert alert-'.$color.'">'.$this->session->flashdata('message').'</div>';
        } ?>
          <div class="form-group">
            <label class="control-label">Nama Lengkap</label>
            <input type="text" placeholder="Masukan Nama Lengkap..." name="nama" class="form-control input-lg" value="<?=$this->input->post('nama')?>">
            <span class="text-danger"><?=form_error('nama')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Tanggal Lahir</label>
            <input class="input-lg input-s datepicker-input form-control" name="tanggal_lahir" type="text" value="<?=empty($this->input->post('tanggal_lahir')) ? '2000-01-01' : $this->input->post('tanggal_lahir')?>" data-date-format="yyyy-mm-dd" >
            <span class="text-danger"><?=form_error('tanggal_lahir')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Jenis Kelamin</label>
            <select class="form-control input-lg" name="jenis_kelamin">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?=$this->input->post('jenis_kelamin') == 'L' ? 'selected="selected"' : ''?>>Laki-Laki</option>
                <option value="P" <?=$this->input->post('jenis_kelamin') == 'P' ? 'selected="selected"' : ''?>>Perempuan</option>
            </select>
            <span class="text-danger"><?=form_error('jenis_kelamin')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" name="email" placeholder="Masukan email.." class="form-control input-lg" value="<?=$this->input->post('email')?>">
            <span class="text-danger"><?=form_error('email')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" name="username" placeholder="Masukan username.." class="form-control input-lg" value="<?=$this->input->post('username')?>">
            <span class="text-danger"><?=form_error('username')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" name="password" placeholder="Masukan password.." class="form-control input-lg" value="<?=$this->input->post('password')?>">
            <span class="text-danger"><?=form_error('password')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password</label>
            <input type="password" name="konfirmasi_password" placeholder="Masukan password.." class="form-control input-lg" value="<?=$this->input->post('konfirmasi_password')?>">
            <span class="text-danger"><?=form_error('konfirmasi_password')?></span>
          </div>
          <div class="checkbox m-t-l m-b-l">
            <label>
              <input type="checkbox" name="accept_terms"> Setujui <a href="#">syarat dan ketentuan kami</a><br/>
              <span class="text-danger"><?=form_error('accept_terms')?></span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Daftar</button>
          <!-- <div class="line line-dashed"></div> -->
          <!-- <a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a>
          <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a> -->
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Sudah memiliki akun ?</small></p>
          <a href="<?=base_url('auth/login')?>" class="btn btn-info btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login Disini</a>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small><?='<b>'.$main['nama'].'</b> '.$main['deskripsi_pendek']?>&copy; <?=$main['tahun_rilis']?></small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="<?=base_url('public/')?>js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?=base_url('public/')?>js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?=base_url('public/')?>js/app.js"></script>
  <script src="<?=base_url('public/')?>js/app.plugin.js"></script>
  <script src="<?=base_url('public/')?>js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?=base_url('public/')?>js/datepicker/bootstrap-datepicker.js"></script>
  
</body>
</html>