<?php
    $cn = new mysqli("localhost", "root", "", "myphp_2");
    $cn->set_charset("utf8");
    $url = $_POST['txt-url'];
    $url = $cn->real_escape_string($url);
    $status = $_POST['txt-status'];
    $id = $_POST['txt-id'];
    $location = $_POST['txt-location'];
    $type = $_POST['txt-type'];
    $img = $_POST['txt-photo'];
    $edit_id = $_POST['txt-edit-id'];
    $msg['id'] = 0;
    $msg['dup'] = false;
    $msg['edit'] = false;
    //check duplicate name
    if ($edit_id == 0) {
        $sql = "INSERT INTO tbl_ads VALUES(null,'$url','$img','$location','$type','$status')";
        $cn->query($sql);

    } else {
        $sql = "UPDATE tbl_ads SET url='$url',img='$img', location='$location', type='$type' , status='$status' WHERE id =$edit_id";
        $cn->query($sql);
        $msg['edit'] = true;
    }
 

    $msg['id'] = $cn->insert_id;
    echo json_encode($msg);
?>