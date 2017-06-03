<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo $titulo; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?> " media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/_all-skins.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/customizado.css'); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/btn.css'); ?>" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="./bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="./bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
   <!-- Latest compiled JavaScript -->
    <!-- Font Awesome -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script>
     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
  </head>
<body class="hold-transition skin-blue fixed sidebar-mini">
