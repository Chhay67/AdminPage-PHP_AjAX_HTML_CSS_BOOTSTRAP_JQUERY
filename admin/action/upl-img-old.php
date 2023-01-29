<?php
     $file = $_FILES['txt-file'];
     $ext = pathinfo($file['name'],PATHINFO_EXTENSION);
     $new_name = rand(100000, 999999).'-'.time().'.'.$ext;
     $tmp_name = $file['tmp_name'];
     move_uploaded_file($tmp_name,'../img/'.$new_name);       
     $msg['img_name'] = $new_name;
     echo json_encode($msg);
?>  