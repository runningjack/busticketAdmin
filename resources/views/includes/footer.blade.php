<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/25/15
 * Time: 11:28 AM
 */
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2015 <a href="javascript:void(0)">Bus-Ticket</a>.</strong> All rights reserved.
</footer>
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
<div class="modal" id="myProcess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="transProcess" style=' width:317px; margin:10px auto' ><img src='<?= url();?>/dist/img/bigLoader.gif'  ><h4>Processing Request... Please Wait!</h4></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal" id="myDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Data Delete Console</h4>
            </div>
            <div class="modal-body delInfo">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href=""  class="del btn btn-primary" >Delete</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="{{url()}}/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="{{url()}}/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{url()}}/bootstrap/js/bootstrap.min.js"></script>

<script src="{{url()}}/plugins/select2/select2.full.min.js"></script>
<!-- iCheck -->
<script src="{{url()}}/plugins/iCheck/icheck.min.js"></script>

<script src="{{url()}}/dist/js/app.min.js"></script>
<script src="{{url()}}/dist/js/jquery.validate.min.js"></script>
<script src="{{url()}}/dist/js/jquery.form.min.js"></script>

