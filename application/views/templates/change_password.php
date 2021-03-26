<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title><?=$main['nama']?> | Ubah Password</title>
  <meta name="description" content="<?=$main['deskripsi']?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?=base_url('public/')?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('public/')?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('public/')?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('public/')?>css/font.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url('public/')?>css/app.css" type="text/css" />
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
          <strong>Membuat Password Baru</strong>
        </header>
        <form action="<?=base_url('auth/change_password?token='.$this->input->get('token'))?>" method="post" class="panel-body wrapper-lg" autocomplete="off">
        <?php if(!empty($this->session->flashdata('message'))){
            echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
        } ?>
          <div class="form-group">
            <label class="control-label">Password Baru</label>
            <input type="password" placeholder="Masukan password..." name="password" class="form-control input-lg" value="<?=$this->input->post('password')?>">
            <span class="text-danger"><?=form_error('password')?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasi_password" placeholder="Masukan konfirmasi password.." class="form-control input-lg" value="<?=$this->input->post('konfirmasi_password')?>">
            <span class="text-danger"><?=form_error('konfirmasi_password')?></span>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Selesai & Simpan</button>
          <!-- <div class="line line-dashed"></div> -->
          <!-- <a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a>
          <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a> -->
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
  
</body>
</html>