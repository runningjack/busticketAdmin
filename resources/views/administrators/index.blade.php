<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 10/13/15
 * Time: 12:08 PM
 */ ?>
@extends("layouts.tablelayout")
@section("content")
<div class="row">
    <div class="col-lg-2 pull-right">
        <a href="{{url()}}/administrators/addnew" class="btn btn-block btn-primary">Add New User</a>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <div class="box-body">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Sn</th>
                <th>Full name</th>
                <th>email</th>
                <th>username</th>
                <th>Telephone</th>

                <th>Date Added</th>
                <th>Action</th>
                <th>s</th>
            </tr>
            </thead>
            <tbody id="tblCompany">
            {{--*/ $x = 1 /*--}}
            @foreach($users as $user)
            <tr>
                <td>{{$x }}</td>
                <td>{{$user->firstname}} {{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->created_at}}</td>
                <td><a href="{{url()}}/administrators/edituser/{{$user->id}}" class='btn btn-primary'><span  class='glyphicon glyphicon-pencil'></span></a></td>
                <td><a class='delLink btn-danger' dname='{{$user->firstname}}' url='/administrators/deleteuser/{{$user->id}}'  data-target='#myDelete' data-toggle='modal'><span  class='glyphicon glyphicon-trash'></span></a></td>
            </tr>
            {{--*/ $x++ /*--}}
            @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@stop
