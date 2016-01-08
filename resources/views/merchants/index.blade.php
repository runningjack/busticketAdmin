<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 11/30/15
 * Time: 6:42 AM
 */?>
@extends("layouts.tablelayout")
@section("content")
<div class="row">
    <div class="col-lg-2 pull-right">
        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModalMerchantNew">Add New Merchant</button>
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
                <th>Contact</th>
                <th>Company</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th ></th>
                <th ></th>
            </tr>
            </thead>
            <tbody id="tblCompany">
            <?php
            if($merchants){
                foreach($merchants as $merchant){
                    echo"
                        <tr>
                            <td>$merchant->id</td>
                            <td><a href='".url()."/merchants/merchantdetails/$merchant->id'>$merchant->c_fname $merchant->c_lname</a></td>
                            <td>$merchant->company</td>
                            <td>$merchant->address</td>
                            <td>$merchant->phone</td>
                            <td>$merchant->email</td>
                            <td><button class='edtMerchantLink btn-primary' clname='{$merchant->c_lname}' cfname='{$merchant->c_fname}' cid='{$merchant->id}' ccompany='{$merchant->company}' caddress='{$merchant->address}' cphone='$merchant->phone' cemail='$merchant->email' ><span  class='glyphicon glyphicon-pencil'></span></button></td>
                            <td><button class='delLink btn-danger' dname='$merchant->c_fname $merchant->c_lname' url='/merchants/merchantdelete/$merchant->id'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></button></td>
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
                <th>Contact</th>
                <th>Company</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th ></th>
                <th ></th>
            </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->



<div class="modal fade" id="myModalMerchantNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="regMerchant" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add Merchant</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="company" id="company" placeholder="Company">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" name="c_fname" id="c_fname" placeholder="Contact First Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="c_lname" required="required" id="c_lname" class="form-control" placeholder="Contact Last Name">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control"  placeholder="Description" name="address" id="address"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" name="city" id="city" placeholder="City">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" placeholder="State" name="state" id="state">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" placeholder="Telephone" name="phone" id="phone">
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Merchant </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="myModalMerchantEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edtMerchant" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Merchant</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="id" name="id">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="company" id="_company" placeholder="Company">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" name="_c_fname" id="c_fname" placeholder="Contact First Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="c_lname" required="required" id="_c_lname" class="form-control" placeholder="Contact Last Name">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea class="form-control"  placeholder="Description" name="address" id="_address"></textarea>
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" name="city" id="_city" placeholder="City">
                        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" placeholder="State" name="state" id="_state">
                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required="required" placeholder="Telephone" name="phone" id="_phone">
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="_email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Add Merchant </button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop