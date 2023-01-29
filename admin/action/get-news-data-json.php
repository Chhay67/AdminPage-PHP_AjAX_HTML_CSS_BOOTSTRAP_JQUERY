<?php 
    $cn = new mysqli("localhost","root","","myphp_2");
    $cn->set_charset("utf8");
    $startIndex = $_POST['startRowIndex'];
    $showRow = $_POST['showRow'];
    $search = $_POST['search'];
    $searchVal = $_POST['searchVal'];
    $filterField =explode(" ",$_POST['filterField']); // id 0 split by space
    $fld = array(
        "1" => "tbl_news.id",
        "2" => "tbl_news.title",
        "3" => "tbl_news.status",
        "4" => "tbl_menu.title",
    );

    

    if($search == 0)
    {
        $sql = "SELECT tbl_news.* ,tbl_menu.title FROM tbl_news
                INNER JOIN tbl_menu ON tbl_news.mid = tbl_menu.id 
                ORDER BY tbl_news.id DESC LIMIT $startIndex,$showRow";
        //count row data
        $count = "SELECT COUNT(*) AS total FROM tbl_news";
    }else {
        if($filterField[1] == 0)
        {

            $sql = "SELECT tbl_news.* ,tbl_menu.title 
                    FROM tbl_news
                    INNER JOIN tbl_menu ON tbl_news.mid = tbl_menu.id  
                    WHERE ".$fld[$filterField[0]]." = '$searchVal'
                    ORDER BY tbl_news.id   DESC LIMIT $startIndex,$showRow";


            
            //count row data
            $count="SELECT COUNT(*) AS total 
                    FROM tbl_news 
                    INNER JOIN tbl_menu ON tbl_news.mid = tbl_menu.id  
                    WHERE ".$fld[$filterField[0]]." = '$searchVal'";
        }else{
            
            $sql = "SELECT tbl_news.* ,tbl_menu.title 
                    FROM tbl_news
                    INNER JOIN tbl_menu ON tbl_news.mid = tbl_menu.id  
                    WHERE ".$fld[$filterField[0]]." LIKE '%$searchVal%'
                    ORDER BY tbl_news.id   DESC LIMIT $startIndex,$showRow";

            $count="SELECT COUNT(*) AS total 
                    FROM tbl_news 
                    INNER JOIN tbl_menu ON tbl_news.mid = tbl_menu.id  
                    WHERE ".$fld[$filterField[0]]." LIKE '%$searchVal%'";

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
            "title" => $row[1],
            "img" => $row[2],
            "date_post" =>date("d-M-y h:iA",strtotime($row[4])),
            "location" => $row[5],
            "click" => $row[6],
            "mid" =>$row[7],
            "uid" => $row[8],
            "status" => $row[9],
            "od" => $row[10],
            "totalRow" => $RowCount[0],
            "menu_name" => $row[12],
        );
    }
    echo json_encode($data);
?>