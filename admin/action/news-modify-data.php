<?php 
    date_default_timezone_set("Asia/Phnom_Penh");
    $cn = new mysqli("localhost","root","","myphp_2");

    $cn->set_charset("utf8");
    $title = $_POST['txt-title']; 
    $title = $cn->real_escape_string($title);
    $img =$_POST['txt-photo'];
    $des = trim($_POST['txt-des']);
    $des = $cn->real_escape_string($des);
    $date_post = date("Y-m-d h:i:s A");
    $location = $_POST['txt-location'];
    $click = 0;
    $mid = $_POST['txt-news-category'];
    $uid = 1;
    $status = $_POST['txt-status'];
    $od = $_POST['txt-od'];
    $id = $_POST['txt-id'];
    $name_link = "nameLink";
    $edit_id = $_POST['txt-edit-id'];
    
    
    
    
    
    $msg['id'] = 0;
    $msg['edit'] = false; 
    
        if($edit_id == 0)
        {
            $sql = "INSERT INTO tbl_news VALUES(null,'$title','$img','$des','$date_post',
                    '$location','$click','$mid','$uid','$status','$od','$name_link')";
            $cn->query($sql);
        }else{
            $sql = "UPDATE tbl_new SET title='$title',img='$img',des='$des',
                    location='$location',mid='$mid',status='$status',od='$od',
                    name_link='$name_link' WHERE id =$edit_id";
            $cn->query($sql);
            $msg['edit'] = true;
        }        
    $msg['id'] = $cn->insert_id;
    $msg['post_date'] = $date_post;
    echo json_encode($msg);
?>