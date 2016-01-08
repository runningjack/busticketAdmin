<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/25/15
 * Time: 3:41 PM
 */?>

@extends("layouts.tablelayout")
@section("content")



<div class="row">
    <div class="col-lg-2 pull-right">
        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalBusNew">Add New Bus</button>
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
                <th ></th>
                <th ></th>
            </tr>
            </thead>
            <tbody id="tblCompany">
            <?php
            if($buses){
                foreach($buses as $bus){
                    echo"
                        <tr>
                            <td>$bus->id</td>
                            <td><a href='".url()."/buses/busesdetails/$bus->id'>$bus->name</a></td>
                            <td>$bus->model</td>
                            <td>$bus->plate_no</td>
                            <td>$bus->chases_no</td>
                            <td>$bus->number_of_sitters</td>
                            <td>$bus->bus_color</td>
                            <td><button class='edtBusLink btn-primary' ccolor='{$bus->bus_color}' crouteid='{$bus->route_id}' cid='{$bus->id}' cname='{$bus->name}' cmodel='$bus->model' cplateno='$bus->plate_no' cchasis='$bus->chases_no' csitno='$bus->number_of_sitters' ><span  class='glyphicon glyphicon-pencil'></span></button></td>
                            <td><button class='delLink btn-danger' dname='$bus->name' url='/buses/busdelete/$bus->id'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></button></td>
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
                <th ></th>
                <th ></th>
            </tr>
            </tfoot>
        </table>


        <?php echo \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate("Amedora33") ."<br>"?>
        <?php $uuid1 = Ramsey\Uuid\Uuid::uuid5(Ramsey\Uuid\Uuid::NAMESPACE_DNS, 'Amedora33');; echo $uuid1->toString() ."<br>"?>
        <?php  echo strtoupper(uniqid()) ."<br>"?>
        <?php printf("uniqid('php_'): %s\r\n", uniqid('php_')); ?>
    </div><!-- /.box-body -->
</div><!-- /.box -->






<div class="modal fade" id="myModalBusNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regBus"  method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Bus</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Bus Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" name="model" id="model" class="form-control" placeholder="Model">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <textarea class="form-control" placeholder="Plate Number" name="plate_no" id="plate_no"></textarea>
                            <span class="glyphicon glyphicon-home form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="chases_no" id="chases_no" placeholder="Chases Number">
                            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Color" name="bus_color" id="bus_color">
                            <span class="glyphicon glyphicon-link form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="number" class="form-control" placeholder="Color" name="number_of_sitters" id="number_of_sitters">
                            <span class="glyphicon glyphicon-link form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <select class="form-control" name="route_id" id="route_id" required="required">
                                <option value="">--SELECT ROUTE--</option>
                                <?php
                                if($routes){
                                    foreach($routes as $route){
                                        echo "<option value='$route->id'>$route->name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Bus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalBusEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edtBus" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Bus Detail</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" id="_name" placeholder="Bus Name">
                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="type" id="type" value="edit">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="model" id="_model" class="form-control" placeholder="Model">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control" placeholder="Plate Number" name="plate_no" id="_plate_no"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="chases_no" id="_chases_no" placeholder="Chases Number">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Color" name="bus_color" id="_bus_color">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="number" class="form-control" placeholder="Number of Sits" name="number_of_sitters" id="_number_of_sitters">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <select class="form-control" name="route_id" id="_route_id" required="required">
                            <option value="">--SELECT ROUTE--</option>
                            <?php
                            if($routes){
                                foreach($routes as $route){
                                    echo "<option value='$route->id'>$route->name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop