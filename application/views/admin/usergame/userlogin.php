<?php $this->load->view('admin/usergame/head', $this->data) ?>
<div class="line"></div>
<?php if ($role == false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>

        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
            <div class="title">
                <h6>Lịch sử tài khoản login</h6>
                <h6 style="float: right">Tổng số:<span style="color:#0000ff" id="numuser"></span></h6>
            </div>
            <form class="list_filter form">
                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="width: 100px">Nick name:</label></td>
                            <td><input type="text" style="width: 150px"
                                       id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name">
                            </td>
                            <td><label style="width: 100px;padding-left: 10px;">Ip:</label></td>
                            <td class="">
                                <input type="text" style="width: 150px"
                                       id="iplogin" value="<?php echo $this->input->post('iplogin') ?>" name="iplogin">
                            </td>
                            <td><label style="width: 100px;padding-left: 10px;">Mã Máy:</label></td>
                            <td class="">
                                <input type="text" style="width: 150px"
                                       id="devicelogin" value="<?php echo $this->input->post('devicelogin') ?>"
                                       name="devicelogin">
                            </td>
                            <td><label style="width: 100px;padding-left: 10px;">Trạng thái:</label></td>
                            <td class="">
                                <select id="status" name="timkiemtheo"
                                        style="width: 150px">
                                    <option value="1" <?php if ($this->input->post('timkiemtheo') == "1") {
                                        echo "selected";
                                    } ?>>Đăng nhập
                                    </option>
                                    <option value="0" <?php if ($this->input->post('timkiemtheo') == "0") {
                                        echo "selected";
                                    } ?>>Đăng ký
                                    </option>
                                </select>
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="width: 100px;min-width: auto;padding:0;text-align: left;">Từ ngày:</label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1" style="width: 150px !important;">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?php echo $this->input->post('toDate') ?>"> <span
                                            class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>

                            <td>
                                <label for="param_name"
                                       style="width: 100px;min-width: auto;padding:0;text-align: left;padding-left: 10px;"
                                       class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2" style="width: 150px !important;">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?php echo $this->input->post('fromDate') ?>"> <span
                                            class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                            <td style="display: flex">
                                <button id="search_tran" type="button" class="button blueB" style="margin-left: 10px">
                                    Tìm kiếm
                                </button>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('usergame/userlogin') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow"></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>User name</td>
                    <td>Nick name</td>
                    <td>IP</td>
                    <td>Thiết bị</td>
                    <td>Trạng thái</td>
                    <td>Bảo mật</td>
                    <td>Ngày tạo</td>
                    <td>Số lượng</td>
                    <td>Sử dụng giftcode</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
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
    }

    .ip-search {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<div class="container">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script src="<?php echo public_url('js') ?>/jquery/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin') ?>/css/colorbox.css" media="screen"/>
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        initiate();
    })

    function resultSearchTransction(stt, username, nickname, ip, agent, type, security, date, numbergc) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + username + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += `<td><span class='ip-search' value='${ip}' onclick="ipSearch('${ip}')">${ip}</span></td>`;
        rs += `<td><span class='ip-search' value='${agent}' onclick="deviceSearch('${agent}')">${agent}</span></td>`;


        if (type == 1) {
            rs += "<td>" + " Đăng nhập" + "</td>";
        } else {
            rs += "<td>" + "Đăng ký" + "</td>";
        }
        if (security == 1) {
            rs += "<td>" + "Có" + "</td>";
        } else if (security == 0) {
            rs += "<td>" + "Không" + "</td>";
        }
        rs += "<td>" + date + "</td>";
        rs += "<td>" + (numbergc || '-') + "</td>";
        rs += "<td>" + "<a class='ajax' style = 'color:blue;' href='<?php echo admin_url('usergame/detailgc') ?>" + "/" + nickname + "'>" + "Chi tiết" + "</a>";
        rs += "</tr>";
        return rs;
    }

    $(document).ready(function () {
        initiate();
    });

    function ipSearch(data) {
        $('#iplogin').val(data);
        initiate();
    }

    function deviceSearch(data) {
        $('#devicelogin').val(data);
        initiate();
    }

    function initiate() {
        var oldPage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/userloginajax')?>",
            data: {
                nickname: $("#filter_iname").val(),
                iplogin: $("#iplogin").val(),
                devicelogin: $("#devicelogin").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                status: $("#status").val(),
                pages: 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.transactions == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    $("#numuser").html(result.totalRecord);
                    var totalPage = result.total;
                    stt = 1;
                    $.each(result.transactions, function (index, value) {
                        result += resultSearchTransction(stt, value.user_name, value.nick_name, value.ip, value.agent, value.type, value.security, value.time_log);
                        stt++
                    });
                    $('#logaction').html(result);
                    $(".ajax").colorbox({iframe: true, innerWidth: 1000, innerHeight: 300});
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();

                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('usergame/userloginajax')?>",
                                    // url: "http://192.168.0.251:8082/api_backend",
                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        iplogin: $("#iplogin").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        status: $("#status").val(),
                                        pages: page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page - 1) * 50 + 1;
                                        $.each(result.transactions, function (index, value) {
                                            result += resultSearchTransction(stt, value.user_name, value.nick_name, value.ip, value.agent, value.type, value.security, value.time_log);
                                            stt++

                                        });
                                        $('#logaction').html(result);
                                        $(".ajax").colorbox({iframe: true, innerWidth: 1000, innerHeight: 300});
                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
                                    }, timeout: 20000
                                });
                            }
                            oldPage = page;
                        }
                    });
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        });
    }
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

</script>