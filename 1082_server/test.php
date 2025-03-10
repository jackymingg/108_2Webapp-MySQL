<?php
include("DB.php"); //連結伺服器
header("Content-Type:text/html; charset=utf-8"); //以utf8讀取資料，讓資料可以讀取中文
$sql = "SELECT * FROM `flower_info`";
$data = mysqli_query($link, $sql); //從contact資料庫中選擇所有的資料表
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>花與花語</title>
</head>

<body>
    <table width="700" border="1" align="center">
        <tr>
            <td>Num</td>
            <td>Variety</td>
            <td>Language of flowers</td>
        </tr>
        <?php
        for ($i = 1; $i <= mysqli_num_rows($data); $i++) {
            $rs = mysqli_fetch_row($data);
        ?>
            <tr>
                <td><?php echo $rs[0] ?></td>
                <td><?php echo $rs[1] ?></td>
                <td><?php echo $rs[2] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <p>&nbsp;</p>
</body>

</html>