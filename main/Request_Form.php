<?php
@ob_start();
@session_start();
if (!isset($_SESSION['name']) || !isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    $_SESSION['name'] = '';
    $_SESSION['username'] = '';
    $_SESSION['password'] = '';
}
include_once("../connect/connect_db.php");
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
                                    <a href="calendar.php">
                                        <span class="hidden-xs">ปฏิทินปฏิบัติงาน</span>
                                    </a>
                                </li>
                                <li class="dropdown user user-menu active">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="hidden-xs">การลา</span>&nbsp;
                                        <span class="fa fa-caret-down"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="active"><a href="Request_Form.php">ยื่นการลา</a></li>
                                        <li><a href="Approve_leave.php">ตรวจสอบการอนุมัติ</a></li>
                                    </ul>
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
                            <li class="active"><a href="Request_Form.php">ลาป่วย ลาคลอด และลากิจ</a></li>
                            <li><a href="Quit_req_form.php">ลาพักผ่อนข้าราชการ</a></li>
                            <li><a href="Emp_req_form.php">ลาพักผ่อนพนักงานราชการ</a></li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-header with-border" style="background-color: #e0e0d1;">
                        <h3 class="box-title">แบบใบลาป่วย ลาคลอดบุตร และลากิจกิจส่วนตัว</h3>

                        <div class="box-tools pull-right">
                            <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <center> <h4>แบบใบลาป่วย ลาคลอดบุตร และลากิจกิจส่วนตัว</h4></center>
                                </div></br></br></br>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">เขียนที่</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="rf_write_place" placeholder="สถานที่ที่เขียน">
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
                                                <label  style="padding-top: 8px">
                                                    <?php
                                                    $today = date("d/m/y");
                                                    echo $today;
                                                    ?>
                                                </label>
                                                <input type="hidden" class="form-control" value="<?php $today = date("d/m/y");
                                                    echo $today; ?>" id="rf_dateFU" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">เรื่อง</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="rf_toppic" placeholder="">
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
                                                <input type="text" class="form-control" id="rf_requst" placeholder="">
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
                                                <input type="text" class="form-control" id="rf_name" placeholder="กรอกชื่อ" value="<?php echo $_SESSION['name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">ตำแหน่ง</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="rf_position" placeholder="กรอกชื่อตำแหน่ง">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ระดับ</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="rf_level" placeholder="กรอกระดับ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">บัตรเลขที่</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="rf_Codid" placeholder="กรอกหมายเลขบัตร">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">สังกัด</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="rf_department" placeholder="กรอกสังกัด">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ขอลา</label>
                                            <div class="col-sm-9">
                                                <div class="form-group" id='rf_r2f' style="margin-left: 10px">
                                                    <label>
                                                        <input type="radio" name="rf_r2" class="minimal-red" value="ป่วย">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspป่วย
                                                    </label><br>
                                                    <label>
                                                        <input type="radio" name="rf_r2" class="minimal-red" value="กิจส่วนตัว">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspกิจส่วนตัว
                                                    </label><br>
                                                    <label>
                                                        <input type="radio" name="rf_r2" class="minimal-red" value="คลอดบุตร">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspคลอดบุตร
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group"><br>
                                            <label class="col-sm-12 control-label">เนื่องจาก</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group"><br>
                                            <div class="col-sm-12">
                                                <textarea type="text" class="form-control" id="rf_detail" placeholder="ระบุสาเหตุ"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ตั้งแต่วันที่</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="rf_BdateStart_f" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ถึงวันที่</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="rf_AdateStart_f" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">มีกำหนด</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="rf_num_f" placeholder="ระบุจำนวนวัน">
                                            </div>
                                            <label style="padding-top: 8px" class="col-sm-2">วัน</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 5px;">
                                            <center><label class="col-sm-4">ข้าพเจ้าได้ลา</label></center>
                                            <div class="col-sm-8">
                                                <div class="form-group" id='rf_r3l'>
                                                    <label>
                                                        <input type="radio" name="rf_r3" class="minimal-red" value="ป่วย">&nbsp&nbsp&nbsp&nbspป่วย
                                                    </label>&nbsp&nbsp
                                                    <label>
                                                        <input type="radio" name="rf_r3" class="minimal-red" value="กิจส่วนตัว">&nbsp&nbsp&nbsp&nbspกิจส่วนตัว
                                                    </label>&nbsp&nbsp
                                                    <label>
                                                        <input type="radio" name="rf_r3" class="minimal-red" value="คลอดบุตร">&nbsp&nbsp&nbsp&nbspคลอดบุตร
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label">ครั้งสุดท้ายตั้งแต่วันที่</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="rf_BdateStart_p" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ถึงวันที่</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="rf_AdateStart_p" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">มีกำหนด</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="rf_num_p" placeholder="ระบุจำนวนวัน">
                                            </div>
                                            <label class="col-sm-1 control-label">วัน</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่</label>
                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control" id="rf_contact" placeholder="กรอกที่อยู่ที่ติดต่อได้"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">หมายเลขโทรศัพท์</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="rf_fhone" placeholder="กรอกเบอร์โทรศักท์ที่ติดต่อได้">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <!--                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><br><br><br><br><br><br><br><br><br><br>
                                                                            <center><label style="text-decoration: underline;">สถิติการลาในปีงบประมานนี้</label><br><br>
                                                                                <table style="text-align: center;" class="table table-bordered">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <th style="text-align: center;">ประเภทลา</th>
                                                                                            <th style="text-align: center;">ลามาเเล้ว (วันทำการ)</th>
                                                                                            <th style="text-align: center;">ลาครั้งนี้ (วันทำการ)</th>
                                                                                            <th style="text-align: center;">รวมเป็น (วันทำการ)</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><span class="badge bg-yellow">ป่วย</span></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><span class="badge bg-yellow">กิจส่วนตัว</span></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><span class="badge bg-yellow">คลอดบุตร</span></td>
                                                                                            <td></td>
                                                                                            <td></td>
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
                                                            </div>-->

                                <div class="box-footer">
                                    <button type="reset" class="btn btn-danger pull-right">ยกเลิก</button>
                                    <button type="button" class="btn btn-info pull-right btn-save">บันทึก</button>
                                </div>
                        </form>
                        <!-- /.row -->
                    </div>
                </div>

            </section>
            <!-- /.content -->
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
                $(".btn-save").click(function () {
                    var arr = [];
                    arr.push($('#rf_write_place').val(), convertDigitIn($('#rf_dateFU').val()), $('#rf_toppic').val(), $('#rf_requst').val(), $('#rf_name').val(), $('#rf_position').val(), $('#rf_level').val(), $('#rf_Codid').val(), $('#rf_department').val()
                            , $('input[name=rf_r2]:checked', '#rf_r2f').val(), $('#rf_detail').val(), convertDigitIn($('#rf_BdateStart_f').val()), convertDigitIn($('#rf_AdateStart_f').val()), $('#rf_num_f').val(), $('input[name=rf_r3]:checked', '#rf_r3l').val(), convertDigitIn($('#rf_BdateStart_p').val())
                            , convertDigitIn($('#rf_AdateStart_p').val()), $('#rf_num_p').val(), $('#rf_contact').val(), $('#rf_fhone').val());
                    $.ajax({
                        url: "../control/form_leaveDB.php",
                        type: "post",
                        data: {RF: arr},
                        success: function (data) {
                            if (data == '1') {
                                window.location.href = 'RF_print.php';
                            } else {
                                window.location.href = 'Request_Form.php';
                            }
                        }
                    });
                });

                function convertDigitIn(str) {
                    return str.split('/').reverse().join('-');
                }
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
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                })
//                $('#rf_dateFU').datepicker({
//                    autoclose: true,
//                    format: 'dd/mm/yyyy'
//                })
                $('#rf_BdateStart_f').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                })
                $('#rf_AdateStart_f').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                })
                $('#rf_BdateStart_p').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                })
                $('#rf_AdateStart_p').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
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
