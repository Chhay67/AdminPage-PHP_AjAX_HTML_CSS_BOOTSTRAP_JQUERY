<?php 
    $cn = new mysqli("localhost","root","","myphp_2");
    $cn->set_charset("utf8");
    $frmOpt = $_POST['opt'];
    $tbl = array(
        "0"=>"tbl_menu",
        "1"=>"tbl_news",
        "2"=>"tbl_ads"
    );

    $sql =" SELECT id FROM ".$tbl[$frmOpt]." ORDER BY id DESC LIMIT 0,1";
    $rs = $cn->query($sql);
    $msg['id'] = 0;
    if($rs->num_rows > 0)
    {
        $row = $rs->fetch_array();
        $msg['id'] = $row[0];
    }
    echo json_encode($msg);
?>


