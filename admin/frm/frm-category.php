<div class="frm">
    <div class="header">
        <h3>Category</h3>
        <div class="btnClose">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <form class='upl'> 
        <div class="frm-body">
            <input type="hidden" name="txt-edit-id" id="txt-edit-id" value="0">
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id" readonly class="frmStyle">
            <label for="">title</label>
            <input type="text" name="txt-title" id="txt-title" class="frmStyle">
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
        <div class="frm-footer">
            <div class="btnSave">
                <i class="fa-regular fa-floppy-disk"></i> Save
            </div>
        </div>
    </form>
</div>