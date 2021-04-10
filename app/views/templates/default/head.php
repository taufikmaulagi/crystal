<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title><?=$title?> | <?=$main['nama']?></title>
  <meta name="description" content="<?=$main['deskripsi']?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?=assets()?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?=assets()?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?=assets()?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=assets()?>css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?=assets()?>js/select2/select2.css" type="text/css" />
  <link rel="stylesheet" href="<?=assets()?>js/select2/theme.css" type="text/css" />
  <link rel="stylesheet" href="<?=assets()?>js/datepicker/datepicker.css" type="text/css">
  <link rel="stylesheet" href="<?=assets()?>css/app.css" type="text/css" />
  <script src="<?=assets()?>js/jquery.min.js"></script>
    <?=$heaplug?>
    <link rel="shortcut icon" href="<?=base_url('public/images/'.$main['favicon'])?>">
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
  <!-- <style>
    .fa option {

      font-weight: 1000;
    }
  </style> -->
</head>
<body>
  <section class="vbox">