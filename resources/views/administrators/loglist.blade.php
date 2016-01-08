<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 4/27/15
 * Time: 4:31 PM
 */
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "All Logs";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["admin"]["sub"]["logs"]["active"] = false;
include("inc/nav.php");
$breadcrumbs["Administrator"] =""
?>
    <script src="../../js/app.config.js"></script>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php
        //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
        //$breadcrumbs["New Crumb"] => "http://url.com"
        //$breadcrumbs["Pages"] = "";
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Transaction <span>> Logs</span></h1>
                </div>

            </div>

            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->

                    <!-- WIDGET END -->

                    <!-- NEW WIDGET START -->
                    <article class="col-md-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blue" id="wid-id-2" data-widget-editbutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Logs </h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">

                                    <!--<div class="text-right">
                                        {{HTML::decode(HTML::linkRoute('useradd','<span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span> Add New',null,array("class"=>"btn btn-labeled btn-primary")))}}

                                    </div>-->
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Operator</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                            <th>Post Type</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                            <th>s</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--*/ $x = 1 /*--}}
                                        @foreach($logs as $page)
                                        <tr>
                                            <td>{{$x }}</td>
                                            <td>{{$page->user_id}},{{$page->operator}}</td>
                                            <td>{{$page->description}}</td>
                                            <td>{{$page->action}}</td>
                                            <td>{{$page->post_type}}</td>
                                            <td>{{$page->created_at}}</td>

                                            <td>
                                                @if($page->post_type=="page")
                                                {{HTML::linkRoute('editpage',"Edit",$page->post_id)}}
                                                @elseif($page->post_type=="post")
                                                {{HTML::linkRoute('editpost',"Edit",$page->post_id)}}
                                                @elseif($page->post_type=="category")
                                                {{HTML::linkRoute('listcat','Go to Listing')}}
                                                @elseif($page->post_type =="document category")
                                                {{HTML::linkRoute('documentlinkcat','Go to Listing')}}
                                                @elseif($page->post_type == "document")
                                                <?php $document = \Post::find($page->post_id);  ?>
                                                <span><a href="{{ASSETS_URL}}/{{$document->permalink}}" target="_blank" ><span><i class="fa fw fa-download"></i></span>View File</a></span>
                                                &nbsp; {} &nbsp;<span><a href="#" data-toggle="modal" data-target="#myModal{{$page->id}}"><i class="fa fa-trash">Approve</a></i></span> <!-- Modal -->
                                                <div class='modal fade' id='myModal{{$page->id}}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header  ' style="background-color: #3276B1; color:#fff">
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                                                    &times;
                                                                </button>
                                                                <h1 class='modal-title' id='myModalLabel'>Approve action {{$page->description}}</h1>
                                                            </div>
                                                            <div class='modal-body' id="mbody">

                                                                <div class='row' >
                                                                    <div class='col-md-12'>

                                                                        <input type="hidden" id="pgid{{$page->id}}" name="pgid" value="{{$page->id}}">

                                                                        <h2>Approve <b>{{$page->description}}</b> on the database ?</h2>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>
                                                                    Cancel
                                                                </button>
                                                                <button type='button' action="approve" class='btn btn-primary approve' dal="{{$page->post_id}}">
                                                                    Approve
                                                                </button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
                                                @elseif($page->post_type == "user")useredit
                                                {{HTML::linkRoute('useredit',"Verify",$page->post_id)}}
                                                @else
                                                @endif
</td>
                                            </td>
                                            <td></td>
                                        </tr>
                                        {{--*/ $x++ /*--}}
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->

                    <!-- NEW WIDGET START -->




                    <!-- WIDGET END -->

                </div>

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <!-- PAGE FOOTER -->
<?php
// include page footer
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
\Session::flush()
?>

    <!-- PAGE RELATED PLUGIN(S)
    <script src="..."></script>-->

    <script>

        $(document).ready(function() {
            // PAGE RELATED SCRIPTS
            $(".approve").each(function(){
                $(this).click(function(){
                    var d = $(this).attr("dal")
                    //alert(d)
                    var pgid = d  //($("#pgid"+d).val())
                    var n =$("#imgname"+d).val()
                    $("#mbody").html("<img src='<?php echo ASSETS_URL;?>/img/loading.gif' style='text-align: center'> ")
                    var request =  $.ajax({
                        url:"",
                        type:"post",
                        data:{id:pgid,action:"approve"},
                        dataType:"html"
                    })

                    request.done(function(data){
                        $("#mbody").html(data)

                    })

                    request.fail(function(){
                        alert("Request failed: ")
                    })
                    setInterval(function(){location.reload();  }, 3000);
                })
            })
        })

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>