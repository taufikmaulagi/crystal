<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title><?=$main['nama']?> | Expired</title>
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
          <strong>Expired</strong>
        </header>
        <div class="panel-body wrapper-lg">
            <div align="center">
                <i class="fa fa-meh-o m-b-l" style="font-size:100px"></i>
                <p>
                    <h4 class="m-b-xl"><p>Oops ! Halaman ini sudah tidak dapat diakses lagi! Silahkan login kembali</p></h4>
                    <a href="<?=base_url('auth/login')?>" class="btn btn-primary btn-block"><i class="fa fa-sign-in m-r-sm"></i>Masuk</a>
                </p>
                <div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Tidak punya akun?</small></p>
                    <a href="#" class="btn btn-default btn-block"><i class="fa fa-edit"></i>&nbsp;&nbsp;Daftar Disini</a>
                </div>
            </div>
        </div>
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