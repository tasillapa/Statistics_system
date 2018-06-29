<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>สมัครสมาชิก</title>
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
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../index.php"><b>WSPSO</b> จังหวัดสระบุรี</a>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">สมัครสมาชิกใหม่</p>
                <form id="from_register">
                    <div class="form-group has-feedback">
                        <label>รหัสประจำตัวพนักงาน</label>
                        <input id="username" type="text" class="form-control" placeholder="กรอกรหัสประจำตัวพนักงาน">
                    </div>
                    <div class="form-group has-feedback">
                        <label>รหัสผ่าน</label>
                        <input id="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group has-feedback">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input id="re_password" type="password" class="form-control" placeholder="Retype password">
                    </div>
                    <div class="form-group has-feedback">
                        <label>ประเภทพนักงาน</label>
                        <div class="form-group">
                            <select class="form-control" id="type">
                                <option value="พนักงานราชการ">พนักงานราชการ</option>
                                <option value="ข้าราชการ">ข้าราชการ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label>บัตรเลขที่</label>
                        <input id="numberID" type="text" class="form-control" placeholder="กรอกบัตรเลขที่">
                    </div>
                    <div class="form-group has-feedback">
                        <label>คำนำหน้า</label>
                        <input id="prefix" type="text" class="form-control" placeholder="กรอกคำนำหน้า">
                    </div>
                    <div class="form-group has-feedback">
                        <label>ชื่อ</label>
                        <input id ="fname" type="text" class="form-control" placeholder="กรอกชื่อ">
                    </div>
                    <div class="form-group has-feedback">
                        <label>สกุล</label>
                        <input id="lname" type="text" class="form-control" placeholder="กรอกสกุล">
                    </div>
                    <div class="form-group has-feedback">
                        <label>ตำแหน่ง</label>
                        <input id="position" type="text" class="form-control" placeholder="กรอกตำแหน่ง">
                    </div>
                    <div class="form-group has-feedback">
                        <label>ระดับ</label>
                        <input id="level" type="text" class="form-control" placeholder="กรอกระดับ">
                    </div>
                    <div class="form-group has-feedback">
                        <label>สำนัก/กอง</label>
                        <input id="department" type="text" class="form-control" placeholder="กรอกสำนัก/กอง">
                    </div>
                    <div class="form-group has-feedback">
                        <label>บรรจุวันที่</label>
                        <input id="date" type="text" class="form-control" placeholder="วว/ดด/ปปปป">
                    </div>
                    <div class="form-group has-feedback">
                        <label>หมายเลขโทรศัพท์</label>
                        <input id="tel" type="text" class="form-control" placeholder="กรอกหมายเลขโทรศัพท์">
                    </div>
                    <div class="form-group has-feedback">
                        <label>ที่อยู่</label>
                        <textarea id="address" type="text" class="form-control" placeholder="กรอกที่อยู่"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="button" onclick="register()" class="btn btn-primary btn-block btn-flat">สมัคร</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->

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
        <script>
                                $(function () {
                                    $('#date').datepicker({
                                        autoclose: true,
                                        format: 'dd/mm/yyyy'
                                    })
                                });
                                function convertDigitIn(str) {
                                    return str.split('/').reverse().join('-');
                                }
                               
                                function register() {
                                    if ($('#username input:text').val() == '') {
                                        alert('กรุณากรอกชื่อผู้ใช้');
                                    } else if ($('#password').val() == $('#re_password').val()) {
                                        var arr = [];
                                        arr.push($('#username').val(), $('#password').val(), $('#type').val(), $('#numberID').val(), $('#prefix').val(), $('#fname').val(), $('#lname').val(), $('#position').val(), $('#level').val(), $('#department').val(), convertDigitIn($('#date').val()), $('#tel').val(), $('#address').val());
                                        $.ajax({
                                            url: "../control/registerDB.php",
                                            type: "post",
                                            data: {register: arr},
                                            success: function (data) {
                                                if (data == 1) {
                                                    alert('สมัครสมาชิกสำเร็จ! กรุณารอเจ้าหน้าที่เข้ามาทำการตรวจสอบการสมัคร');
                                                    window.location.href = 'login.php';
                                                } else {
                                                    alert('สมัครสมาชิกล้มเหลว! กรุณาตรวจสอบข้อมูลเพื่อทำการสมัครอีกครั้ง');
                                                }
                                            }
                                        });
                                    } else {
                                        alert('รหัสผ่านไม่ตรงกัน');
                                    }
                                }
        </script>
    </body>
</html>
