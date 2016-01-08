<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/30/15
 * Time: 12:12 PM
 */ ?>
@extends("layouts.default")
@section("content")
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12"> @if ( ! empty( $errors ) )
            @foreach ( $errors->all() as $error )
            <div class="alert alert-danger fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-times"></i>{{$error}}
            </div>
            @endforeach
            @endif</div>
        <div class="col-md-3">
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i>
                        @if(!empty($merchant->company))
                            {{$merchant->company}}
                        @else
                            @if(!empty($merchant->c_lname))
                                {{$merchant->c_fname}}
                            else
                                {{$merchant->c_fname}} {{$merchant_c_lname}}
                            @endif
                        @endif
                    </strong>
                    <p class="text-muted">
                        {{$merchant->address}}
                    </p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
                    <p class="text-muted">{{$merchant->phone}}</p>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p class="text-muted">{{$merchant->email}}</p>
                    <hr>
                    <h3><i class="glyphicon  margin-r-5">SLL</i> <?php echo $merchant->balance ?></h3>
                    <p class="text-muted"></p>
                    <hr>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#terminals" data-toggle="tab">Station(s)</a></li>
                    <li><a href="#history" data-toggle="tab">History</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="terminals">
                        <!-- Post -->
                        <div class="post">
                            <div class="row">
                                <div class="col-lg-2 pull-right">
                                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalTerminalNew">Add Busstop</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Station </th>
                                            <th>Balance</th>
                                            <th>GeoData</th>
                                            <th>Distance</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tblCompany">
                                        <?php
                                        if($mybusstops){
                                            foreach($mybusstops as $busstop){
                                                echo"
                                                <tr>
                                                    <td>$busstop->id</td>
                                                    <td>$busstop->name</td>";
                                                        $balance = \App\Account::where("app_id",$busstop->app_id)->pluck("balance");
                                                    echo"<td>$balance</td>
                                                    <td>$busstop->geodata</td>
                                                    <td>$busstop->distance</td>
                                                    <td><button class='edtBusstopLink btn-primary' cname='{$busstop->name}' croute_id='{$busstop->route_id}' cid='{$busstop->id}'  cdesc='$busstop->description' cgeodata='$busstop->geodata' cdistance='$busstop->distance' ><span  class='glyphicon glyphicon-pencil'></span></button></td>
                                                    <td><button  class='genTicket btn-primary' cname='{$busstop->name}' appid='{$busstop->app_id}' routeid='{$busstop->route_id}' stationid='{$busstop->station_id}'><span  class='fa fa-ticket'></span></button></td>
                                                    <td><button class='delLink btn-danger' dname='$busstop->name' url='/busesstop/busstopdelete/$busstop->id'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></button></td>
                                                </tr>
                                                ";
                                            }
                                        }else{
                                            echo"<tr><td colspan='8'>No Record Found</td> </tr>";
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Station </th>
                                            <th>Balance</th>
                                            <th>GeoData</th>
                                            <th>Distance</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.post -->
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="history">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class='row'>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </div><!-- /.tab-pane -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
<div class="modal fade" id="myModalTerminalNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addBusStop" action="{{ action('MerchantController@addBusStop') }}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Bus-stop</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="merchant_id" name="merchant_id" value="{{$merchant->id}}" />

                    <div class="form-group has-feedback">
                    <select class="form-control select2" name="short_name" id="short_name" style="width: 100%;">
                        @if($busstops)
                            @foreach($busstops as $busstop)
                                <option>{{$busstop->short_name}}</option>
                            @endforeach
                        @endif
                    </select>
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
<div class="modal fade" id="myModalBusNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regBusStop" action="{{ action('RouteController@addBusStop') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Bus-Stop</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Company name" required="">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" placeholder="Address" name="address" id="address"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="web url" name="web_url" id="weburl">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Company</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalBranchEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edtFrmBranch" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Site Detail</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden"  name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="_name" placeholder="Company name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" name="email" id="_email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" placeholder="Address" name="address" id="_address"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">

                        <input type="text" class="form-control" required="required" name="city" id="_city" placeholder="City">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">

                        <input type="text" class="form-control" name="state" id="_state" placeholder="State">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="phone" id="_phone" placeholder="Phone">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="web url" name="web_url" id="_weburl">
                        <input type="hidden" class="form-control" placeholder="web url" name="id" id="id">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalBranchNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regBranch"   method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Site</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="route_id" name="route_id" value="{{ $merchant->id }}" />

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Branch Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" required="" placeholder="Address" name="address" id="address"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" name="city" id="city" placeholder="City">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="state" id="state" placeholder="State">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="web url" name="web_url" id="weburl">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Site</button>
                </div>
            </form>
        </div>
    </div>
</div>





<div class="modal fade" id="myModalGenerateTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="genTickets" action="{{ action('TicketController@index') }}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Generate New Tickets </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="route_id" name="route_id" />
                    <input type="hidden" id="terminal_id" name="terminal_id" />
                    <input type="hidden" id="app_id" name="app_id" />

                    <input type="hidden" id="type" name="type" value="genticket" >


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