<header class="bg-black dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="<?=assets('images/').$main['logo']?>"></a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count"><?=count($notif_lastest)==0?'':count($notif_lastest)?></span>
          </a>
          <section class="dropdown-menu aside-xl">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong><?=count($notif_lastest)=='0'?'Tidak ada notifikasi baru':'Terdapat <span class="count">'.count($notif_lastest).'</span> notifikasi baru';?></strong>
              </header>
              <div class="list-group list-group-alt animated fadeInRight" id="notifSide">
              <?php $no=1; foreach($notif_all as $key => $val):
                $no++;
                $foto = '';
                if(empty($val['foto'])){
                  $foto = '<img src="'.base_url().'public/images/'.$val['icon'].'">';
                } else {
                  $foto = '<img src="'.base_url().'public/images/'.$val['foto'].'" class="img-circle">';
                }
                $url = empty($val['url']) ? '#' : $val['url'];
                echo '<li class="list-group-item">
                <div class="media">
                  <span class="pull-left thumb-sm">
                    '.$foto.'
                  </span>
                  <a href="'.$url.'">
                  <div class="media-body">
                    <div class="label bg-'.$val['color'].'">'.$val['nama_label'].'</div><br/>
                    <b>'.strtoupper($val['judul']).'</b><br/>
                    '.$val['pesan'].'<br/>
                    <div class="line"></div>
                    <small class="text-muted">'.$val['created_at'].'</small>
                  </div>
                  </a>
                </div>
              </li>';
              if($no==3)break; 
              endforeach; ?>
              </div>
              <footer class="panel-footer text-sm">
                <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                <a href="#notes" id="openNotif" data-toggle="class:show animated fadeInRight">Lihat Semua Notifikasi</a>
              </footer>
            </section>
          </section>
        </li>
        <li class="dropdown hidden-xs">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
          <section class="dropdown-menu aside-xl animated fadeInUp">
            <section class="panel bg-white">
              <form role="search">
                <div class="form-group wrapper m-b-none">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div>
              </form>
            </section>
          </section>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <?php
                if(empty($this->session->userdata('logged_in')['foto'])){
                  if($this->session->userdata('logged_in')['jenis_kelamin']=='P'){
                    $temp['foto'] = 'avatar_default_female.jpg';
                  } else {
                    $temp['foto'] = 'avatar_default.jpg';
                  }
                } else {
                  $temp['foto'] = $this->session->userdata('logged_in')['foto'];
                }
              ?>
              <img src="<?=assets('images/').$temp['foto']?>">
            </span>
            <?=$this->session->userdata('logged_in')['nama']?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="#">Settings</a>
            </li>
            <li>
              <a href="">Profile</a>
            </li>
            <li>
              <a href="">Help</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="<?=base_url('auth/logout')?>">Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">