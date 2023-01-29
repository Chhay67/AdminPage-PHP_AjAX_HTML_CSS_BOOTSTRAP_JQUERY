<?php 
    $cn = new mysqli("localhost", "root", "", "myphp_2");
    $cn->set_charset("utf8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Battambang&family=Bayon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="container-fluid menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 menu">
                    <ul>
                        <li><a href=""><i class="fa-solid fa-house-chimney"></i></a></li>
                        <?php
                            $sql = "SELECT id,title FROM tbl_menu WHERE status = 1";
                            $rs = $cn->query($sql);
                            while($row = $rs->fetch_array())
                            {
                                ?>
                                    <li><a href=""><?php echo $row[1]; ?></a></li>
                                <?php
                            }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container slide-container">
        <div class="row">
            <?php
                $sql = "SELECT id,title,img FROM tbl_news WHERE location = 1 && status = 1";
                $rs = $cn->query($sql);
                $row = $rs->fetch_array();
            ?>
            <div class="col-xl-8 slide-box">
                <a href="" class="box">
                    <img src="../admin/img/<?php echo $row[2]; ?>" alt="">
                    <h1><?php echo $row[1]; ?></h1>
                </a>
            </div>
            <div class="col-xl-4 ads-box">
                <ul>
                    <?php
                        $sql = "SELECT * FROM tbl_ads WHERE status = 1 && location = 1 ORDER BY id DESC LIMIT 0,2";
                        $rs = $cn->query($sql);
                        while($row = $rs->fetch_array())
                        {
                            if($row[4] == 1)
                            {
                                ?>
                                <li>
                                    <a href="<?php echo $row[1]; ?>" target="_blank">
                                        <img src="../admin/img/<?php echo $row[2]; ?>" alt="">
                                    </a>
                                </li>
                                <?php
                            }else
                            {
                                ?>
                                    <li>
                                        <?php echo $row[1]; ?>
                                    </li>
                                <?php
                            }
                        }
                    ?> 



                    <li>
                        <a href="">
                            <img src="style/img/554552-1666764348.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/vhS-PrYomEk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container news-container">
        <div class="row">
            <div class="col-xl-3 news-box">
                <a href="" class="box">
                    <img src="style/img/554552-1666764348.jpg" alt="">
                    <span>ព្រឹត្តិការណ៍​បាល់ទាត់ក្លឹប​ពិភពលោក​ FIFA Club World Cup នឹង​ផ្លាស់ប្ដូរ​ទៅ​លេង​ក្នុង​ទម្រង់ ៣ឆ្នាំ​ម្ដង។ នេះ​បើ​តាម​ការ​លើកឡើង​របស់​លោក Gianni Infantino ប្រធាន​សហព័ន្ធ​នៃ​សមាគម​បាល់ទាត់​ពិភពលោក ឬ ហៅ​កាត់​ថា FIFA នៅ​ក្នុង​ថ្ងៃ​សុក្រ​នេះ។</span>
                </a>
            </div>
            <div class="col-xl-3 news-box">
                <a href="" class="box">
                    <img src="style/img/554552-1666764348.jpg" alt="">
                    <span>ព្រឹត្តិការណ៍​បាល់ទាត់ក្លឹប​ពិភពលោក​ FIFA Club World Cup នឹង​ផ្លាស់ប្ដូរ​ទៅ​លេង​ក្នុង​ទម្រង់ ៣ឆ្នាំ​ម្ដង។ នេះ​បើ​តាម​ការ​លើកឡើង​របស់​លោក Gianni Infantino ប្រធាន​សហព័ន្ធ​នៃ​សមាគម​បាល់ទាត់​ពិភពលោក ឬ ហៅ​កាត់​ថា FIFA នៅ​ក្នុង​ថ្ងៃ​សុក្រ​នេះ។</span>
                </a>
            </div>
            <div class="col-xl-3 news-box">
                <a href="" class="box">
                    <img src="style/img/554552-1666764348.jpg" alt="">
                    <span>ព្រឹត្តិការណ៍​បាល់ទាត់ក្លឹប​ពិភពលោក​ FIFA Club World Cup នឹង​ផ្លាស់ប្ដូរ​ទៅ​លេង​ក្នុង​ទម្រង់ ៣ឆ្នាំ​ម្ដង។ នេះ​បើ​តាម​ការ​លើកឡើង​របស់​លោក Gianni Infantino ប្រធាន​សហព័ន្ធ​នៃ​សមាគម​បាល់ទាត់​ពិភពលោក ឬ ហៅ​កាត់​ថា FIFA នៅ​ក្នុង​ថ្ងៃ​សុក្រ​នេះ។</span>
                </a>
            </div>
            <div class="col-xl-3 news-box">
                <a href="" class="box">
                    <img src="style/img/554552-1666764348.jpg" alt="">
                    <span>ព្រឹត្តិការណ៍​បាល់ទាត់ក្លឹប​ពិភពលោក​ FIFA Club World Cup នឹង​ផ្លាស់ប្ដូរ​ទៅ​លេង​ក្នុង​ទម្រង់ ៣ឆ្នាំ​ម្ដង។ នេះ​បើ​តាម​ការ​លើកឡើង​របស់​លោក Gianni Infantino ប្រធាន​សហព័ន្ធ​នៃ​សមាគម​បាល់ទាត់​ពិភពលោក ឬ ហៅ​កាត់​ថា FIFA នៅ​ក្នុង​ថ្ងៃ​សុក្រ​នេះ។</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>