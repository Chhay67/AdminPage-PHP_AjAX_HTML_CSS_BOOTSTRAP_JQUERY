<?php 
    $cn = new mysqli("localhost","root","","myphp_2");
    $cn->set_charset("utf8");
?>
<div class="frm">
    <div class="header">
        <h3>News</h3>
        <div class="btnClose">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <form class='upl'>
        <div class="frm-body">
            <div class="frm-item">
                <input type="hidden" name="txt-edit-id" id="txt-edit-id" value="0">
                <label for="">ID</label>
                <input type="text" name="txt-id" id="txt-id" readonly class="frmStyle">
                <label for="">News category</label>
                <select name="txt-news-category" id="txt-news-category" class="frmStyle">
                    <option value="0"></option>
                    <?php
                        $sql ="SELECT id,title FROM tbl_menu WHERE status = 1";
                        $rs = $cn->query($sql);
                        while($row = $rs->fetch_array())
                        {
                            ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                            <?php
                        }
                    ?>
                   
                </select>
                <label for="">Location</label>
                <select name="txt-location" id="txt-location" class="frmStyle">
                    <option value="1">select location</option>
                </select>
                <label for="">status</label>
                <select name="txt-status" id="txt-status" class="frmStyle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <label for="">od</label>
                <input type="text" name="txt-od" id="txt-od" class="frmStyle">
                <label for="">Photo</label>
                <div class="img-box">
                    <input type="file" name="txt-file" id="txt-file" class="txt-file">
                    <input type="hidden" name="txt-photo" id="txt-photo">
                </div>
            </div>
            <div class="frm-item">
                <label for="">title</label>
                <input type="text" name="txt-title" id="txt-title" class="frmStyle"><br><br><br>
                <label for="">Description</label>
                <textarea name="txt-des" id="txt-des" rows="20" class="frmStyle"></textarea>
            </div>



        </div>
        <div class="frm-footer">
            <div class="btnSave">
                <i class="fa-regular fa-floppy-disk"></i> Save
            </div>
        </div>
    </form>
</div>