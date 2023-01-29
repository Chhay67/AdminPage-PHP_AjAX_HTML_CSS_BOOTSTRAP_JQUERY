<?php 
    $cn = new mysqli("localhost","root","","myphp_2");
    $cn->set_charset("utf8");
    $title = $_POST['txt-title']; 
    $title = $cn->real_escape_string($title);
    $status = $_POST['txt-status'];
    $id = $_POST['txt-id'];
    $od = $_POST['txt-od'];
    $img =$_POST['txt-photo'];
    $edit_id = $_POST['txt-edit-id'];
    $msg['id'] = 0;
    $msg['dup'] = false;
    $msg['edit'] = false;
    //check duplicate name
    $sql = "SELECT * FROM tbl_menu WHERE title = '$title' AND id != $id";
    $rs = $cn->query($sql);
    if($rs->num_rows > 0)
    {
        $msg['dup'] = true; 
    }else{
        if($edit_id == 0)
        {
            $sql = "INSERT INTO tbl_menu VALUES(null,'$title','$img','$status','$od')";
            $cn->query($sql);

        }else{
            $sql = "UPDATE tbl_menu SET title='$title',img='$img',status='$status',od='$od' WHERE id =$edit_id";
            $cn->query($sql);
            $msg['edit'] = true;
        }        
    }
    
    $msg['id'] = $cn->insert_id;
    echo json_encode($msg);
?>