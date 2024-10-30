<?php
include("../config/connect.inc.php");
$orderId = $_POST['orderId'];
date_default_timezone_set('Asia/Bangkok');

$sqlTable = "SELECT * FROM orderProduct JOIN tables ON orderProduct.tableId = tables.id WHERE orderProduct.id = '$orderId'";
$qTable = $conn->query($sqlTable);
$dataTable = $qTable->fetch_object();

$sqlDetail = "SELECT * FROM detailProduct JOIN products ON products.id = detailProduct.productId WHERE orderId = '$orderId'";
$qDetail = $conn->query($sqlDetail);
$total = 0;
$data = '';
$tableNumber = $dataTable->tableNum;
while ($itemDetail = $qDetail->fetch_object()) {
    $total = $total + ($itemDetail->price * $itemDetail->qty);
    $totalPrice = $itemDetail->price * $itemDetail->qty;


    $data .= "<tr>
        <td>$itemDetail->productName</td>
        <td>$itemDetail->qty</td>
        <td>$itemDetail->price</td>
        <td>$totalPrice</td>
    </tr>";


}
?>

<?php
require '../vendor/autoload.php';
$date = date("Y-m-d H:i:s");

use Mpdf\Mpdf;

try {
    // กำหนดขนาดกระดาษบิล (80 มม. x 150 มม.)
    $mpdf = new Mpdf([
        'format' => [80, 150],
        'tempDir' => __DIR__ . '/../vendor/mpdf/mpdf/tmp',
    ]);


    // HTML สำหรับหน้าบิล
    $htmlContent = '
    <style>
        body { font-family: "Garuda"; font-size: 12px; }
        .header { text-align: center; font-weight: bold; font-size: 14px; margin-bottom: 10px; }
        .items { border-bottom: 1px solid #ddd; }
        .items table { width: 100%; }
        .items th, .items td { font-size: 12px; padding: 4px; text-align: left; }
        .total { font-weight: bold; text-align: right; font-size: 12px; margin-top: 10px; }
        .footer { text-align: center; font-size: 10px; margin-top: 10px; }
    </style>

    <div class="header">
        MAHANAKHON<br>
        <hr>
        <p> โต๊ะ :'.$tableNumber.'</p>
        <hr>
    </div>



    <div class="items">
        <table>
            <tr>
                <th>สินค้า</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>รวม</th>
            </tr>'.$data.'
            
            
            
        </table>
    </div>

    <div class="total">รวมทั้งสิ้น: '.$total.' บาท</div>

    <div class="footer">
        วันที่: ' . $date . '<br>
        ขอบคุณที่ใช้บริการ
    </div>
    ';

    $mpdf->WriteHTML($htmlContent);

    // บันทึกไฟล์ PDF
    $pdfFilePath = "../PDF/Bill_$date.pdf";
    $mpdf->Output($pdfFilePath, 'F');

    // ส่ง URL ของไฟล์ PDF กลับไป
    echo $pdfFilePath;
} catch (\Mpdf\MpdfException $e) {
    echo 'Error: ' . $e->getMessage();
}
