<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title><?=$main['nama']?> | Lupa Password</title>
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
          <strong>Lupa Password</strong>
        </header>
        <form action="<?=base_url('auth/forgot_password')?>" method="post" class="panel-body wrapper-lg" autocomplete="off" <?php if(!empty($this->input->get('state'))) echo 'hidden="hidden"';?>>
        <?php if(!empty($this->session->flashdata('message'))){
            echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>';
        } ?>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" placeholder="Masukan email..." name="email" class="form-control input-lg" value="<?=$this->input->post('email')?>">
            <span class="text-danger"><?=form_error('email')?></span>
          </div>
          <a href="<?=base_url('auth/login')?>" class="pull-right m-t-xs"><small>Sudah Memiliki Akun ? Login disini</small></a>
          <button type="submit" class="btn btn-primary">Verifikasi</button>
          <!-- <div class="line line-dashed"></div> -->
          <!-- <a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a>
          <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a> -->
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Tidak punya akun?</small></p>
          <a href="<?=base_url('auth/signup')?>" class="btn btn-default btn-block"><i class="fa fa-edit"></i>&nbsp;&nbsp;Daftar Disini</a>
        </form>
        <form action="<?=base_url('auth/forgot_password')?>" method="post" class="panel-body wrapper-lg" autocomplete="off" <?php if(empty($this->input->get('state'))) echo 'hidden="hidden"';?>>
            <div align="center">
                <i class="fa fa-envelope" style="font-size:100px"></i>
                <p>
                    <h4><p>Silahkan tunggu beberapa saat dan cek <b>email</b> dari kami.</p>
                    <p>Jika belum ada <b>email</b> silahkan request email lagi</p></h4>
                    <input type="hidden" name="email" value="<?=base64_decode($this->input->get('email'))?>">
                    <button type="submit" id="btnse" class="btn btn-primary btn-block" disabled><b class="m-r">0:15</b><i class="fa fa-envelope-o m-r-sm"></i>Kirim Email Lagi</button>
                    <a href="<?=base_url('auth/forgot_password')?>" class="btn btn-default btn-block"><i class="fa fa-pencil m-r-sm"></i>Ubah Alamat Email</a>
                </p>
                <div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Tidak punya akun?</small></p>
                    <a href="<?=base_url('auth/signup')?>" class="btn btn-default btn-block"><i class="fa fa-edit"></i>&nbsp;&nbsp;Daftar Disini</a>
                </div>
            </div>
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
  <script>
        var timer2 = "0:16";
        var interval = setInterval(function() {
            if(timer2 <= 0){
                $('#btnse').html('');
            }
            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            if(minutes==0&&seconds==0){
                $('#btnse b').html('');
                $('#btnse').prop("disabled", false);
            } else {
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) clearInterval(interval);
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('#btnse b').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
            }
        }, 1000);
        
  </script>
</body>
</html>