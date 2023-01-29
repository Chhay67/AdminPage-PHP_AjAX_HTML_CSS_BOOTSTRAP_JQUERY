<?php 
    $cn = new mysqli("localhost","root","","myphp_2");
    $cn->set_charset("utf8");
    $startIndex = $_POST['startRowIndex'];
    $showRow = $_POST['showRow'];
    $search = $_POST['search'];
    $searchVal = $_POST['searchVal'];
    $filterField =explode(" ",$_POST['filterField']); // id 0 split by space
    $fld = array(
        "1" => "id",
        "2" => "status",
    );

    // if($filterField[0] == 1)
    // {
    //     $fld = 'id';
    // }else if($filterField[0] == 2)
    // {
    //     $fld = "title";
    // }else if($filterField[0] == 3)
    // {
    //     $fld = 'status';
    // }

    if($search == 0)
    {
        $sql = "SELECT * FROM tbl_ads ORDER BY id DESC LIMIT $startIndex,$showRow";
        //count row data
        $count = "SELECT COUNT(*) AS total FROM tbl_ads";
    }else {
        if($filterField[1] == 0)
        {
            $sql = "SELECT * FROM tbl_ads WHERE ".$fld[$filterField[0]]." = '$searchVal' ORDER BY id DESC LIMIT $startIndex,$showRow";
            //count row data
            $count = "SELECT COUNT(*) AS total FROM tbl_ads WHERE ".$fld[$filterField[0]]." = '$searchVal'";
        }else{
            $sql = "SELECT * FROM tbl_ads WHERE ".$fld[$filterField[0]]." LIKE '%$searchVal%' ORDER BY id DESC LIMIT $startIndex,$showRow";
            $count = "SELECT COUNT(*) AS total FROM tbl_ads WHERE ".$fld[$filterField[0]]." LIKE '%$searchVal%'";
        }
        
    }
   
    $rs = $cn->query($sql);
    $data = array();

    //count row data
    // $count = "SELECT COUNT(*) AS total FROM tbl_menu";
    $rsCount = $cn->query($count);
    $RowCount = $rsCount->fetch_array();

    //show data like json data
    while($row = $rs->fetch_array())
    {
        $data[] = array(
            "id" => $row[0],
            "url" => $row[1],
            "img" => $row[2],
            "location" => $row[3],
            "type" => $row[4],
            "status" => $row[5],
            "totalRow" => $RowCount[0],
        );
    }
    echo json_encode($data);
?>