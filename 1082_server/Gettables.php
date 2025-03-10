<?php
include("1082_DB_conn.php");
header("Content-Type:text/html; charset=utf-8"); //以utf8讀取資料，讓資料可以讀取中文
$userName = $_POST['userName'];
$sql = "SELECT * FROM `APP` ORDER BY  `student_num` DESC,`use_time` DESC limit 10 WHERE `student_num` = '$userName'";
/*
降序排列
https://newaurora.pixnet.net/blog/post/221610377-mysql%E6%8E%92%E5%BA%8F%E5%90%8D%E6%AC%A1%E3%80%81%E6%8E%92%E8%A1%8C%28%E4%BD%BF%E7%94%A8sql%E8%AA%9E%E6%B3%95%E6%8E%92%E5%BA%8F%29
https://blog.csdn.net/achenyuan/article/details/79785817
*/
$result = mysqli_query($link, $sql);
$rows = array();
while ($record = mysqli_fetch_assoc($result)) {
    $rows[] = $record;
}
echo json_encode($rows,  JSON_UNESCAPED_UNICODE);
?>
