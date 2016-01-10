<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/25/15
 * Time: 11:24 AM
 */ ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf_token" content="{{ csrf_token() }}" />
<title>Bus Ticket</title>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<!-- Select2 -->
<link rel="stylesheet" href="{{url()}}/plugins/select2/select2.min.css">
<link rel="stylesheet" href="{{url()}}/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{url()}}/bootstrap/font-awesome/css/font-awesome.min.css">

<!-- Ionicons -->
<link rel="stylesheet" href="{{url()}}/bootstrap/ionicons/css/ionicons.min.css">

<!-- Theme style -->

<!-- iCheck -->
<link rel="stylesheet" href="{{url()}}/plugins/iCheck/square/blue.css">

<link rel="stylesheet" href="{{url()}}/dist/css/jquery-ui.min.css">
<link rel="stylesheet" href="{{url()}}/dist/css/jquery.ui.theme.css">

<link rel="stylesheet" href="{{url()}}/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="{{url()}}/dist/css/skins/_all-skins.min.css">





<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<style type="text/css">
    .clsDatePicker {
        z-index: 100000;
    }

    body.modal-open .datepicker {
        z-index: 100000 !important;
    }
    .ui-datepicker{ z-index:100000 !important; }
</style>
<![endif]-->