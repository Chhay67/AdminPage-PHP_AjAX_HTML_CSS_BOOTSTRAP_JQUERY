<?php 
    $cn = new mysqli("localhost","root","","myphp_2");
    $cn->set_charset("utf8");
    $sql = "SELECT * FROM tbl_menu ORDER BY id DESC";
    $rs = $cn->query($sql);
    //show data like html data
    ?>
    <tr>
       <td>ID</td>
        <td>Title</td>
        <td>Photo</td>
        <td>Status</td>
        <td>OD</td>
    </tr>
    <?php
    while($row = $rs->fetch_array())
    {
        ?>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
            </tr>
        <?php
    }
    //show data like json data
?>