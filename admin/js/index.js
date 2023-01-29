$(document).ready(function () {
    var body = $('body');
    var popup = "<div class='popup'></div>";
    var frm = { "0": "frm-category.php", "1": "frm-news.php", "2": "frm-ads.php" };
    var frmOpt = 0;
    var tbl = $("#tblData");
    var loading = "<div class='popup'><div class='loading'></div></div>";
    var trIndex;

    var totalRow = $("#totalRow");
    var currentPage = $("#currentPage");
    var totalPage = $("#totalPage");
    var limitData = $("#txt-limit-data");
    var startRowIndex = 0;
    var showRow = limitData.val();

    var filterField = $("#txt-filter");
    var filter = [
        // {"id 0":"ID","title 1":"Title","status 0":"Status"},
        { "1 0": "ID", "2 1": "Title", "3 0": "Status" },//avoid see table data in view page source
        { "1 0": "ID", "2 1": "Title", "3 0": "Status", "4 1": "Menu" },
        { "1 0": "ID", "2 0": "Status" },
    ];

    var search = 0;
    var searchVal = $("#txt-search-val");
    $(".btnAdd").click(function () {
        body.append(popup);
        body.append(loading);
        body.find(".popup").first().load("frm/" + frm[frmOpt], function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success") {
                getAutoID();
                body.find('.popup').last().remove();
                calleditor();
            }
            if (statusTxt == "error") {
                alert("Error" + xhr.status + ":" + xhr.statusTxt);
            }
        });
    });
    body.on('click', 'table tr td .btnEdit', function () {
        var eThis = $(this);
        if (frmOpt == 0) {
            getEditMenu(eThis);
        } else if (frmOpt == 1) {
            getEditNews(eThis);
        } else if (frmOpt == 2) {
            getEditAds(eThis);
        }
    });
    $(".btnSearch").click(function () {
        if (searchVal.val() == '' || filterField.val() == 0) {
            search = 0;
        } else {
            search = 1;
        }

        if (frmOpt == 0) {
            get_menu();
        } else if (frmOpt == 1) {
            get_news();
        } else if (frmOpt == 2) {
            get_ads();
        }
    });
    $(".left-menu").on("click", ".sub-menu li", function () {
        frmOpt = $(this).data("opt");
        search = 0;
        var obj1 = filter[frmOpt];
        var txt = "<option value = '0'></option>";
        for (const key of Object.keys(obj1)) {
            console.log(key, obj1[key]);
            txt += `<option value = '${key}'>${obj1[key]}</option>`;
        }
        filterField.html(txt);


        currentPage.text("1");
        startRowIndex = 0;

        $(".box").show();
        if (frmOpt == 0) {
            get_menu();
        } else if (frmOpt == 1) {
            get_news();
        } else if (frmOpt == 2) {
            get_ads();
        }
    });
    body.on("click", ".frm .btnClose", function () {
        $(".popup").remove();
    });
    body.on("click", ".frm .btnSave", function () {
        var eThis = $(this);
        search = 1;
        if (frmOpt == 0) {
            save_menu(eThis);
        } else if (frmOpt == 1) {
            save_news(eThis);
        } else if (frmOpt == 2) {
            save_ads(eThis);
        }


    });
    body.on('change', '.frm .txt-file', function () {
        var eThis = $(this);
        var Parent = eThis.parents('.frm');
        var imgbox = Parent.find('.img-box');
        var photo = Parent.find('#txt-photo');
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/upl-img.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {
                //alert( data['img_name']);
                imgbox.css({ "background-image": `url(img/${data['img_name']})` });
                photo.val(data['img_name']);
                body.find('.popup').last().remove();
            }
        });
    });
    function save_menu(eThis) {
        var Parent = eThis.parents(".frm");
        var id = Parent.find("#txt-id");
        var title = Parent.find("#txt-title");
        var status = Parent.find("#txt-status");
        var od = Parent.find("#txt-od");
        var photo = Parent.find("#txt-photo");
        var imgbox = Parent.find('.img-box');
        var file = Parent.find('#txt-file');

        if (title.val() == '') {
            alert("Please input title");
            title.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/gategory-modify-data.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {

                if (data['edit'] == true) {
                    tbl.find('tr:eq(' + trIndex + ') td:eq(1)').text(title.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(2) img').attr("src", `img/${photo.val()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(2) img').attr("alt", `${photo.val()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(3)').text(status.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(4)').text(od.val());
                    body.find('.popup').remove();
                } else {    //add
                    var tr = `
                            <tr>
                                <td>${data['id']}</td>
                                <td>${title.val()}</td>
                                <td><img src= 'img/${photo.val()}' alt='${photo.val()}'></td>
                                <td>${status.val()}</td>
                                <td>${od.val()}</td>
                                <td><i class="fa-regular fa-pen-to-square btnEdit"></i></td>
                            </tr>
                    `;
                    tbl.find("tr:eq(0)").after(tr);
                    title.val('');
                    id.val(parseInt(data['id']) + 1);
                    od.val(parseInt(data['id']) + 1);
                    photo.val('');
                    file.val('');
                    imgbox.css({ "background-image": "url(img/placeholder-img.jpg)" });
                    title.focus();
                }


                body.find('.popup').last().remove();

            }
        });
    }
    function get_menu() {
        var th =
            `
            <tr>
                <th width=10>ID</th>
                <th>Title</th>
                <th width=50>Photo</th>
                <th width=10>Status</th>
                <th width=10>OD</th>
                <td width=10>action</td>
            </tr>
        `;

        $.ajax({
            url: 'action/get-menu-data-json.php',
            type: 'POST',
            data: { startRowIndex: startRowIndex, showRow: showRow, search: search, searchVal: searchVal.val(), filterField: filterField.val() },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {
                // if (data.length == 0) {
                //     body.find('.popup').remove();
                //     return;
                // }
                var txt = '';
                //console.log(data[0]['totalRow']); 

                totalRow.text(data[0]['totalRow']);
                totalPage.text(Math.ceil(data[0]['totalRow'] / showRow));
                data.forEach((e) => {
                    txt += `
                        <tr>
                            <td>${e['id']}</td>
                            <td>${e['title']}</td>
                            <td><img src='img/${e['img']}' alt='${e['img']}'> </td>
                            <td>${e['status']}</td>
                            <td>${e['od']}</td>
                            <td><i class="fa-regular fa-pen-to-square btnEdit"></i></td>
                        </tr>

                    `;
                });
                tbl.html(th + txt);
                body.find('.popup').remove();
            }
        });
    }
    function getEditMenu(eThis) {
        var Parent = eThis.parents("tr");
        var id = Parent.find('td:eq(0)').text();
        var title = Parent.find('td:eq(1)').text();
        var photo = Parent.find('td:eq(2) img').attr('alt');
        var status = Parent.find('td:eq(3)').text();
        var od = Parent.find('td:eq(4)').text();
        trIndex = Parent.index();
        body.append(popup);
        body.append(loading);
        body.find(".popup").first().load("frm/" + frm[frmOpt], function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success") {
                body.find('.frm #txt-id').val(id);
                body.find('.frm #txt-title').val(title);
                body.find('.img-box').css({ "background-image": `url(img/${photo})` });
                body.find('.frm #txt-status').val(status);
                body.find('.frm #txt-od').val(od);
                body.find('.frm #txt-photo').val(photo);
                body.find('.frm #txt-edit-id').val(id);
                body.find('.popup').last().remove();
            }
            if (statusTxt == "error") {
                alert("Error" + xhr.status + ":" + xhr.statusTxt);
            }
        });
    }
    function save_ads(eThis) {
        var Parent = eThis.parents(".frm");
        var id = Parent.find("#txt-id");
        var url = Parent.find("#txt-url");
        var status = Parent.find("#txt-status");
        var location = Parent.find("#txt-location");
        var type = Parent.find("#txt-type");
        var photo = Parent.find("#txt-photo");
        var imgbox = Parent.find('.img-box');
        var file = Parent.find('#txt-file');

        if (url.val() == '') {
            alert("Please input title");
            url.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/ads-modify-data.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {

                if (data['edit'] == true) {
                    tbl.find('tr:eq(' + trIndex + ') td:eq(1)').text(url.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(2) img').attr("src", `img/${photo.val()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(2) img').attr("alt", `${photo.val()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(3)').text(location.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(4)').text(type.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(5)').text(status.val());
                    
                    body.find('.popup').remove();
                } else {
                    var tr = `
                            <tr>
                                <td>${data['id']}</td>
                                <td>${url.val()}</td>
                                <td><img src= 'img/${photo.val()}' alt='${photo.val()}'></td>
                                <td>${location.val()}</td>
                                <td>${type.val()}</td>
                                <td>${status.val()}</td>
                                <td><i class="fa-regular fa-pen-to-square btnEdit"></i></td>
                            </tr>
                    `;
                    tbl.find("tr:eq(0)").after(tr);
                    url.val('');
                    id.val(parseInt(data['id']) + 1);
                    photo.val('');
                    file.val('');
                    imgbox.css({ "background-image": "url(img/placeholder-img.jpg)" });
                    url.focus();
                }


                body.find('.popup').last().remove();

            }
        });
    }
    function get_ads() {
        var th =
            `
            <tr>
                <th width=10>ID</th>
                <th>URL</th>
                <th width=50>Photo</th>
                <th width=20>Location</th>
                <th width=10>Type</th>
                <th width=10>Status</th>
                <td width=10>action</td>
            </tr>
        `;

        $.ajax({
            url: 'action/get-ads-data-json.php',
            type: 'POST',
            data: { startRowIndex: startRowIndex, showRow: showRow, search: search, searchVal: searchVal.val(), filterField: filterField.val() },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {
                if (data.length == 0) {
                    body.find('.popup').remove();
                    tbl.html(th + txt);
                    return;
                }
                var txt = '';
                //console.log(data[0]['totalRow']); 

                totalRow.text(data[0]['totalRow']);
                totalPage.text(Math.ceil(data[0]['totalRow'] / showRow));
                data.forEach((e) => {
                    txt += `
                        <tr>
                            <td>${e['id']}</td>
                            <td>${e['url']}</td>
                            <td><img src='img/${e['img']}' alt='${e['img']}'> </td>
                            <td>${e['location']}</td>
                            <td>${e['type']}</td>
                            <td>${e['status']}</td>
                            <td><i class="fa-regular fa-pen-to-square btnEdit"></i></td>
                        </tr>

                    `;
                });
                tbl.html(th + txt);
                body.find('.popup').remove();
            }
        });
    }
    function getEditAds(eThis) {
        var Parent = eThis.parents("tr");
        var id = Parent.find('td:eq(0)').text();
        var url = Parent.find('td:eq(1)').text();
        var photo = Parent.find('td:eq(2) img').attr('alt');
        var location = Parent.find('td:eq(3)').text();
        var type = Parent.find('td:eq(4)').text();
        var status = Parent.find('td:eq(5)').text();
       
        trIndex = Parent.index();
        body.append(popup);
        body.append(loading);
        body.find(".popup").first().load("frm/" + frm[frmOpt], function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success") {
                body.find('.frm #txt-id').val(id);
                body.find('.frm #txt-url').val(url);
                body.find('.img-box').css({ "background-image": `url(img/${photo})` });
                body.find('.frm #txt-status').val(status);
                body.find('.frm #txt-location').val(location);
                body.find('.frm #txt-type').val(type);
                body.find('.frm #txt-photo').val(photo);
                body.find('.frm #txt-edit-id').val(id);
                body.find('.popup').last().remove();
            }
            if (statusTxt == "error") {
                alert("Error" + xhr.status + ":" + xhr.statusTxt);
            }
        });
    }
    function save_news(eThis) {
        tinymce.triggerSave();
        var Parent = eThis.parents(".frm");
        var id = Parent.find("#txt-id");
        var m_title = Parent.find("#txt-news-category");
        var location = Parent.find("#txt-location");
        var title = Parent.find("#txt-title");
        var status = Parent.find("#txt-status");
        var od = Parent.find("#txt-od");
        var photo = Parent.find("#txt-photo");
        var imgbox = Parent.find('.img-box');
        var file = Parent.find('#txt-file');

        if (title.val() == '') {
            alert("Please input title");
            title.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/news-modify-data.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {
                if (data['edit'] == true) {
                    tbl.find('tr:eq(' + trIndex + ') td:eq(2)').html(`<span>${m_title.val()}</span> ${m_title.find("option:selected").text()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(3)').text(m_title.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(5) img').attr("src", `img/${photo.val()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(5) img').attr("alt", `${photo.val()}`);
                    tbl.find('tr:eq(' + trIndex + ') td:eq(4)').text(location.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(8)').text(status.val());
                    tbl.find('tr:eq(' + trIndex + ') td:eq(9)').text(od.val());
                    body.find('.popup').remove();
                } else {
                    var tr = `
                            <tr>
                                <td>${data['id']}</td>
                                <td>${data['post_date']}</td>
                                <td>${m_title.find('option:selected').text()}</td>
                                <td>${title.val()}</td>
                                <td><img src= 'img/${photo.val()}' alt='${photo.val()}'></td>
                                <td>${location.val()}</td>
                                <td>0</td>
                                <td>1</td>
                                <td>${status.val()}</td>
                                <td>${od.val()}</td>
                                <td><i class="fa-regular fa-pen-to-square btnEdit"></i></td>
                            </tr>
                    `;
                    tbl.find("tr:eq(0)").after(tr);
                    title.val('');
                    id.val(parseInt(data['id']) + 1);
                    od.val(parseInt(data['id']) + 1);
                    photo.val('');
                    file.val('');
                    imgbox.css({ "background-image": "url(img/placeholder-img.jpg)" });
                    title.focus();
                    tinyMCE.activeEditor.setContent('');
                }


                body.find('.popup').last().remove();


            }
        });
    }
    function get_news() {
        var th =
            `
            <tr>
                <td width=10>ID</td>
                <td width=180>DatePost</td>
                <td>Menu</td>
                <td>Title</td>
                <td>Location</td>
                <td width=50>Photo</td>
                <td width=50>Click</td>
                <td width=50>User</td>
                <td width=10>Status</td>
                <td width=10>OD</td>
                <td width=10>action</td>
            </tr>
        `;

        $.ajax({
            url: 'action/get-news-data-json.php',
            type: 'POST',
            data: { startRowIndex: startRowIndex, showRow: showRow, search: search, searchVal: searchVal.val(), filterField: filterField.val() },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                body.append(loading);
            },
            success: function (data) {
                if (data.length == 0) {
                    body.find('.popup').remove();
                    return;
                }
                var txt = '';
                //console.log(data[0]['totalRow']); 

                totalRow.text(data[0]['totalRow']);
                totalPage.text(Math.ceil(data[0]['totalRow'] / showRow));
                data.forEach((e) => {
                    txt += `
                        <tr>
                            <td>${e['id']}</td>
                            <td>${e['date_post']}</td>
                            <td><span class="mid">${e['mid']}</span> ${e['menu_name']}</td>
                            <td>${e['title']}</td>
                            <td>${e['location']}</td>
                            <td><img src='img/${e['img']}' alt='${e['img']}'> </td>
                            <td>${e['click']}</td>
                            <td>${e['uid']}</td>
                            <td>${e['status']}</td>
                            <td>${e['od']}</td>
                            <td><i class="fa-regular fa-pen-to-square btnEdit"></i></td>
                        </tr>

                    `;
                });
                tbl.html(th + txt);
                body.find('.popup').remove();
            }
        });
    }
    function getAutoID() {
        $.ajax({
            url: 'action/get-auto-id.php',
            type: 'POST',
            data: { "opt": frmOpt },
            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success

            },
            success: function (data) {
                //work after success    
                body.find('.frm #txt-id').val(parseInt(data['id']) + 1);
                body.find('.frm #txt-od').val(parseInt(data['id']) + 1);
            }
        });
    }

    function getEditNews(eThis) {
        var Parent = eThis.parents("tr");
        var id = Parent.find('td:eq(0)').text();
        var mid = Parent.find('td:eq(2) span').text();
        var title = Parent.find('td:eq(3)').text();
        var location = Parent.find('td:eq(4)').text();
        var status = Parent.find('td:eq(8)').text();
        var od = Parent.find('td:eq(9)').text();
        var photo = Parent.find('td:eq(5) img').attr('alt');
        trIndex = Parent.index();
        //alert(title);
        body.append(popup);
        body.append(loading);
        body.find(".popup").first().load("frm/" + frm[frmOpt], function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success") {
                body.find('.frm #txt-id').val(id);
                body.find('.frm #txt-edit-id').val(id);
                body.find('.frm #txt-news-category').val(mid);
                body.find('.frm #txt-title').val(title);
                body.find('.frm #txt-location').val(location);
                body.find('.frm #txt-status').val(status);
                body.find('.frm #txt-od').val(od);
                body.find('.popup').last().remove();
                body.find('.frm #txt-photo').val(photo);
                body.find('.frm .img-box').css({ "background-image": `url(img/${photo})` });

                $.ajax({
                    url: 'action/get_news_description.php',
                    type: 'POST',
                    data: { id: id },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {
                        body.append(loading);
                    },
                    success: function (data) {
                        body.find('.frm #txt-des').val(data['des']);
                        body.find('.popup').last().remove();
                        calleditor();
                    }
                });
            }
            if (statusTxt == "error") {
                alert("Error" + xhr.status + ":" + xhr.statusTxt);
            }
        });
    }
    $('#btnNext').click(function () {
        //currentPage.text(parseInt(currentPage.text())+1); 
        if (parseInt(currentPage.text()) == parseInt(totalPage.text())) {
            return;
        }
        startRowIndex = startRowIndex + parseInt(showRow);
        if (frmOpt == 0) {
            get_menu();
        } else if (frmOpt == 1) {
            get_news();
        } else if (frmOpt == 2) {
            get_ads();
        }
        currentPage.text(parseInt(currentPage.text()) + 1);
    });
    $('#btnBack').click(function () {
        if (parseInt(currentPage.text()) == 1) {
            return;
        }
        startRowIndex = startRowIndex - parseInt(showRow);
        currentPage.text(parseInt(currentPage.text()) - 1);
        if (frmOpt == 0) {
            get_menu();
        } else if (frmOpt == 1) {
            get_news();
        } else if (frmOpt == 2) {
            get_ads();
        }
    });
    limitData.change(function () {
        currentPage.text("1");
        startRowIndex = 0;
        showRow = $(this).val();
        if (frmOpt == 0) {
            get_menu();
        } else if (frmOpt == 1) {
            get_news();
        } else if (frmOpt == 2) {
            get_ads();
        }
    });
    function calleditor() {
        tinymce.remove();
        tinymce.init({
            selector: "textarea", theme: "modern", width: "760", height: "250", relative_urls: false, remove_script_host: false,
            file_browser_callback: function (field_name, url, type, win) {
                var filebrowser = "js/filebrowser.php";
                filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + type : "&type=" + type;
                tinymce.activeEditor.windowManager.open({
                    title: "Insert Photo",
                    width: 660,
                    height: 500,
                    url: filebrowser
                }, {
                    window: win,
                    input: field_name
                });
                return false;
            },
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools media code",
            ],
            menubar: true, toolbar1: "undo redo | insert | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
            toolbar2: "fontselect | fontsizeselect | forecolor media code",
        });
    }
});