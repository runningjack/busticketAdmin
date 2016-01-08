<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 10/11/25
 * Time: 11:23 AM
 */?>

<!DOCTYPE html>
<html>
<head>
    @include("includes.head")
</head>
<body>

    @include("includes.header")

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Bus-Ticket App</small>
            </h1>
            <!--Breadcrumb Area-->
            <ol class="breadcrumb">
                <li><a href="{{url()}}"><i class="fa fa-dashboard"></i> Home</a></li>

            </ol>
        </section>
        <!--Main Content-->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @yield("content")
                </div>
            </div>
        </section>
    </div>

    @include("includes.footer")
</body>
</html>
