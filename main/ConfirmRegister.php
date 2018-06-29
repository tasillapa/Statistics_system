<?php
@ob_start();
@session_start();
if (!isset($_SESSION['name']) || !isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    $_SESSION['name'] = '';
    $_SESSION['username'] = '';
    $_SESSION['password'] = '';
}

function rev_date($date) {
    $array = explode("-", $date);
    $rev = array_reverse($array);
    $date = implode("/", $rev);
    return $date;
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
        <!-- DataTables -->
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                                    <li class="dropdown user user-menu active">
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
                                <li class="dropdown user user-menu">
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

            <section class="content" id="official">
                <div class="box box-default">
                    <div class="box-header with-border" style="background-color: #e0e0d1;">
                        <h3 class="box-title">คำร้องขอเข้าใช้งานระบบ</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ลำดับ</th>
                                    <th style="width: 10%;">ชื่อ-สกุล</th>
                                    <th style="width: 15%;">ประเภท</th>
                                    <th style="width: 15%;">ตำแหน่ง</th>
                                    <th style="width: 10%;">ระดับ</th>
                                    <th style="width: 20%;">สังกัด/สำนัก</th>
                                    <th style="width: 10%;">วันที่บรรจุ</th>
                                    <th style="width: 20%;">สถานะการอนุมัติ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cn = new connect;
                                $cn->con_db();
                                $sql = "select * from member where status = '0'";
                                $query = $cn->Connect->query($sql);
                                $row = 1;
                                while ($rs = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row; ?></td>
                                        <td><?php echo $rs['prefix'] . $rs['fname'] . ' ' . $rs['lname']; ?></td>
                                        <td><?php echo $rs['type']; ?></td>
                                        <td><?php echo $rs['position']; ?></td>
                                        <td><?php echo $rs['level']; ?></td>
                                        <td><?php echo $rs['department']; ?></td>
                                        <td><?php echo rev_date($rs['date']); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-success btn-xs" onclick="javascript: yesCm('<?php echo $rs['member_id']; ?>')">อนุมัติ</button>
                                            <button type="button" class="btn btn-info btn-danger btn-xs" onclick="javascript: noCm('<?php echo $rs['member_id']; ?>')">ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $row++;
                                }
                                ?>
                            </tbody>
                        </table>
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
        <!-- DataTables -->
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
                                                $('#example1').DataTable()
                                            });
                                            function yesCm(data) {
                                                if (confirm("คุณต้องการอนุมัติใช่หรือไม่?")) {
                                                    $.ajax({
                                                        url: "../control/registerDB.php",
                                                        type: "post",
                                                        data: {cmY: data},
                                                        success: function (result) {
                                                            window.location.href = 'ConfirmRegister.php';
                                                        }
                                                    });
                                                } else {
                                                    return false;
                                                }
                                            }
                                            function noCm(data) {
                                                if (confirm("คุณต้องการลบคำร้องขอหรือไม่?")) {
                                                    $.ajax({
                                                        url: "../control/registerDB.php",
                                                        type: "post",
                                                        data: {cmN: data},
                                                        success: function (result) {
                                                            window.location.href = 'ConfirmRegister.php';
                                                        }
                                                    });
                                                } else {
                                                    return false;
                                                }
                                            }
        </script>
    </body>
</html>
