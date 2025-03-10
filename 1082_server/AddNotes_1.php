<?php
include("1082_DB_conn.php");
date_default_timezone_set('Asia/Taipei');
$userEmail = $_POST['userEmail'];
$type = $_POST['noteType'];
$title = $_POST['title'];
$description = $_POST['description'];
$sql = "INSERT INTO `note` (`userEmail`,`type`,`title`,`description`) VALUES('$userEmail', '$type', '$title', '$description')";
$rv = mysqli_query($link, $sql);
if ($rv == false) {
    $outData = array("status" => "fail");
} else {
    $outData = array("status" => "success");
}

echo json_encode($outData, JSON_UNESCAPED_UNICODE);
