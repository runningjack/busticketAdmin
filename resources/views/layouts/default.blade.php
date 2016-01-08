<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/25/15
 * Time: 10:51 AM
 */?>

<!DOCTYPE html>
<html>
<head>
    @include("includes.head")
    <!--<link rel="stylesheet" href="{{url()}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{url()}}/plugins/daterangepicker/daterangepicker-bs3.css">-->
</head>
<body>

    @include("includes.header")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$title}}
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url()}}"><i class="fa fa-dashboard"></i> Home</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @yield("content")
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@include("includes.footer")
<script>
$(function () {

    var l, p,id,e;// l for delete link;;;; p for the progress bar modal;;; id set for update and delete ajax url for get and post
    var d=$(".myDelete");l=$("a.del");p=$("#myProcess")
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    $('#reservation').datepicker(
        {
            dateFormat: 'yy-mm-dd',
            changeMonth: true
        }
    ).datepicker("setDate", new Date());

    $(".select2").select2();
    var validator = $('#regBusStop').validate({
        rules: {
            short_name: {
                required: true
            },
            name: {
                required: true
            }
        }, highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },submitHandler: function(form) {
            $("#myModalBusStopNew").modal("hide")
            $("#myProcess").modal("show")
            $.ajax({url: '{{url()}}/routes/addbusstop',type: 'post',data: $(form).serialize(),
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
        }
    });


    var validator = $('#regBus').validate({
        rules: {
            short_name: {
                required: true
            },
            name: {
                required: true
            }
        }, highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },submitHandler: function(form) {
            $("#myModalBusNew").modal("hide")
            $("#myProcess").modal("show")
            $.ajax({url: '',type: 'post',data: $(form).serialize(),
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
        }
    });


    var validator = $('#addBusStop').validate({
        rules: {
            short_name: {
                required: true
            }
        }, highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },submitHandler: function(form) {
            $("#myModalTerminalNew").modal("hide")
            $("#myProcess").modal("show")
            $.ajax({url: '{{url()}}/merchants/autocomplete/'+$("#merchant_id").val(),type: 'post',data: $(form).serialize(),
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
        }
    });


    var validator = $('#genTickets').validate({
        rules: {
            short_name: {
                required: true
            }
        }, highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },submitHandler: function(form) {
            $("#myModalGenerateTicket").modal("hide")
            $("#myProcess").modal("show")
            $.ajax({url: '',type: 'post',data: $(form).serialize(),
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
        }
    });

    $(".edtBusstopLink").each(function(){
        var e = $(this)
        $(this).click(function(){

            $("#id").val(e.attr('cid')); $("#_short_name").val(e.attr('cshort'));$("#_name").val(e.attr('cname'));$("#_description").val(e.attr('cdesc'));$("#_geodata").val(e.attr('cgeodata'));$("#_distance").val(e.attr('cdistance'));
            $("#_one_way_from_fare").val(e.attr('conewayfro'));$("#_one_way_to_fare").val(e.attr('conewayto'));
            $('#myModalBusStopEdit').modal("show")

        })
    })

    var validator = $('#edtBusStop').validate({
        rules: {
            _short_name: {
                required: true
            },
            _one_way_to_fare: {
                required: true
            },
            _one_way_from_fare: {
                required: true
            }
        }, highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },submitHandler: function(form) {
            $("#myModalBusStopEdit").modal("hide")
            $("#myProcess").modal("show")
            $.ajax({url: '{{url()}}/routes/addbusstop',type: 'post',data: $(form).serialize(),
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
        }
    });


    $(".genTicket").click(function(){
        e = $(this);
            var cid,routeid,stationid,appid,terminalid,curl;cid = e.attr('cid');
            $("#terminal_id").val(e.attr('stationid'));$("#route_id").val(e.attr('routeid'));$("#app_id").val(e.attr('appid'));
            $('#myModalGenerateTicket').modal("show")

    })

    /**
     * This section is the ajax form validated and submitted to
     *addBusStop
     */
})
</script>
</body>
</html>