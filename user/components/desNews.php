<?php  
    include("../../config/connect.inc.php");
    $newId = $_POST['newId'];

    $sqlNew = "SELECT * FROM News WHERE id = '$newId'";
    $qNews = $conn->query($sqlNew);
    $item = $qNews->fetch_object();
?>

<h4>รายละเอียด</h4>
<hr>
<img src="<?php echo $item->image ?>" width="400px" height="200px"  alt="">
<hr>
<p>รายละเอียด</p>
<p class="text-start"> <?php echo $item->description  ?> </p>
