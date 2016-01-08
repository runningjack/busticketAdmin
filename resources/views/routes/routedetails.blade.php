<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/26/15
 * Time: 5:23 AM
 */?>

<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 10/15/15
 * Time: 10:43 AM
 */
?>
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
            <strong><i class="fa fa-book margin-r-5"></i>{{$thisroute->short_name}}</strong>
            <p class="text-muted">
                {{$thisroute->name}}
            </p>
            <hr>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Description</strong>
            <p class="text-muted">{{$thisroute->description}}</p>
            <hr>
            <?php //print_r(\Illuminate\Support\Facades\Session::get("padat")) ?>
            <!--<div class="row">
                <div class="col-lg-8 pull-left">
                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalGenerateInvoice">Generate Invoice</button>
                </div>
            </div>-->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->
<div class="col-md-9">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
    <li class="active"><a href="#stations" data-toggle="tab">Stations</a></li>
    <li><a href="#buses" data-toggle="tab">Buses</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="stations">
    <!-- Post -->
    <div class="post">
        <div class="row">
            <div class="col-lg-2 pull-right">
                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalBusStopNew">Add New Station</button>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Name</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>GeoData</th>
                        <th>Distance</th>

                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tblCompany">
                    <?php
                    if($busstops){
                        foreach($busstops as $busstop){
                            echo"
                        <tr>
                            <td>$busstop->id</td>
                            <td>$busstop->short_name</td>
                            <td>$busstop->name</td>
                            <td>$busstop->description</td>
                            <td>$busstop->geodata</td>
                            <td>$busstop->distance</td>
                            <td><button class='edtBusstopLink btn-primary' cshort='{$busstop->short_name}' cname='{$busstop->name}' croute_id='{$busstop->route_id}' cid='{$busstop->id}'  cdesc='$busstop->description' cgeodata='$busstop->geodata' cdistance='$busstop->distance' conewayto='$busstop->one_way_to_fare' conewayfro='$busstop->one_way_from_fare'><span  class='glyphicon glyphicon-pencil'></span></button></td>
                            <td><button class='delLink btn-danger' dname='$busstop->name' url='/busesstop/busstopdelete/$busstop->id'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></button></td>
                        </tr>
                        ";
                        }
                    }else{
                        echo"<tr><td colspan='7'>No Record Found</td> </tr>";
                    }
                    ?>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Short Name</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>GeoData</th>
                        <th>Distance</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>


    </div><!-- /.post -->

</div><!-- /.tab-pane -->
<div class="tab-pane" id="buses">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Buses</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Plate No</th>
                    <th>Chases No</th>
                    <th>No of Sitter</th>
                    <th>Bus Color</th>

                </tr>
                </thead>
                <tbody id="tblCompany">
                <?php
                if($buses){
                    foreach($buses as $bus){
                        echo"
                        <tr>
                            <td>$bus->id</td>
                            <td>$bus->name</td>
                            <td>$bus->model</td>
                            <td>$bus->plate_no</td>
                            <td>$bus->chases_no</td>
                            <td>$bus->number_of_sitters</td>
                            <td>$bus->bus_color</td>
                        </tr>
                        ";
                    }
                }else{
                    echo"<tr><td colspan='7'>No Record Found</td> </tr>";
                }
                ?>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Plate No</th>
                    <th>Chases No</th>
                    <th>No of Sitter</th>
                    <th>Bus Color</th>
                </tr>
                </tfoot>
            </table>
            <div class='row'>
                <!--<div class="col-lg-2 pull-right">
                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalBranchNew">Add New Site</button>
                </div>-->
            </div>
        </div><!-- /.box-body -->
    </div>
</div><!-- /.tab-pane -->

</div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
<div class="modal fade" id="myModalBusStopNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regBusStop" action="{{ action('RouteController@addBusStop') }}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Station</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="route_id" name="route_id" value="{{$thisroute->id}}" />
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="short_name" id="short_name" placeholder="Short Name">
                        <span class="glyphicon glyphicon-stop form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name of Bus-stop">
                        <span class="glyphicon glyphicon-screenshot form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                        <span class="glyphicon glyphicon-comment form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="geodata" id="geodata" placeholder="Geographical Data">
                        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="distance" id="distance" placeholder="Distance (eg 5KM)">
                        <span class="glyphicon glyphicon-road form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="one_way_to_fare" class="form-control" name="distance" id="one_way_to_fare" placeholder="To Fare Cost">
                        <span class="fa fa-money form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="one_way_from_fare" class="form-control" name="distance" id="one_way_from_fare" placeholder="From Fare Cost">
                        <span class="fa fa-money form-control-feedback"></span>
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

<div class="modal fade" id="myModalBusStopEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edtBusStop" action="{{ action('RouteController@addBusStop') }}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Station</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="_route_id" name="route_id" value="{{$thisroute->id}}" />
                    <input type="hidden"  name="type" value="edit" />
                    <input type="hidden" id="id" name="id">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="short_name" id="_short_name" placeholder="Short Name">
                        <span class="glyphicon glyphicon-stop form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="_name" placeholder="Full Name of Bus-stop">
                        <span class="glyphicon glyphicon-screenshot form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="description" id="_description" placeholder="Description">
                        <span class="glyphicon glyphicon-comment form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="geodata" id="_geodata" placeholder="Geographical Data">
                        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="distance" id="_distance" placeholder="Distance (eg 5KM)">
                        <span class="glyphicon glyphicon-road form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="one_way_to_fare" id="_one_way_to_fare" placeholder="To Fare Cost">
                        <span class="fa fa-money form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="one_way_from_fare" id="_one_way_from_fare" placeholder="From Fare Cost">
                        <span class="fa fa-money form-control-feedback"></span>
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


<div class="modal fade" id="myModalBus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regBusStop" action="{{ action('RouteController@addBusStop') }}"  method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Bus</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="route_id" name="route_id" value="{{$thisroute->id}}" />
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="short_name" id="short_name" placeholder="Short Name">
                        <span class="glyphicon glyphicon-stop form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name of Bus-stop">
                        <span class="glyphicon glyphicon-screenshot form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                        <span class="glyphicon glyphicon-comment form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="geodata" id="geodata" placeholder="Geographical Data">
                        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="distance" id="distance" placeholder="Distance (eg 5KM)">
                        <span class="glyphicon glyphicon-road form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="one_way_to_fare" class="form-control" name="distance" id="one_way_to_fare" placeholder="To Fare Cost">
                        <span class="fa fa-money form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="one_way_from_fare" class="form-control" name="distance" id="one_way_from_fare" placeholder="From Fare Cost">
                        <span class="fa fa-money form-control-feedback"></span>
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





