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
    $sql = "select * from quit_req_form where qrf_id = (select max(qrf_id) from quit_req_form)";
    $query = $cn->Connect->query($sql);
    while ($rs = mysqli_fetch_array($query)) {
        include_once('../fpdf/fpdf.php');

        define('FPDF_FONTPATH', 'font/');

        $pdf = new fpdf('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->AddFont('angsa', '', 'angsa.php');
        $pdf->SetFont('angsa', '', 16);
        $pdf->SetFont('', 'U');
        $pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'แบบใบลาพักผ่อน'), 0, 1, "C");
        $pdf->SetFont('angsa', '', 16);
        $pdf->Cell(140, 10, iconv('UTF-8', 'TIS-620', 'เขียนที่'), 0, 0, "R");
        $pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_write_place'] . ''), 0, 1);
        $pdf->Cell(140, 10, iconv('UTF-8', 'TIS-620', 'วันที่'), 0, 0, "R");
        $pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '' . rev_date($rs['qrf_dateFU']) . ''), 0, 1);
        $pdf->Cell(10, 10, iconv('UTF-8', 'TIS-620', 'เรื่อง'), 0, 0, 'L');
        $pdf->Cell(20, 10, iconv('UTF-8', 'TIS-620', 'ขอลาพักผ่อน'), 0, 1);
        $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ข้าพเจ้า'), 0, 0, "R");
        $pdf->Cell(60, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_name'] . ''), 0, 0);
        $pdf->Cell(18, 10, iconv('UTF-8', 'TIS-620', 'บัตรเลขที่'), 0, 0);
        $pdf->Cell(70, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_Codid'] . ''), 0, 1);
        $pdf->Cell(20, 10, iconv('UTF-8', 'TIS-620', 'สำนัก/กอง'), 0, 0, 'L');
        $pdf->Cell(65, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_office'] . ''), 0, 0);
        $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ได้รับการบรรจุเมื่อวันที่'), 0, 0, 'L');
        $pdf->Cell(63, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_income'] . ''), 0, 1);
        $pdf->Cell(54, 10, iconv('UTF-8', 'TIS-620', 'มีสิทธิลาพักผ่อนประจำปี 10 วันทำการ'), 0, 1, 'L');
        $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'ขอลาพักผ่อนตั้งแต่วันที่'), 0, 0, 'L');
        $pdf->Cell(35, 10, iconv('UTF-8', 'TIS-620', '' . rev_date($rs['qrf_BdateStart_f']) . ''), 0, 0);
        $pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', 'ถึงวันที่'), 0, 0, 'L');
        $pdf->Cell(40, 10, iconv('UTF-8', 'TIS-620', '' . rev_date($rs['qrf_AdateStart_f']) . ''), 0, 0);
        $pdf->Cell(13, 10, iconv('UTF-8', 'TIS-620', 'มีกำหนด'), 0, 0, 'L');
        $pdf->Cell(25, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_num_f'] . ''), 0, 0, 'C');
        $pdf->Cell(18, 10, iconv('UTF-8', 'TIS-620', 'วัน'), 0, 1, 'L');
        $pdf->Cell(54, 10, iconv('UTF-8', 'TIS-620', 'ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่'), 0, 0, 'L');
        $pdf->Cell(135, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_contact'] . ''), 0, 1);
        $pdf->Cell(31, 10, iconv('UTF-8', 'TIS-620', 'หมายเลขโทรศัพท์'), 0, 0, 'L');
        $pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', '' . $rs['qrf_fhone'] . ''), 0, 1);
//        $pdf->Cell(105, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ'), 0, 0, 'R');
//        $pdf->Cell(80, 10, iconv('UTF-8', 'TIS-620', '.................................................................................'), 0, 1);
//        $pdf->Cell(183, 10, iconv('UTF-8', 'TIS-620', '(...............................................................................)'), 0, 1, 'R');
        $pdf->SetFont('', 'U');
        $pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', 'สถิติการลาในปีงบประมานนี้'), 0, 1, 'C');
        $pdf->SetFont('angsa', '', 12);
        $pdf->SetFillColor(205, 201, 201);
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', 'จำนวนครั้งที่ลา'), 1, 0, 'C', true);
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', 'จำนวนวันลา (วันทำการ)'), 1, 1, 'C', true);
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '1'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '2'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '3'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '4'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '5'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '6'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '7'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '8'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '9'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');
        $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'C');
        $pdf->Cell(26, 7, iconv('UTF-8', 'TIS-620', '10'), 1, 0, 'C');
        $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', ' '), 1, 1, 'C');

        $pdf->SetFont('angsa', '', 16);
        $pdf->Cell(105, -150, iconv('UTF-8', 'TIS-620', 'ลงชื่อ'), 0, 0, 'R');
        $pdf->Cell(80, -150, iconv('UTF-8', 'TIS-620', '.................................................................................'), 0, 1);
        $pdf->Cell(183, 165, iconv('UTF-8', 'TIS-620', '(...............................................................................)'), 0, 1, 'R');
        $pdf->SetFont('', 'U');
        $pdf->Cell(280, -140, iconv('UTF-8', 'TIS-620', 'ความเห็นผู้บังคับบัญชา'), 0, 1, 'C');
        $pdf->SetFont('angsa', '', 16);
        $pdf->Cell(94, 7, iconv('UTF-8', 'TIS-620', ' '), 0, 0, 'L');
        $pdf->Cell(100, 160, iconv('UTF-8', 'TIS-620', '........................................................................................................................'), 0, 1, 'R');
        $pdf->Cell(195, -143, iconv('UTF-8', 'TIS-620', '.........................................................................................................................'), 0, 1, 'R');
        $pdf->Cell(190, 160, iconv('UTF-8', 'TIS-620', '(ลงชื่อ) ...........................................................................................'), 0, 1, 'R');
        $pdf->Cell(100, -80, iconv('UTF-8', 'TIS-620', ''), 0, 1, 'C');
        $pdf->Cell(90, 40, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'R');
        $pdf->Cell(100, 15, iconv('UTF-8', 'TIS-620', '(ตำแหน่ง) ........................................................................................'), 0, 1, 'C');
        $pdf->Cell(190, 0, iconv('UTF-8', 'TIS-620', 'วันที่............................/................................/...................................'), 0, 1, 'R');
        $pdf->Cell(280, 15, iconv('UTF-8', 'TIS-620', 'คำสั่ง'), 0, 1, 'C');
        $pdf->Cell(280, 5, iconv('UTF-8', 'TIS-620', '..... อนุญาต             ..... ไม่อนุญาต'), 0, 1, 'C');
        $pdf->Cell(280, 7, iconv('UTF-8', 'TIS-620', '......................................................................................................'), 0, 1, 'C');
        $pdf->Cell(280, 7, iconv('UTF-8', 'TIS-620', '......................................................................................................'), 0, 1, 'C');
        
        $pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', 'ลงชื่อ ................................................................. ผู้ตรวจสอบ'), 0, 0, 'L');
        $pdf->Cell(95, 10, iconv('UTF-8', 'TIS-620', '(ลงชื่อ) ......................................................................................'), 0, 1, 'L');
        $pdf->Cell(90, 10, iconv('UTF-8', 'TIS-620', '(...........................................................................................)'), 0, 0, 'R');
        $pdf->Cell(100, 10, iconv('UTF-8', 'TIS-620', '(.................................................................................................)'), 0, 1, 'R');
        $pdf->Cell(83, 10, iconv('UTF-8', 'TIS-620', 'ตำแหน่ง..............................................................................'), 0, 0, 'L');
        $pdf->Cell(107, 10, iconv('UTF-8', 'TIS-620', 'ตำแหน่ง.....................................................................................'), 0, 1, 'R');
        $pdf->Cell(90, 10, iconv('UTF-8', 'TIS-620', 'วันที่............................/................................/.........................'), 0, 0, 'R');
        $pdf->Cell(100, 10, iconv('UTF-8', 'TIS-620', 'วันที่............................/................................/.........................'), 0, 0, 'R');
        

//    $pdf->SetFont('','U');
//    $pdf->SetLeftMargin(45);
//    $pdf->SetFontSize(14);
//    $actual_position_y = $pdf->GetY();
//    $pdf->SetFillColor(255, 255, 255);
//    $pdf->SetDrawColor(0, 0, 0);
//    $pdf->Cell($your_content_width, $your_content_heigth, "", 1, 1, 'C');
        $pdf->Rect(5, 5, 200, 287, 'D'); //For A4

        $pdf->Output("../fpdf/MyPDF/print_QRF.pdf", "F");
        echo 'ok';
        exit();
    }
}
?>
    