<?php
header("Access-Control-Allow-Origin: *");
$link = mysqli_connect(
    "localhost",
    "s107021034",
    "Aiph7Tov",
    "s107021034_testPHP"
);

if (!$link) {
    echo "Error: unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno:" . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging errno:" . mysqli_connect_errno() . PHP_EOL;
    exit;
}

$link->set_charset("utf8");
