<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 10/12/25
 * Time: 11:23 AM
 */?>

<!DOCTYPE html>
<html>
<head>
    @include("includes.head")
    <link rel="stylesheet" href="{{url()}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{url()}}/plugins/daterangepicker/daterangepicker-bs3.css">
</head>
<body>
<div class="wrapper">
@include("includes.header")
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$title}}
        <small>Listing</small>
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
<script src="{{url()}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url()}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{url()}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>


    $(function () {
        var l,p;
        var d=$(".myDelete");l=$("a.del");p=$("#myProcess")

        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('#reservation').datepicker(
            {
                dateFormat: 'yy-mm-dd',
                changeMonth: true
            }
        ).datepicker("setDate", new Date());

        $('#date_from').datepicker(
            {
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                onClose: function( selectedDate ) {
                    $( "#date_to" ).datepicker( "option", "minDate", selectedDate );
                }
            }
        );


        $('#date_to').datepicker(
            {
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                onClose: function( selectedDate ) {
                    $( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
                }
            }
        );

        var id
        var validator = $('#regRoute').validate({
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
                $("#myModalRouteNew").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '',type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),50000);}});
            }
        });



        var validator = $('#regMerchant').validate({
            rules: {
                c_fname: {
                    required: true
                },
                c_lname: {
                    required: true
                },
                phone :{
                    required :true
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
                $("#myModalMerchantNew").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '',type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });
        /**
        * Code section to update a route
        */
        var validator = $('#edtFrmRoute').validate({
            rules: {name: {required: true},size: {required: true}
            },
            highlight: function (element) {
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
                $("#myModalRouteEdit").modal("hide");//$("tbody#tblCompany").html(data);
                $("#myProcess").modal("show")
                $.ajax({url: '{{url()}}/routes/routeupdate/'+id,type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });




        $(".edtRouteLink").each(function(){
            var e = $(this)
            $(this).click(function(){
                var cid,cemail,cname,caddress,cphone,curl;cid = e.attr('cid');id = cid
                $("#id").val(e.attr('cid')); $("#_short_name").val(e.attr('cshort'));$("#_name").val(e.attr('cname'));$("#_description").val(e.attr('cdesc'));$("#_no_of_busstop").val(e.attr('cbusstops'));$("#_distance").val(e.attr('cdistance'));
                $('#myModalRouteEdit').modal("show")

            })
        })


        var validator = $('#regBus').validate({
            rules: {
                plate_no: {
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
                $.ajax({url: '',type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });

        $(".edtBusLink").each(function(){
            var e = $(this)
            $(this).click(function(){

                $("#id").val(e.attr('cid')); $("#_model").val(e.attr('cmodel'));$("#_name").val(e.attr('cname'));$("#_plate_no").val(e.attr('cplateno'));$("#_chases_no").val(e.attr('cchasis'));$("#_bus_color").val(e.attr('ccolor'));
                $("#_route_id").val(e.attr('crouteid'));$("#_number_of_sitters").val(e.attr('csitno'));
                $('#myModalBusEdit').modal("show")

            })
        })


        var validator = $('#edtBus').validate({
            rules: {
                plate_no: {
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
                $("#myModalBusEdit").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '',type: 'post',data: $(form).serialize(),dataType: 'html',
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000);}});
            }
        });


        $(".edtRoleLink").each(function(){
            var e = $(this)
            $(this).click(function(){
                var cid,cdescription,cname,clevel,cid = e.attr('cid');id = cid
                $("#id").val(e.attr('cid')); $("#_name").val(e.attr('cname'));$("#_description").val(e.attr('cdescription'));$("#_level").val(e.attr('clevel'));
                $('#myModalRoleEdit').modal("show")
            })
        })


        l.on("click",function(){
            var u = $(this).attr("href");
            $("#myDelete").modal("hide")
            p.modal("show")
            $.ajax({url: u,type: 'post',data: {_token: $('meta[name="csrf_token"]').attr('content')},dataType: 'html',
                success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval(window.location.reload(),500000)}});
            return false
        })


        $("#reservation").on("focusin",function(){
            $(".ui-datepicker").css("z-index","100000 !important");
        })


    });
</script>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
</body>
</html>