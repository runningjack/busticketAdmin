<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/25/15
 * Time: 12:03 PM
 */?>
@extends("layouts.tablelayout")
@section("content")
<div class="row">
    <div class="col-lg-2 pull-right">
        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalRouteNew">Add New Route</button>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <div class="row">
        <div class="col-xs-12">
            <?php  ?>
            @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-success fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-check"></i>{{\Illuminate\Support\Facades\Session::get('message')}}
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('success_message'))
            <div class="alert alert-success fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-check"></i>{{\Illuminate\Support\Facades\Session::get('success_message')}}
            </div>
            @endif
            @if(Session::has('error_message'))
            <div class="alert alert-danger fade in">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
            </div>
            @endif


            <div class="col-xs-12"> @if ( ! empty( $errors ) )
                @foreach ( $errors->all() as $error )
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    <i class="fa-fw fa fa-times"></i>{{$error}}

                </div>

                @endforeach
                @endif</div>
        </div>
    </div>
    <div class="box-body">

        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Short Name</th>
                <th>Description</th>
                <th>Distance</th>
                <th>No of Stops</th>
                <th ></th>
                <th ></th>
            </tr>
            </thead>
            <tbody id="tblCompany">
            <?php
            if($routes){
                foreach($routes as $route){
                    echo"
                        <tr>
                            <td>$route->id</td>
                            <td><a href='".url()."/routes/routedetails/$route->id'>$route->name</a></td>
                            <td>$route->short_name</td>
                            <td>$route->description</td>
                            <td>$route->distance</td>
                            <td>$route->no_of_busstop</td>
                            <td><button class='edtRouteLink btn-primary' cdistance='{$route->distance}' cid='{$route->id}' cname='{$route->name}' cshort='{$route->short_name}' cdesc='$route->description' cbusstops='$route->no_of_busstop' ><span  class='glyphicon glyphicon-pencil'></span></button></td>
                            <td><button class='delLink btn-danger' dname='$route->name' url='/routes/routedelete/$route->id'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></button></td>
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
                <th>Email</th>
                <th>Telephone</th>
                <th>Address</th>
                <th>Url</th>
                <th colspan="2">Action</th>
            </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->



<div class="modal fade" id="myModalRouteNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regRoute" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Route</h4>
                </div>
                <div class="modal-body">

                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Route name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" name="short_name" id="short_name" class="form-control" placeholder="Short Name">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <textarea class="form-control" placeholder="Description" name="description" id="description"></textarea>
                            <span class="glyphicon glyphicon-home form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="distance" id="distance" placeholder="Distance In KM">
                            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="number" class="form-control" placeholder="Number of Bus-Stops" name="no_of_busstop" id="no_of_busstop">
                            <span class="glyphicon glyphicon-link form-control-feedback"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Route </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalRouteEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edtFrmRoute" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Route Detail</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden"  name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="id" name="id" >
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="_name" placeholder="Route name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="short_name" id="_short_name" class="form-control" placeholder="Short Name">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" placeholder="Description" name="description" id="_description"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="distance" id="_distance" placeholder="Distance In KM">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="number" class="form-control" placeholder="Number of Bus-Stops" name="no_of_busstop" id="_no_of_busstop">
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
@stop