﻿<?php
@ob_start();
@session_start();
if (!isset($_SESSION['name']) || !isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    $_SESSION['name'] = '';
    $_SESSION['username'] = '';
    $_SESSION['password'] = '';
}
include_once("../connect/connect_db.php");

function rev_date($date) {
    $array = explode("-", $date);
    $rev = array_reverse($array);
    $date = implode("/", $rev);
    return $date;
}

$cn = new connect;
$cn->con_db();
$sql = "select * from emp_req_form where erf_id = (select max(erf_id) from emp_req_form)";
$query = $cn->Connect->query($sql);
while ($rs = mysqli_fetch_array($query)) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>ระบบเว็บไซต์สำนักงาน สถิติจังหวัดสระบุรี</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.7 -->
            <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
            <!-- daterange picker -->
            <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
            <!-- bootstrap datepicker -->
            <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
            <!-- iCheck for checkboxes and radio inputs -->
            <link rel="stylesheet" href="../plugins/iCheck/all.css">
            <!-- Bootstrap Color Picker -->
            <link rel="stylesheet" href="../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
            <!-- Bootstrap time Picker -->
            <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
            <!-- Select2 -->
            <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Google Font -->
            <link rel="stylesheet"
                  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        </head>
        <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">
                <header class="main-header">
                    <!-- Logo -->
                    <a href="../index.php" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>A</b>LT</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>WSPSO</b> จังหวัดสระบุรี</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Login -->
                                <?php if ($_SESSION['name'] == '') { ?>
                                    <li class="dropdown user user-menu">
                                        <a href="../main/login.php">
                                            <span class="hidden-xs">เข้าสู่ระบบ</span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li class="dropdown user user-menu">
                                        <a href="#">
                                            <span class="hidden-xs">แก้ไขประชาสัมพันธ์</span>
                                        </a>
                                    </li>
                                    <li class="dropdown user user-menu">
                                        <a href="calendar.php">
                                            <span class="hidden-xs">ปฏิทินปฏิบัติงาน</span>
                                        </a>
                                    </li>
                                    <li class="dropdown user user-menu active">
                                        <a href="Request_Form.php">
                                            <span class="hidden-xs">ยื่นการลา</span>
                                        </a>
                                    </li>
                                    <?php if ($_SESSION['claim_id'] == '2') { ?>
                                        <li class="dropdown user user-menu active">
                                            <a href="App_leave_sec.php">
                                                <span class="hidden-xs">อนุมัติการลา</span>
                                                <?php
                                                $cn = new connect;
                                                $cn->con_db();
                                                $sql = "select * from request_form where rf_status = '0'";
                                                $query = $cn->Connect->query($sql);
                                                $num = mysqli_num_rows($query);

                                                $sql1 = "select * from emp_req_form where erf_status = '0'";
                                                $query1 = $cn->Connect->query($sql1);
                                                $num1 = mysqli_num_rows($query1);

                                                $sql2 = "select * from quit_req_form where qrf_status = '0'";
                                                $query2 = $cn->Connect->query($sql2);
                                                $num2 = mysqli_num_rows($query2);
                                                if ($num + $num1 + $num2 != '0') {
                                                    ?>
                                                    <span class = "label label-warning">
                                                        <?php
                                                        echo $num + $num1 + $num2;
                                                        ?>
                                                    </span>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="dropdown user user-menu">
                                        <a href="Report.php">
                                            <span class="hidden-xs">รายงานการลา</span>
                                        </a>
                                    </li>

                                    <li class="dropdown user user-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                            <span class="hidden-xs"><?php echo $_SESSION['name'] ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- User image -->
                                            <li class="user-header">
                                                <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                                <p>
                                                    <?php echo $_SESSION['name'] ?>
                                                    <small>ตำแหน่ง <?php echo $_SESSION['position'] ?></small>
                                                </p>
                                            </li>
                                            <!-- Menu Footer-->
                                            <li class="user-footer">
                                                <div class="pull-left">
                                                    <a href="#" class="btn btn-default btn-flat">เปลี่ยนรหัส</a>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="logout.php" class="btn btn-default btn-flat">ล็อคเอ้าท์</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </nav>
                </header>


                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="input-group input-group-lg">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> เลือกประเภทการลา
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="Request_Form.php">ลาป่วย ลาคลอด และลากิจ</a></li>
                                <li><a href="Quit_req_form.php">ลาพักผ่อนข้าราชการ</a></li>
                                <li class="active"><a href="Emp_req_form.php">ลาพักผ่อนลูกจ้างทั่วไป</a></li>
                            </ul>
                        </div>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">Advanced Elements</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box box-default" id="fm_print">
                        <div class="box-header with-border">
                            <h3 class="box-title">แบบคำร้องขอลาพักผ่อน ลูกจ้างทั่วไป</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form class="form-horizontal">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <center> <h4>แบบคำร้องขอลาพักผ่อน ลูกจ้างทั่วไป</h4></center>
                                    </div></br></br></br>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">เขียนที่</label>
                                                <div class="col-sm-10">
                                                    <label class="control-label"><?php echo $rs['erf_write_place']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">วันเดือนปี</label>
                                                <div class="col-sm-10">
                                                    <label class="control-label"><?php echo rev_date($rs['erf_dateFU']); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">เรื่อง</label>
                                                <div class="col-sm-10">
                                                    <label style="padding-top: 8px">ขอลาพักผ่อน</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">เรียน</label>
                                                <div class="col-sm-10">
                                                    <label class="control-label"><?php echo $rs['erf_requst']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">ข้าพเจ้า</label>
                                                <div class="col-sm-10">
                                                    <label class="control-label"><?php echo $rs['erf_name']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">บัตรเลขที่</label>
                                                <div class="col-sm-10">
                                                    <label class="control-label"><?php echo $rs['erf_Codid']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">สำนัก/กอง</label>
                                                <div class="col-sm-10">
                                                    <label class="control-label"><?php echo $rs['erf_office']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="margin-left: -13em" class="form-group">
                                                <label class="col-sm-4 control-label">ได้รับการบรรจุเมื่อวันที่</label>
                                                <div class="col-sm-8">
                                                    <label class="control-label"><?php echo rev_date($rs['erf_income']); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">มีสิทธิลาพักผ่อนประจำปี 10 วันทำการ</label>
                                                <div class="col-sm-6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div style="margin-left: -4em" class="form-group">
                                                <label class="col-sm-4 control-label">ขอลาพักผ่อนตั้งแต่วันที่</label>
                                                <div class="col-sm-8">
                                                    <label class="control-label"><?php echo rev_date($rs['erf_BdateStart_f']); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ถึงวันที่</label>
                                                <div class="col-sm-8">
                                                    <label class="control-label"><?php echo rev_date($rs['erf_AdateStart_f']); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">มีกำหนด</label>
                                                <div class="col-sm-2">
                                                    <label class="control-label"><?php echo $rs['erf_num_f']; ?></label>
                                                </div>
                                                <label style="padding-top: 8px" class="col-sm-2">วัน</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="margin-left: -3em" class="form-group">
                                                <label class="col-sm-3 control-label">ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่</label>
                                                <div class="col-sm-9">
                                                    <label class="control-label"><?php echo $rs['erf_contact']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">หมายเลขโทรศัพท์</label>
                                                <div class="col-sm-9">
                                                    <label class="control-label"><?php echo $rs['erf_fhone']; ?></label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><br><br>
                                            <center><label style="text-decoration: underline;">สถิติการลาในปีงบประมานนี้</label><br><br>
                                                <table style="text-align: center;" class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th style="text-align: center;">จำนวนครั้งที่ลา</th>
                                                            <th style="text-align: center;">จำนวนวันลา (วันทำการ)</th>
                                                        </tr>
                                                        <tr>
                                                            <td><b>1</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>2</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>3</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>4</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>5</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>6</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>7</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>8</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>9</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>10</b></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody></table>

                                            </center>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <br>  <br>  <br>  <br>
                                            <label class="col-sm-3 control-label">(ลงชื่อ)</label>
                                            <label style="text-align: center;"class="col-sm-9 control-label">...............................................................................................</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <label style="text-align: center;"class="col-sm-9 control-label">(.............................................................................................)</label>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label style="text-decoration: underline;" class="col-sm-5 control-label">ความเห็นผู้บังคับบัญชา</label><br><br>
                                            <div class="col-sm-12">
                                                <label style="text-align: center;"class="col-sm-9 control-label">.........................................................................................................................................</label><br>
                                            </div>
                                            <div class="col-sm-12">
                                                <label style="text-align: center;"class="col-sm-9 control-label">.........................................................................................................................................</label>
                                            </div><br><br><br>
                                            <div class="col-md-12" >
                                                <label style="text-align: center;" class="col-sm-12 control-label">(ลงชื่อ) ...........................................................................................................................</label><br><br>
                                            </div><br>
                                            <div class="col-md-12" >
                                                <label style="text-align: center;" class="col-sm-12 control-label">(ตำแหน่ง) ......................................................................................................................</label><br><br>
                                            </div><br>
                                            <div class="col-md-12" >
                                                <label style="text-align: center;" class="col-sm-12 control-label">(วันที่) ................................/............................................../.............................................</label><br><br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="text-decoration: underline;" class="col-sm-3 control-label">คำสั่ง</label><br><br>
                                            <div class="col-sm-12">
                                                <label>
                                                    <input type="checkbox" class="minimal" disabled>
                                                    อนุญาต
                                                </label>
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <label>
                                                    <input type="checkbox" class="minimal" disabled>
                                                    ไม่อนุญาต
                                                </label>
                                            </div>
                                            <div class="col-sm-12">
                                                <label style="text-align: center;"class="col-sm-9 control-label">.........................................................................................................................................</label><br>
                                                <label style="text-align: center;"class="col-sm-9 control-label">.........................................................................................................................................</label><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">(ลงชื่อ) ............................................................................ ผู้ตรวจสอบ</label><br><br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">(ลงชื่อ) .................................................................................... </label><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">(....................................................................................)</label><br><br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">(....................................................................................)</label><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">ตำแหน่ง .................................................................................... </label><br><br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">ตำแหน่ง .................................................................................... </label><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">วันที่ .........................../................................/......................... </label><br><br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="text-align: center;" class="col-sm-12 control-label">วันที่ .........................../................................/......................... </label><br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="reset" class="btn btn-danger pull-right btn-cancel">ย้อนกลับ</button>
                                <button type="button" class="btn btn-info pull-right btn-print">พิมพ์</button>
                            </div>
                        </form>
                        <!-- /.row -->
                    </div>
                </div>

            </section>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>
            <!-- ./wrapper -->
        </div>

        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="../plugins/input-mask/jquery.inputmask.js"></script>
        <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="../bower_components/moment/min/moment.min.js"></script>
        <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- bootstrap color picker -->
        <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- SlimScroll -->
        <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="../plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="../bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <!-- Page script -->
        <script>
            $(function () {
                $(".btn-print").click(function () {
                    //Hide all other elements other than printarea.
                    var printBlock = $(".fm_print");
                    printBlock.hide();
                    window.print();
                    printBlock.show();

                });
                $(".btn-cancel").click(function () {
                    window.location.href = 'Emp_req_form.php';
                });

                //Initialize Select2 Elements
                $('.select2').select2()

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
                //Money Euro
                $('[data-mask]').inputmask()

                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            },
                            startDate: moment().subtract(29, 'days'),
                            endDate: moment()
                        },
                        function (start, end) {
                            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                        }
                )

                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                })

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                })
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                })
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                //Timepicker
                $('.timepicker').timepicker({
                    showInputs: false
                })
            })
        </script>
    </body>
</html>
