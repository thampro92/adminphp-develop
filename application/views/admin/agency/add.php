<!-- head -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Quản lý đại lý</h5>
        </div>
        <div class="horControlB menu_action">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div><div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">

        <?php if($admin_info->Status == "A"): ?>
            <div class="title">
                <h6>Thêm mới admin đại lý</h6>
            </div>
            <form id="form" class="form" enctype="multipart/form-data" method="post" action="">

                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <label class="control-label" id="errorstatus" style="color: red"></label>
                        </div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <label for="inputEmail3" class="col-sm-2 control-label">Nick name:</label>

                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="name" id="param_name"
                                   placeholder="Nhập nick name">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" value="Tìm kiếm" name="submit"
                                   class="button blueB" id="searchnickname">
                        </div>
                    </div>
                </div>            </form>
            <div id="info_user" style="display: none">
                <table class="table table-bordered" style="table-layout: fixed; width: 100%">
                    <thead>
                    <tr>
                        <th>NickName</th>
                        <th>UserName</th>
                        <th>Bot</th>
                        <th>Đại lý</th>
                        <th>Win Total</th>
                        <th>Mobile</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="logaction">
                </table>
            </div>
            <style>.spinner {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    margin-left: -50px; /* half width of the spinner gif */
                    margin-top: -50px; /* half height of the spinner gif */
                    text-align: center;
                    z-index: 1234;
                    overflow: auto;
                    width: 100px; /* width of the spinner gif */
                    height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
                }</style>
            <div class="container">
                <div id="spinner" class="spinner" style="display:none;">
                    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
                </div>
            </div>
        <?php else : ?>
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>

        <?php endif ?>
    </div>
</div>

<script>
    $("#searchnickname").click(function () {
        if ($("#param_name").val() == "") {
            $("#errorstatus").css("display", "block");
            $("#info_user").css("display", "none")
            $("#errorstatus").html("Bạn chưa nhập nick name");
            return false;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('agency/getinfoajax')?>",
            data: {
                nickname: $("#param_name").val()
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.user != null) {
                    $("#info_user").css("display", "block");
                    $("#errorstatus").html("");
                    $("#setadmin").val("Người chơi");
                    let str = resultSearchTransction(result.user)
                    $('#logaction').html(str);

                    handleActionListener()
                } else if (result.user == null) {
                    $("#errorstatus").html("Nick name đã được đăng ký hoặc không tồn tại");
                    $("#info_user").css("display", "none")
                }
            }
        })
    });

    function resultSearchTransction(value) {
        var rs = "";
        rs += `<tr>`;
        rs += `<td class='nickname'>${value.nickname}</td>`
        rs += `<td>${value.username}</td>`
        rs += `<td><i class="${value.is_bot ? 'fa fa-check' : '-'}" aria-hidden='true'></i></td>`
        rs += `<td><i class="${value.dai_ly ? 'fa fa-check' : '-'}" aria-hidden='true'></i></td>`
        rs += `<td>${value.vinTotal}</td>`
        rs += `<td>${value.mobile|| '-'}</td>`
        rs += (value.is_bot ?
            `<th>Tài khoản bot không thể làm đại lý</th>` :
            `<th><input type="button" value="Đăng kí đại lý" name="submit" class="button blueB" id="setadmin"></th>`)
        rs += `</tr>`;
        return rs;
    }

    function handleActionListener() {
        $("#setadmin").click(function (e) {
            let nameTxt = $(this).closest('tr').find('.nickname').text();
            bootbox.prompt("Nhập mã đại lý để hoàn thành. Chú ý refcode không thể thay đổi sau khi hoàn thành!", function(result){
                if(result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo admin_url(); ?>" + "/agency/addadmin",
                        dataType: 'json',
                        data: {
                            agency_code: result,
                            nickname: nameTxt
                        },
                        success: function (response) {
                            if(response.success) {
                                bootbox.alert({
                                    message: `<i class="fa fa-times-circle text-success" aria-hidden="true"></i> Thêm mới đại lý thành công`,
                                    backdrop: true,
                                    centerVertical: true
                                })
                                $("#errorstatus").html("");
                                $("#info_user").css("display", "none")
                            } else {
                                bootbox.alert({
                                    message: `<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> Đã có lỗi xảy ra ${response.errorCode}`,
                                    backdrop: true,
                                    centerVertical: true
                                })
                            }

                        },
                        error: function (error) {
                            console.error(error)
                        }
                    });
                }
            });        });
    }

    $("#setadmin").click(function () {

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url(); ?>" + "/agency/addadmin",
                dataType: 'json',
                data: {
                    username: data_user.username,
                    nickname: data_user.nickname
                },
                success: function (response) {
                    if (response == 2) {
                        var baseurl = "<?php echo admin_url('agency/add') ?>";
                        window.location.href = baseurl;
                    }else if(response == 0){
                        $("#errorstatus").html("Tài khoản đã tồn tại");
                    }
                },
                error: function (error) {
                    console.error(error)
                }
            });

    });
</script>