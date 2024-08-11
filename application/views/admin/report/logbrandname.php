<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">

        </div>
        <div class="clear"></div>
    </div>
</div>
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
        
        

        
        
        
        <script
            src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>

            <div class="title">
                <h6>Lịch sử Brandname</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/logbrandname') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?php echo $start_time ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>                            </td>

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                       class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?php echo $end_time ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>                        </tr>
                    </table>
                </div>
                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Số điện thoại:</label>
                            </td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="txtmobile" value="<?php echo $this->input->post('txtmobile') ?>"
                                       name="txtmobile"></td>
                            <td><label style="margin-left: 70px;margin-bottom:-2px;width: 100px">Trạng thái:</label>
                            </td>
                            <td><select id="select_status" name="select_status"
                                        style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                    <option value="">Chọn</option>
                                    <option value="1" <?php if ($this->input->post('select_status') == "1") {
                                        echo "selected";
                                    } ?>>Thành công
                                    </option>
                                    <option value="2" <?php if ($this->input->post('select_status') == "2") {
                                        echo "selected";
                                    } ?>>Thất bại
                                    </option>
                                </select>
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Mã giao dịch:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="magiaodich" value="<?php echo $this->input->post('magiaodich') ?>" name="magiaodich"></td>
                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 50px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/logbrandname') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow"><h5>Tổng số tin nhắn gửi đi:<span style="color: #0000ff" id="summessend"></span></h5>
                <h5>Tổng só tin nhắn thành công:<span style="color: #0000ff" id="summessuc"></span></h5></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr style="height: 20px;">
                    <td>STT</td>
                    <td>Request Id</td>
                    <td>Tin nhắn</td>
                    <td>Điện thoại</td>
                    <td>Trạng thái</td>
                    <td>Số lượng tin nhắn</td>
                    <td>Mô tả</td>
                    <td>Thời gian</td>
                    <td>Thời gian cập nhật</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<style>
    td {
        word-break: break-all;
    }

    thead {
        font-size: 12px;
    }

    .spinner {
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
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>

</div>
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
    });
    function resultSearchTransction(stt, rid, message, mobile, status, count, description, time, updatetime) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + rid + "</td>";
        rs += "<td class='col-sm-3'>" + message + "</td>";
        rs += "<td>" + mobile + "</td>";
        rs += "<td>" + status + "</td>";
        rs += "<td>" + count + "</td>";
        rs += "<td>" + description + "</td>";
        rs += "<td>" + time + "</td>"
        rs += "<td>" + updatetime + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function () {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/logbrandnameajax')?>",
            data: {
                mobile: $("#txtmobile").val(),
                status: $("#select_status").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                pages: 1,
                tranid : $("#magiaodich").val()
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.records == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    var totalPage = result.totalPages;
                    var totalReceiveSuccess = (result.numSend);
                    var totalSendSuccess = (result.numSuccess);
                    $('#summessend').html(totalReceiveSuccess);
                    $('#summessuc').html(totalSendSuccess);
                    stt = 1;
                    $.each(result.records, function (index, value) {
                        result += resultSearchTransction(stt, value.requestId, value.message, value.receives, value.status, value.count, value.statusDesc, value.transTime, value.updateTime);
                        stt++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldpage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/logbrandnameajax')?>",
                                    data: {
                                        mobile: $("#txtmobile").val(),
                                        status: $("#select_status").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        pages: page,
                                        tranid : $("#magiaodich").val()

                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.records, function (index, value) {
                                            result += resultSearchTransction(stt, value.requestId, value.message, value.receives, value.status, value.count, value.statusDesc, value.transTime, value.updateTime);
                                            stt++;
                                        });
                                        $('#logaction').html(result);
                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
                                    }, timeout: 20000
                                });
                            }
                            oldpage = page;
                        }
                    });
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        })

    });
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>