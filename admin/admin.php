<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style1.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
</head>
<body>
    <div class="menu-bar">
    
        <div class="drawer-left">
            <i class="fa-solid fa-bars"></i>
        </div> 
        <div class="brand">
            <span>Admin</span>
        </div>
        <div class="drawer-right">
            <span>email@gmail.com</span>
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
    </div>
    <div class="left-menu">
        <ul>
            <li>
                <a>
                    
                    <i class="fa-solid fa-user-shield"></i>
                    <span>User</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a >User</a>
                    </li>
                </ul>
            </li>
            <li>
                <a>
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Setup</span>
                </a>
                <ul class="sub-menu">
                    <li data-opt="0">
                        <a>Category</a>
                    </li>
                    <li data-opt="1">
                        <a>News</a>
                    </li>
                    <li data-opt="2">
                        <a>Advertisement</a>
                    </li>
                    
                    
                </ul>             
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="box">
            <div class="box-item">
                <div class="btnAdd">
                    <i class="fa-solid fa-plus"></i>Add
                </div>
                <div class="search-box">
                    <input type="text" name="txt-search-val" id="txt-search-val" placeholder="search">
                    <select name="txt-filter" id="txt-filter">
                        <option value="0"></option>
                        
                    </select>
                    <div class="btnSearch"><i class="fa-solid fa-magnifying-glass"></i></div>
                </div>
            </div>
            <div class="box-item">
                <ul>
                    <li>
                        <select name="txt-limit-data" id="txt-limit-data">
                            <option value="2">2</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                    </li>
                    <li id="btnBack">
                        <i class="fa-solid fa-angle-left"></i>
                    </li>
                    <li>
                        <span id="currentPage">0</span>&nbsp; /&nbsp;<span id="totalPage">0</span>&nbsp;of&nbsp;<span id="totalRow">0</span>
                    </li>
                    <li id="btnNext">
                        <i class="fa-solid fa-angle-right"></i>
                    </li>
                </ul>
               
            </div>
        </div> 
        <table id='tblData'></table>
    </div>
    <script src="js/index.js"></script>
</body>
</html>