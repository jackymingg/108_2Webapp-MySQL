<?php
include("1082_DB_conn.php");
date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
if (isset($_POST)) {
    $userID = $_POST['userName'];
    $userPassword = sha1($_POST['userPassword']);
    $lon = $_POST['lon'];
    $lat = $_POST['lat'];
    $sql = "SELECT * FROM `user` WHERE `e-mail` = '$userID' AND `password` = '$userPassword'";
    $result = mysqli_query($link, $sql);
    $val = $result->num_rows;
    if ($val == 1) {
        $outData = array("status" => "success", "lon" => $lon, "lat" => $lat);
        $row = mysqli_fetch_assoc($result);
        $sql1 = "INSERT INTO `loginLog` (`userID`,`longitude`,`latitude`) VALUES($row[id],$lon,$lat)";
        mysqli_query($link, $sql1);
    } else {
        $outData = array("status" => "noAccount");
    }
} else {
    $outData = array("status" => "fail");
}
echo json_encode($outData, JSON_UNESCAPED_UNICODE);
