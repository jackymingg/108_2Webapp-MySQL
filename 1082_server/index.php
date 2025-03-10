<?php
include("1082_DB_conn.php");
header("Content-Type:text/html; charset=utf-8"); //以utf8讀取資料，讓資料可以讀取中文
$sql = "SELECT * FROM `APP` ORDER BY  `student_num` DESC,`use_time` DESC limit 10";
/*
降序排列
https://newaurora.pixnet.net/blog/post/221610377-mysql%E6%8E%92%E5%BA%8F%E5%90%8D%E6%AC%A1%E3%80%81%E6%8E%92%E8%A1%8C%28%E4%BD%BF%E7%94%A8sql%E8%AA%9E%E6%B3%95%E6%8E%92%E5%BA%8F%29
https://blog.csdn.net/achenyuan/article/details/79785817
*/
$data = mysqli_query($link, $sql); //從contact資料庫中選擇所有的資料表
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>user使用APP情形</title>
    <style>
        .body {
            margin: 0 auto 0 auto;
            position: relative;
            top: 5%;
            background: rgb(87, 194, 83);
        }
    </style>
</head>

<body>
    <p>&nbsp;
    </p>
    <table align="center" style="border:8px #FFD382 groove;width: 700px;" cellpadding="10" border='1'>
        <tr style="border:8px #5CADAD groove;">
            <td align="center" width="100">使用者</td>
            <td align="center" width="200">日期&時間</td>
            <td align="center" width="300">APP</td>
            <td align="center" width="100">APP使用總時間</td>
        </tr>
        <?php
        for ($i = 1; $i <= mysqli_num_rows($data); $i++) {
            $rs = mysqli_fetch_row($data);
        ?>
            <tr style="border:8px #5CADAD groove;">
                <td align="center"><?php echo $rs[1] ?></td>
                <td align="center"><?php echo $rs[2] ?></td>
                <td align="center"><?php echo $rs[3] ?></td>
                <td align="center"><?php echo $rs[4] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <p>&nbsp;</p>
</body>

</html>