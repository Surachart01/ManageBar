<?php  
    include("../../config/connect.inc.php");
    $orderId = $_POST['orderId'];
    $sqlOrder = "SELECT * FROM orders WHERE id = '$orderId'";
    $qOrder = $conn->query($sqlOrder);
    $item = $qOrder->fetch_object();

?>
<h4>สลิป</h4>
<hr>
<img src="<?php echo $item->SLIP ?>" width="300px" height="500px" alt="">
<hr>