<?php
include("1082_DB_conn.php");
date_default_timezone_set('Asia/Taipei');
$userEmail = $_POST['userEmail'];
$sql = "SELECT  `type`,`title`,`description`FROM `note` WHERE `userEmail` = '$userEmail'";
$result = mysqli_query($link, $sql);
$rows = array();
while ($record = mysqli_fetch_assoc($result)) {
    $rows[] = $record;
}
echo json_encode($rows,  JSON_UNESCAPED_UNICODE);
