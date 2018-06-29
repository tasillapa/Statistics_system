<?php
@ob_start();
@session_start();

function rev_date($date) {
    $array = explode("-", $date);
    $rev = array_reverse($array);
    $date = implode("/", $rev);
    return $date;
}

include_once("../connect/connect_db.php");
if (isset($_POST['pdf_print']) && !empty($_POST['pdf_print'])) {
    $cn = new connect;
    $cn->con_db();
    $sql = "select * from request_form where rf_id = (select max(rf_id) from request_form)";
    $query = $cn->Connect->query($sql);
    while ($rs = mysqli_fetch_array($query)) {
        include_once('../fpdf/fpdf.php');

        define('FPDF_FONTPATH', 'font/');

        $pdf = new fpdf('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->AddFont('angsa', '', 'angsa.php');
        $pdf->SetFont('angsa', '', 16);
        $pdf->SetFont('', 'U');
        $pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'แบบใบลาป่วย ลาคลอดบุตร และลากิจกิจส่วนตัว'), 0, 1, "C");
        $pdf->SetFont('angsa', '', 16);
        $pdf->Cell(140, 10, iconv('UTF-8', 'TIS-620', 'เขียนที่'), 0, 0, "R");
        $pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_write_place'] . ''), 0, 1);
        $pdf->Cell(140, 10, iconv('UTF-8', 'TIS-620', 'วันที่'), 0, 0, "R");
        $pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '' . rev_date($rs['rf_dateFU']) . ''), 0, 1);
        $pdf->Cell(10, 10, iconv('UTF-8', 'TIS-620', 'เรื่อง'), 0, 0, 'L');
        $pdf->Cell(20, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_toppic'] . ''), 0, 1);
        $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ข้าพเจ้า'), 0, 0, "R");
        $pdf->Cell(60, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_name'] . ''), 0, 0);
        $pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', 'ตำแหน่ง'), 0, 0);
        $pdf->Cell(70, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_position'] . ''), 0, 1);
        $pdf->Cell(13, 10, iconv('UTF-8', 'TIS-620', 'ระดับ'), 0, 0, 'L');
        $pdf->Cell(100, 10, iconv('UTF-8', 'TIS-620', '' . $rs['level'] . ''), 0, 1);
        $pdf->Cell(10, 10, iconv('UTF-8', 'TIS-620', 'ขอลา'), 0, 0, 'L');
        $pdf->Cell(60, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_r2'] . ''), 0, 0);
        $pdf->Cell(17, 10, iconv('UTF-8', 'TIS-620', 'เนื่องจาก'), 0, 0, 'L');
        $pdf->Cell(108, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_detail'] . ''), 0, 1);
        $pdf->Cell(19, 10, iconv('UTF-8', 'TIS-620', 'ตั้งแต่วันที่'), 0, 0, 'L');
        $pdf->Cell(51, 10, iconv('UTF-8', 'TIS-620', '' . rev_date($rs['rf_BdateStart_f']) . ''), 0, 0);
        $pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', 'ถึงวันที่'), 0, 0, 'L');
        $pdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', '' . rev_date($rs['rf_AdateStart_f']) . ''), 0, 0);
        $pdf->Cell(17, 10, iconv('UTF-8', 'TIS-620', 'มีกำหนด'), 0, 0, 'L');
        $pdf->Cell(21, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_num_f'] . ''), 0, 0, 'C');
        $pdf->Cell(18, 10, iconv('UTF-8', 'TIS-620', 'วัน'), 0, 1, 'L');
        $pdf->Cell(54, 10, iconv('UTF-8', 'TIS-620', 'ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่'), 0, 0, 'L');
        $pdf->Cell(135, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_contact'] . ''), 0, 1);
        $pdf->Cell(31, 10, iconv('UTF-8', 'TIS-620', 'หมายเลขโทรศัพท์'), 0, 0, 'L');
        $pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', '' . $rs['rf_fhone'] . ''), 0, 1);
        $pdf->Cell(105, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ'), 0, 0, 'R');
        $pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', '.................................................................................'), 0, 1);
        $pdf->Cell(183, 10, iconv('UTF-8', 'TIS-620', '(...............................................................................)'), 0, 1, 'R');
        $pdf->SetFont('', 'U');
        $pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', 'สถิติการลาในปีงบประมานนี้'), 0, 0, 'C');
        $pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', 'ความเห็นผู้บังคับบัญชา'), 0, 1, 'C');
        $pdf->SetFont('angsa', '', 12);
        $pdf->SetFillColor(205, 201, 201);
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', 'ประเภทลา'), 1, 0, 'C', true);
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', 'ลามา (แล้ววันทำการ)'), 1, 0, 'L', true);
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', 'ลาครั้งนี้ (วันทำการ)'), 1, 0, 'L', true);
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', 'รวมเป็น (วันทำการ)'), 1, 1, 'L', true);
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', 'ป่วย'), 1, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 0, 'C');
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 0, 'C');
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', 'กิจส่วนตัว'), 1, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 0, 'C');
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 0, 'C');
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', 'คลอดบุตร'), 1, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 0, 'C');
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 0, 'C');
        $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(94, 10, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(100, -30, iconv('UTF-8', 'TIS-620', '.............................................................................................................................'), 0, 1, 'C');
        $pdf->Cell(94, 40, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(100, 15, iconv('UTF-8', 'TIS-620', '.............................................................................................................................'), 0, 1, 'C');
        $pdf->Cell(90, 40, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'R');
        $pdf->SetFont('angsa', '', 16);
        $pdf->Cell(100, 15, iconv('UTF-8', 'TIS-620', 'ลงชื่อ ............................................................................................'), 0, 1, 'C');
        $pdf->Cell(93, 40, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'R');
        $pdf->Cell(100, 0, iconv('UTF-8', 'TIS-620', '(.........................................................................................)'), 0, 1, 'C');
        $pdf->Cell(90, 40, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'R');
        $pdf->Cell(100, 15, iconv('UTF-8', 'TIS-620', 'ตำแหน่ง ............................................................................................'), 0, 1, 'C');
        $pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ ................................................................. ผู้ตรวจสอบ'), 0, 1, 'L');
        $pdf->Cell(83, 10, iconv('UTF-8', 'TIS-620', '(.................................................................)'), 0, 1, 'C');
        $pdf->Cell(83, 10, iconv('UTF-8', 'TIS-620', 'ตำแหน่ง.................................................................'), 0, 0, 'L');
        $pdf->Cell(110, 10, iconv('UTF-8', 'TIS-620', 'คำสั่ง'), 0, 1, 'C');
        $pdf->Cell(83, 10, iconv('UTF-8', 'TIS-620', 'วันที่................./...................../.........................'), 0, 0, 'C');
        $pdf->Cell(110, 10, iconv('UTF-8', 'TIS-620', '.... อนุญาต             .... ไม่อนุญาต'), 0, 1, 'C');

//    $pdf->SetFont('','U');
//    $pdf->SetLeftMargin(45);
//    $pdf->SetFontSize(14);
//    $actual_position_y = $pdf->GetY();
//    $pdf->SetFillColor(255, 255, 255);
//    $pdf->SetDrawColor(0, 0, 0);
//    $pdf->Cell($your_content_width, $your_content_heigth, "", 1, 1, 'C');
        $pdf->Rect(5, 5, 200, 287, 'D'); //For A4

        $pdf->Output("../fpdf/MyPDF/print_RF.pdf", "F");
        echo 'ok';
        exit();
    }
}
?>
    