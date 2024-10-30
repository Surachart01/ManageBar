<?php  
    include("../../config/connect.inc.php");
    $newId = $_POST['newId'];

    $sqlNew = "SELECT * FROM News WHERE id = '$newId'";
    $qNews = $conn->query($sqlNew);
    $item = $qNews->fetch_object();
?>

<h4>รายละเอียด</h4>
<hr>
<img src="<?php echo $item->image ?>" width="400px" height="300px"  alt="">
<p>ชื่อรายการ : <?php echo $item->name ?></p>
<p>รายละเอียด</p>
<p> <?php echo $item->description  ?> </p>
