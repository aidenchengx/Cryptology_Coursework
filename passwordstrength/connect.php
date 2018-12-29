<?php 
    $conn_servername = "localhost";
    $conn_username = "root";
    $conn_password = "123456";
    $conn_database = "password";

    // 创建连接
    $con = mysqli_connect($conn_servername, $conn_username, $conn_password, $conn_database);

    // 检测连接
    if (!$con) {
        die("连接失败" . mysqli_connect_error());
    }
    mysqli_query($con,"set names 'utf8'");
  //  echo "连接成功！";
?>
