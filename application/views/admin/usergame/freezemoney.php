
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Kiểm tra số dư đóng băng của User</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php //if (!empty($uri)) { ?>
<!--    <div class="wrapper return-url">-->
<!--        <a class="" href="--><?//= admin_url('agency/listUserOfAgency') . '?' .$uri ?><!--">-->
<!--            <i class="fas fa-angle-double-left"></i> Quay lại-->
<!--        </a>-->
<!--    </div>-->
<?php //} ?>
<link rel="stylesheet"
      href="<?php echo public_url() ?>/site/css/loggamethirdparty.css"><?php if(false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php $this->load->view('admin/error')?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>
        <div class="widget">
            <h4 id="resultsearch"></h4>
            <div class="form-group successful">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <label class="control-label col-sm-2" id="successgift" style="color: #00a65a"></label>
                </div>
            </div>
            <div class="form-group successful">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <label class="control-label col-sm-2" id="errorgift" style="color: red"></label>
                </div>
            </div>

            <form class="list_filter form" action="<?php echo admin_url('usergame/freezemoney') ?>" method="post">


                <div class="formRow">
                    <table>
                        <tr>

                            <td>
                                <label for="param_name" class="formLeft nickname">NickName:</label></td>
                            <td class="item">
                                <div class="input-group date">
                                    <input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                           id="nickname" value="<?php echo $this->input->post('nickname') ?>" name="nickname">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow row">
                    <div class="col-sm-1">
                        <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB">
                    </div>
                    <div class="col-sm-1">
                        <input type="reset"  value="Reset" class="basic">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="float-right">Tổng bản ghi:<span style="color:#0000ff" id="total"></span></h3>
                </div>
                <div class="col-sm-12">
                    <div id="resultsearch" class="float-left text-danger"></div>
                </div>
            </div>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered" id="checkAll">
                            <thead>
                            <tr class="list-loggameslot">
                                <td>Session id</td>
                                <td>Nick name</td>
                                <td>Tên game</td>
                                <td>Số tiền đóng băng</td>
                                <td>Ngày tạo</td>
                                <td>Hành động</td>
                            </tr>
                            </thead>
                            <tbody id="logaction">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<div class="container">
    <div id="spinner" class="spinner image-loggameslot">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>
    $(function () {

        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59);

        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: endDate,
            useCurrent : false,
        });

    });

    $( "#search_tran" ).click(function() {
        SearchUser();
    });

    function SearchUser() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/freezemoneyAjax')?>",
            data: {
                nickname: $('#nickname').val(),
                //toDate: $('#toDate').val()
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    let totalPage = 1;
                    $("#resultsearch").html("");
                    let total = 0;

                    result.sort(function(a,b){
                        // Turn your strings into dates, and then subtract them
                        // to get a value that is either negative, positive, or zero.
                        return new Date(b.message) - new Date(a.message);
                    });

                    $.each(result, function (index, value) {
                        result += resultSearchTransction(value);
                        total++;
                    });
                    $('#logaction').html(result);
                    $('#total').html(total);
                }            }, error: function () {
                $('#logaction').html("");
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    };

    function Active(sid) {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/freezemoneyFunc') ?>",
            data: {
                sid: sid
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                $("#successgift").html("Phá băng thành công");
                $("#errorgift").html("");
            }, error: function () {
                $("#spinner").hide();
                $("#successgift").html("");
                $("#errorgift").html("Hệ thống quá tải, vui lòng thử lại sau");
            }, timeout: 60000
        })

    }

    function resultSearchTransction(data) {
        var rs = "";

        if(data.money > 0) {
            rs += "<tr>";

            rs += "<td>" + data.session_id + "</td>";
            rs += "<td>" + data.nick_name + "</td>";
            rs += "<td>" + data.game_name + "</td>";
            rs += "<td>" + data.money + "</td>";
            rs += "<td>" + data.create_time + "</td>";
            if (data.money > 0) {
                rs += "<td class='option'>" +
                    "<a href=\"#\" title=\"Phá Băng\" onclick=\"Active(" + "'" + data.session_id + "'" + ");\" class=\"text-primary btn-circle\"> <i class=\"fa fa-unlock fa-2x\" aria-hidden=\"true\"></i></a>" +
                    "</td>";
            } else {
                rs += "<td class='option'>" +

                    "</td>";
            }

            rs += "</tr>";
        }

        return rs;
    }

</script>