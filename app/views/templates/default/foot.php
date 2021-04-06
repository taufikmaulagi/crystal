          </section>
            <footer class="footer bg-white b-t b-light">
              <p><?='<b>'.$main['nama'].'</b> '.$main['deskripsi_pendek']?>&copy; <?=$main['tahun_rilis']?></p>
            </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notifikasi</div>
            <ul class="list-group alt" id="notifSide">
              <?php foreach($notif_all as $key => $val):
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
              endforeach; ?>
            </ul>
        </aside>
      </section>
    </section>
  </section>
  
  <!-- Bootstrap -->
  <script src="<?=assets()?>js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?=assets()?>js/app.js"></script>
  <script src="<?=assets()?>js/app.plugin.js"></script>
  <script src="<?=assets()?>js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?=assets()?>js/select2/select2.min.js"></script>
  <script src="<?=assets()?>js/moment.js"></script>
  <script src="<?=assets()?>js/datepicker/bootstrap-datepicker.js"></script>
  <?=$fooplug?>
  <script>
    $('.dd').on('change', function() {
        var neser = $('.dd').nestable('serialize');
        $.ajax({
            url: '<?=base_url('settings/menu/ajx_organize')?>',
            data: {data: neser},
            type: 'post'
        })
    });

    var url = window.location.pathname.split('/');
    var fix_url = write_url(url[1])+write_url(url[2])+write_url(url[3])+'/';
    $('.nav li a').each(function(){
        if(write_url(url[2]) == '' && $(this).children().next().html() == 'Dashboard'){
          $(this).parent().addClass('active');
          $(this).parent().parent().parent().addClass('active');
          return false;
        } else if(this.href.indexOf(fix_url)!==-1){
          $(this).parent().addClass('active');
          $(this).parent().parent().parent().addClass('active');
        }
    });

    function write_url(url){
      if(url == 'add' || url == 'edit')
        return '';
      if(url)
        return '/'+url;
      else 
        return ''; 
    }

    function change_img_file(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $(input).prev().children().attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    function addMsg($msg){
      if($('.count').html()==''){ $('.count').html('0'); }
      var $el = $('.nav-user'), $n = $('.count:first', $el), $v = parseInt($n.text());
      $('.count', $el).fadeOut().fadeIn().text($v+1);
      $($msg).hide().prependTo($el.find('.list-group')).slideDown().css('display','block');
    }

    setInterval(function(){
      $.ajax({
        url: "<?=base_url('settings/notification/ajx_get_new')?>",
        success: function(data){
          data = JSON.parse(data);
          $.each(data, function(i, item){
            var foto = '';
            if(item.foto){
              foto = '<img src="<?=base_url()?>public/images/'+item.foto+'" class="img-circle">';
            } else {
              foto = '<img src="<?=base_url()?>public/images/'+item.icon+'">';
            }
            var url = '';
            if(item.url)
              url = item.url;
            else
              url = '#';
            var $msg = '<li class="list-group-item">'+
                '<div class="media">'+
                  '<span class="pull-left thumb-sm">'+foto+
                  '</span>'+
                  '<a href="'+url+'">'+
                  '<div class="media-body">'+
                    '<div class="label bg-'+item.color+'">'+item.nama_label+'</div><br/>'+
                    '<b>'+item.judul+'</b><br/>'+
                    item.pesan+'<br/>'+
                    '<div class="line"></div>'+
                    '<small class="text-muted">'+moment(item.created_at,'YYYY-MM-DD HH:II:SS','Indonesia/Jakarta').fromNow()+'</small>'+
                  '</div>'+
                  '</a>'+
                '</div>'+
              '</li>';
            addMsg($msg);
          })
        }
      })
    },3000);
    
    $('#notifSide .text-muted').each(function(){
      $(this).html(moment($(this).html(),'YYYY-MM-DD HH:II:SS','Indonesia/Jakarta').fromNow());
    });

    $('#openNotif').on('click', function(){
      $.ajax({url: "<?=base_url('settings/notification/ajx_read_all')?>"});
      $('.navbar-nav .count').html('');
    });
  </script>
</body>
</html>