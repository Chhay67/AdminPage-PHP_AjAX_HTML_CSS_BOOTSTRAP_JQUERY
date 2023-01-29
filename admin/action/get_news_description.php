<?php
    $cn = new mysqli("localhost", "root", "", "myphp_2");
    $cn->set_charset("utf8");
    $id = $_POST['id'];
    $sql = "SELECT des FROM tbl_news WHERE id = $id";
    $rs = $cn->query($sql);
    $row = $rs->fetch_array();
    $msg['des'] = $row[0];
    echo json_encode($msg);
?>