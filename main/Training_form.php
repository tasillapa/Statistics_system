﻿<?php
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
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="hidden-xs">การลา</span>&nbsp;
                                        <span class="fa fa-caret-down"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php if ($_SESSION['claim_id'] != '2') { ?>
                                            <li class="active"><a href="Request_Form.php">ยื่นการลา</a></li>
                                        <?php } ?>
                                        <li><a href="Approve_leave.php">ตรวจสอบการอนุมัติ</a></li>
                                    </ul>
                                </li>
                                <?php if ($_SESSION['claim_id'] == '2') { ?>
                                    <li class="dropdown user user-menu">
                                        <a href="ConfirmRegister.php">
                                            <span class="hidden-xs">อนุมัติผู้ใช้งาน</span>
                                            <?php
                                            $cn = new connect;
                                            $cn->con_db();
                                            $sql = "select * from member where status = '0'";
                                            $query = $cn->Connect->query($sql);
                                            $num = mysqli_num_rows($query);
                                            if ($num != '0') {
                                                ?>
                                                <span class = "label label-warning">
                                                    <?php
                                                    echo $num;
                                                    ?>
                                                </span>
                                                <?php
                                            }
                                            ?>
                                        </a>
                                    </li>
                                    <li class="dropdown user user-menu">
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
                                <li class="dropdown user user-menu active">
                                    <a href="Training_form.php">
                                        <span class="hidden-xs">การอบรม</span>
                                    </a>
                                </li>
                                <li class="dropdown user user-menu">
                                    <a href="Report.php">
                                        <span class="hidden-xs">รายงาน</span>
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

            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-header with-border" style="background-color: #e0e0d1;">
                        <h3 class="box-title">แบบฟอร์มขออบรมนอกสถานที่</h3>

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
                                    <center> <h4>แบบฟอร์มขออบรมนอกสถานที่</h4></center>
                                </div></br></br></br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">เรื่อง</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tf_toppic" placeholder="">
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
                                                <input type="text" class="form-control" id="tf_name" placeholder="กรอกชื่อ" value="<?php echo $_SESSION['name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">ตำแหน่ง</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tf_position" placeholder="กรอกชื่อตำแหน่ง" value="<?php echo $_SESSION['position'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">ระดับ</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tf_level" placeholder="กรอกระดับ" value="<?php echo $_SESSION['level'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label">วันออกปฏิบัติหน้าที่</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="tf_date_start" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ถึงวันที่</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="tf_date_end" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" style="text-align: left;">มีกำหนด</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="tf_num" placeholder="ระบุจำนวนวัน">
                                            </div>
                                            <label class="col-sm-1 control-label">วัน</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-sm-1 control-label"></label>
                                                <input type="file" id="tf_file">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <label></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="reset" class="btn btn-danger pull-right">ยกเลิก</button>
                                    <button type="button" class="btn btn-info pull-right btn-save">บันทึก</button>
                                </div>
                        </form>
                        <!-- /.row -->
                    </div>
                </div>

            </section>
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
                    var Improfile = $('#tf_file').prop('files')[0];
                    var form_data_img = new FormData();
                    form_data_img.append('inputFile', Improfile);
                    $.ajax({
                        url: '../control/trainingDB.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data_img,
                        type: 'post',
                        success: function (data) {
                            if (data.length == 1) {
                                data = '';
                            }
                            var arr = [];
                            arr.push($('#tf_toppic').val(), $('#tf_name').val(), $('#tf_position').val(), $('#tf_level').val(), convertDigitIn($('#tf_date_start').val()), convertDigitIn($('#tf_date_end').val()), $('#tf_num').val(), data);
                            $.ajax({
                                url: "../control/trainingDB.php",
                                type: "post",
                                data: {training: arr},
                                success: function (data) {
                                    window.location.href = 'Report.php';
                                }
                            });
                        }
                    });

                });

                function convertDigitIn(str) {
                    return str.split('/').reverse().join('-');
                }

                $('#tf_date_start').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                })
                $('#tf_date_end').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                })

                $('#tf_date_end').change(function () {
                    if (($('#tf_date_start').val() != '') && ($('#tf_date_end').val() != '')) {
                        $('#tf_num').val(jsDateDiff(convertDigitIn($('#tf_date_start').val()), convertDigitIn($('#tf_date_end').val())));
                    }
                });
                $('#tf_date_start').change(function () {
                    if (($('#tf_date_start').val() != '') && ($('#tf_date_end').val() != '')) {
                        $('#tf_num').val(jsDateDiff(convertDigitIn($('#tf_date_start').val()), convertDigitIn($('#tf_date_end').val())));
                    }
                });
                function jsDateDiff(strDate1, strDate2) {
                    var theDate1 = Date.parse(strDate1) / 1000;
                    var theDate2 = Date.parse(strDate2) / 1000;
                    var diff = (theDate2 - theDate1) / (60 * 60 * 24);
                    return diff;
                }

            })
        </script>
    </body>
</html>
