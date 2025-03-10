<?php
include("1082_DB_conn.php");
date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
if (isset($_POST)) {
    $userName = $_POST['userName'];
    $userPassword = sha1($_POST['userPassword']);
    $userID =  $_POST['userEmail'];
    $sql = "SELECT * FROM `user` WHERE `e-mail` = '$userID'";
    $result = mysqli_query($link, $sql);
    $val = $result->num_rows;
    if ($val == 0) {
        if ($userName != null && $userID != null && $userPassword != null) {
            $outData = array("status" => "success");
            $sql1 = "INSERT INTO `user` (`name`, `password`,`e-mail`) VALUES ('$userName', '$userPassword','$userID')";
            mysqli_query($link, $sql1);
        }
    } else {
        $outData = array("status" => "existed");
    }
} else {
    $outData = array("status" => "fail");
}
echo json_encode($outData, JSON_UNESCAPED_UNICODE);
