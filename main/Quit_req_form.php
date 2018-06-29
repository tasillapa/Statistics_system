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


            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="input-group input-group-lg">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> เลือกประเภทการลา
                            <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="Request_Form.php">ลาป่วย ลาคลอด และลากิจ</a></li>
                            <li class="active"><a href="Quit_req_form.php">ลาพักผ่อน</a></li>
                            <!--<li><a href="Emp_req_form.php">ลาพักผ่อนพนักงานราชการ</a></li>-->
                        </ul>
                    </div>
                </div>
            </section>

            <section class="content" id="official">
                <div class="box box-default">
                    <div class="box-header with-border" style="background-color: #e0e0d1;">
                        <h3 class="box-title">แบบคำร้องขอลาพักผ่อน</h3>

                        <div class="box-tools pull-right">
                            <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body DSD">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <center> <h4>แบบคำร้องขอลาพักผ่อน</h4></center>
                                </div></br></br></br>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">เขียนที่</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="qrf_write_place" placeholder="กรอกสถานที่เขียน">
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
                                                <label style="padding-top: 8px">
                                                    <?php
                                                    $today = date("d/m/y");
                                                    echo $today;
                                                    ?>
                                                </label>
                                                <input type="hidden" class="form-control" id="qrf_dateFU" value="<?php
                                                $today = date("d/m/y");
                                                echo $today;
                                                ?>"" placeholder="--/--/----" value="">
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
                                                <input type="hidden" id="qrf_toppic" value="ขอลาพักผ่อน"/>
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
                                                <input type="text" class="form-control" id="qrf_requst" placeholder="">
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
                                                <input type="text" class="form-control" id="qrf_name" placeholder="กรอกชื่อ" value="<?php echo $_SESSION['name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">บัตรเลขที่</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="qrf_Codid" placeholder="กรอกบัตรเลขที่" value="<?php echo $_SESSION['numberID']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">สำนัก/กอง</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="qrf_office" placeholder="กรอกสำนัก/กอง" value="<?php echo $_SESSION['department']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">ได้รับการบรรจุเมื่อวันที่</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="qrf_income" placeholder="--/--/----" value="<?php echo rev_date($_SESSION['date']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-7 control-label">มีสิทธิลาพักผ่อนประจำปี 10 วันทำการ</label>
                                            <div class="col-sm-5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">ขอลาพักผ่อนตั้งแต่วันที่</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="qrf_BdateStart_f" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">ถึงวันที่</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="qrf_AdateStart_f" placeholder="--/--/----">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">มีกำหนด</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="qrf_num_f" placeholder="ระบุจำนวนวัน">
                                            </div>
                                            <label style="padding-top: 8px" class="col-sm-2">วัน</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่</label>
                                            <div class="col-sm-7">
                                                <textarea type="text" class="form-control" id="qrf_contact" placeholder="กรอกที่อยู่ที่ติดต่อได้"><?php echo $_SESSION['address']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">หมายเลขโทรศัพท์</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="qrf_fhone" placeholder="กรอกเบอร์โทรศักท์ที่ติดต่อได้" value="<?php echo $_SESSION['tel']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>

                                <div class="box-footer">
                                    <button type="reset" class="btn btn-danger pull-right">ยกเลิก</button>
                                    <button type="button" class="btn btn-info pull-right btn-print btn-save">บันทึก</button>
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
                    var arr = [];
                    arr.push($('#qrf_write_place').val(), convertDigitIn($('#qrf_dateFU').val()), $('#qrf_toppic').val(), $('#qrf_requst').val(), $('#qrf_name').val(), $('#qrf_Codid').val(), $('#qrf_office').val()
                            , convertDigitIn($('#qrf_income').val()), convertDigitIn($('#qrf_BdateStart_f').val()), convertDigitIn($('#qrf_AdateStart_f').val()), $('#qrf_num_f').val(), $('#qrf_contact').val(), $('#qrf_fhone').val());
                    $.ajax({
                        url: "../control/form_leaveDB.php",
                        type: "post",
                        data: {QRF: arr},
                        success: function (data) {
                            if (data == '1') {
                                window.location.href = 'QRF_print.php';
                            } else {
                                window.location.href = 'Quit_req_form.php';
                            }
                        }
                    });
                });

//                $('#qrf_dateFU').datepicker({
//                    autoclose: true,
//                    format: 'dd/mm/yyyy'
//                });
                $('#qrf_BdateStart_f').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                });
                $('#qrf_AdateStart_f').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                });
                $('#qrf_income').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
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
            $('#qrf_AdateStart_f').change(function () {
                if (($('#qrf_BdateStart_f').val() != '') && ($('#qrf_AdateStart_f').val() != '')) {
                    $('#qrf_num_f').val(jsDateDiff(convertDigitIn($('#qrf_BdateStart_f').val()), convertDigitIn($('#qrf_AdateStart_f').val())));
                }
            });
            $('#qrf_BdateStart_f').change(function () {
                if (($('#qrf_BdateStart_f').val() != '') && ($('#qrf_AdateStart_f').val() != '')) {
                    $('#qrf_num_f').val(jsDateDiff(convertDigitIn($('#qrf_BdateStart_f').val()), convertDigitIn($('#qrf_AdateStart_f').val())));
                }
            });
            function jsDateDiff(strDate1, strDate2) {
                var theDate1 = Date.parse(strDate1) / 1000;
                var theDate2 = Date.parse(strDate2) / 1000;
                var diff = (theDate2 - theDate1) / (60 * 60 * 24);
                return diff;
            }
            function convertDigitIn(str) {
                return str.split('/').reverse().join('-');
            }
        </script>
    </body>
</html>
