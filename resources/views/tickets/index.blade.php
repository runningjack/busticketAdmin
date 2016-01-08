<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/30/15
 * Time: 9:11 PM
 */
?>
@extends("layouts.default")
@section("content")
<div class="row">
    <div class="col-lg-2 pull-right">
        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalGenerateTicket">Generate Tickets</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <?php
                        if($stacks){
                            foreach($stacks as $stack){
                              echo "  <div class='panel box box-primary'>
                        <div class='box-header with-border'>
                            <h4 class='box-title'>
                                <a data-toggle='collapse' data-parent='#accordion' href='#stack$stack->id' aria-expanded='false' class='collapsed'>
                                $stack->batch_code
                                </a>
                            </h4>
                        </div>
                        <div id='stack$stack->id' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
                            <div class='box-body'>
                                Tiisisi
                            </div>
                        </div>
                    </div>";
                            }
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="myModalGenerateTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="genTickets" action="{{ action('TicketController@index') }}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Generate New Tickets By Terminal</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group has-feedback">
                        <label>Select Bus Terminal</label>
                        <select class="form-control select2" name="terminal_id" id="terminal_id" style="width: 100%;">
                            <option value="">--SELECT BUS TERMINAL--</option>
                            @if($busstops)
                            @foreach($busstops as $busstop)
                            <option>{{$busstop->short_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        <label>Trip Type</label>
                        <select class="form-control " name="ticket_type" id="ticket_type" style="width: 100%;">
                            <option value="">--SELECT TRIP TYPE--</option>
                            <option value="1">One way trip</option>
                            <option value="2">Return trip</option>
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        <label>Number of tickets</label>
                        <input type="text" name="qty" id="qty" class="form-control" placeholder="Quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop