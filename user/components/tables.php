<?php
date_default_timezone_set('Asia/Bangkok');
include("../../config/connect.inc.php");
$date = $_POST['date'];
// Fetch data from the database
$query = "SELECT * FROM tables ORDER BY id ASC";
$result = mysqli_query($conn, $query);
$query = "SELECT * FROM options WHERE id = '2'";
$qOption = $conn->query($query);
$dataOption = $qOption->fetch_object();

$currentTime = time();
$targetTime = strtotime("23:59");

$tableRanges = [
    [1, 5],
    [6, 13],
    [14, 23],
    [24, 33],
    [34, 41],
    [42, 49],
    [50, 57],
    [58, 65],
    [66, 73],
    [74, 81],
    [82, 89],
    [90, 99],
    [100, 109],
    [110, 119],
    [120, 129],
    [130, 139],
    [140, 149],
    [150, 159]
];
// Prepare table data array
$tableData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tableData[] = $row;
}

// Function to generate table button
function generateTableButton($table, $state,$currentTime,$targetTime,$dataOption ) 
{
    if ($currentTime < $targetTime AND $dataOption->state == 0) {
        if ($state == 2) {
            $btnClass = 'btn-danger';
            $dis = 1;
        } else if ($state == 1) {
            $btnClass = 'btn-warning ';
            $dis = 1;
        } else {
            $btnClass = 'btn-success ';
            $dis = 0;
        }
    }else{
        $btnClass = 'btn-secondary ';
            $dis = 1; //$dis 1 == off $dis 0 == on
    }

    return sprintf(
        '<a  class="btn %s " id="btn-table" data-idtable="%s"  data-click="%s" >%s</a>',
        $btnClass,
        $table['id'],
        $dis,
        htmlspecialchars($table['tableNum'], ENT_QUOTES)
    );
}
?>



<?php
// Render table buttons according to the defined ranges
foreach ($tableRanges as $range): ?>
    <div class="col">
        <?php
        for ($index = $range[0] - 1; $index < $range[1] && $index < count($tableData); $index++) {
            $tableId = $tableData[$index]['id'];
            $sqlCheck = "SELECT * FROM reserve WHERE tableId = '$tableId' AND date = '$date'";
            $qCheck = $conn->query($sqlCheck);
            $rCheck = $qCheck->num_rows;
            if ($rCheck > 0) {
                $check = $qCheck->fetch_object();
                if ($check->state == 1) {
                    echo generateTableButton($tableData[$index], 1,$currentTime,$targetTime,$dataOption);
                } else {
                    echo generateTableButton($tableData[$index], 2,$currentTime,$targetTime,$dataOption);
                }
            } else {
                echo generateTableButton($tableData[$index], 0,$currentTime,$targetTime,$dataOption);
            }
        }
        ?>
    </div>
<?php endforeach; ?>