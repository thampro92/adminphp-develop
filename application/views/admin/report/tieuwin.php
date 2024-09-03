<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Rút tiền Win</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<link rel="stylesheet"
      href="<?php echo public_url() ?>/site/css/loggamethirdparty.css"><?php if ($role == false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php $this->load->view('admin/error') ?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>
        <div class="widget">
            <h4 id="resultsearch"></h4>
            <div class="title">
                <h6>Tiêu Win</h6>
                <h6 class="total">Tổng rút:<span class="total-number" style="color:#0000ff" id="totalRut"></span></h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/tieuwin') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr class="nickname">
                            <td><label>Nick name:</label></td>
                            <td><input type="text"
                                       id="nickName" value="<?php echo $this->input->post('nickName') ?>"
                                       name="nickName"></td>
                            <td><label class="session-1">Số phiên chơi game:</label></td>
                            <td><input type="text" class="session-2"
                                       id="transId" value="<?php echo $this->input->post('transId') ?>" name="transId">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser" style="min-width: auto">Từ
                                    ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?php echo $this->input->post('fromDate') ?>"> <span
                                            class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                            <td>
                                <label for="param_name" class="formLeft formtoDate"
                                       style="min-width: auto;text-align: left"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?php echo $this->input->post('toDate') ?>"> <span
                                            class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="session-1">User id:</label></td>
                            <td><input type="text" class="session-2"
                                       id="userId" value="<?php echo $this->input->post('userId') ?>" name="userId">
                            </td>
                            <td><label class="money-type-1">Số tiền</label></td>
                            <td><input type="text" class="money-type-2"
                                       id="currentMoney" value="<?php echo $this->input->post('currentMoney') ?>"
                                       name="currentMoney"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label class="session-1">Phế&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>=</label>
                            </td>
                            <td><input type="text" class="session-2"
                                       id="fee_win" value="<?php echo $this->input->post('fee_win') ?>" name="fee_win">
                            </td>
<!--                            <td><label class="money-type-1">Money exchange&nbsp;&nbsp;>=</label></td>-->
<!--                            <td><input type="text" class="money-type-2"-->
<!--                                       id="moneyExchange" value="--><?php //echo $this->input->post('moneyExchange') ?><!--"-->
<!--                                       name="moneyExchange"></td>-->
                        </tr>
                    </table>
                </div>
                <!-- <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="money-type-1" style="margin-left: 7px">Action name:</label></td>
                            <td><select class="money-type-2" style="margin-left: 1px; width: 213px!important;"
                                        id="actionName" name="actionName">
                                    <option value="" <?php if ($this->input->post('actionName') == "") {
                                        echo "selected";
                                    } ?>>Chọn
                                    </option>
                                    <option value="Admin" <?php if ($this->input->post('actionName') == "Admin") {
                                        echo "selected";
                                    } ?>>Admin thực hiện
                                    </option>
                                    <option value="REQUEST_CASHOUT" <?php if ($this->input->post('actionName') == "REQUEST_CASHOUT") {
                                        echo "selected";
                                    } ?>>Yêu cầu rút
                                    </option>
                                    <option value="CashOutByPrincePay" <?php if ($this->input->post('actionName') == "CashOutByPaywell") {
                                        echo "selected";
                                    } ?>>Rút tiền từ Paywell
                                    </option>
                                    <option value="CashOutByClickPay" <?php if ($this->input->post('actionName') == "CashOutByClickPay") {
                                        echo "selected";
                                    } ?>>Rút tiền từ 1ClickPay
                                    </option>
                                    <option value="CashOutByPrincePay" <?php if ($this->input->post('actionName') == "CashOutByPrincePay") {
                                        echo "selected";
                                    } ?>>Rút tiền từ PrincePay
                                    </option>
                                </select></td>
                        </tr>
                    </table>
                </div> -->
                <div class="formRow">
                    <table>
                        <tr>
                            <td style="display: flex;padding-left: 98px;">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB search">
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/tieuwin') ?>'; "
                                       value="Reset" class="basic">
                                <span style="margin-left: 20px">
                                <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name' => 'napwin', 'columns_excel' => "0,1,2,3,4,5,6"]); ?>
                            </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr class="list-loggameslot">
                    <td>STT</td>
                    <td>Phiên giao dịch</td>
                    <td>Nick name</td>
                    <td>Current money</td>
                    <td>Money exchange</td>
                    <td>Thời điểm giao dịch</td>
                    <td>Action name</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<div class="container">
    <h6 class="total-data">Tổng bản ghi:<span class="total-data-span" id="totalData"></span></h6>
    <div id="spinner" class="spinner image-loggameslot">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10;
    $("#search_tran").click(function () {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }

    });

    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0);
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59);
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent: false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: endDate,
            useCurrent: false,
        });

    });

    $(document).ready(function () {
        initData()
    });

    function initData() {

        var fromdate;
        var todate;
        var oldpage = 0;
        if ($("#toDate").val() != "") {
            var match = $("#toDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            todate = moment.unix(date.getTime() / 1000).format("YYYY-MM-DD HH:mm:ss")
        } else {
            todate = "";
        }
        if ($("#fromDate").val() != "") {
            var match = $("#fromDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            fromdate = moment.unix(date.getTime() / 1000).format("YYYY-MM-DD HH:mm:ss")
        } else {
            fromdate = "";
        }
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/tieuwinajax')?>",
            data: {
                nickName: $("#nickName").val(),
                actionName: $("#actionName").val(),
                serviceName: $("#serviceName").val(),
                toDate: todate,
                fromDate: fromdate,
                transId: $("#transId").val(),
                userId: $("#userId ").val(),
                currentMoney: $("#currentMoney").val(),
                moneyExchange: $("#moneyExchange").val(),
                fee: $("#fee_win").val(),
                page: 1,
                maxItem: page_size
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.data.listData == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {

                    console.log(result);

                    let totalPage = Math.floor(result.totalRecords / 10) + (result.totalRecords % 10 ? 1 : 0);
                    $("#totalData").html($.number(result.totalRecords, undefined, '.', ','));
                    $("#totalRut").html($.number(result.data.totalRut, undefined, '.', ','));
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.data.listData, function (index, value) {
                        result += resultSearchTransction(stt, value);
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
                                    url: "<?php echo admin_url('report/tieuwinajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        actionName: $("#actionName").val(),
                                        serviceName: $("#serviceName").val(),
                                        toDate: todate,
                                        fromDate: fromdate,
                                        transId: $("#transId").val(),
                                        userId: $("#userId ").val(),
                                        currentMoney: $("#currentMoney").val(),
                                        moneyExchange: $("#moneyExchange").val(),
                                        fee: $("#fee_win").val(),
                                        page: page,
                                        maxItem: page_size
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = (page - 1) * 10 + 1;
                                        $.each(result.data.listData, function (index, value) {
                                            result += resultSearchTransction(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(result);
                                    }, error: function () {
                                        $('#logaction').html("");
                                        $("#spinner").hide();
                                        $("#error-popup").modal("show");
                                    }, timeout: 40000
                                });
                            }
                            oldpage = page;
                        }
                    });
                }
            }, error: function () {
                $('#logaction').html("");
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    }

    function resultSearchTransction(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.ReferenceId + "</td>";
        rs += "<td>" + value.Nickname + "</td>";
        rs += "<td>" + $.number(value.Amount, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.money_exchange, undefined, '.', ',') + "</td>";
        rs += "<td>" + value.CreatedAt + "</td>";
        switch (value.action_name) {
            case 'Admin':
                rs += "<td>" + 'Admin thực hiện' + "</td>";
                break;
            case 'REQUEST_CASHOUT':
                rs += "<td>" + 'Yêu cầu rút' + "</td>";
                break;
            case 'CashOutByPaywell':
                rs += "<td>" + 'Rút tiền bằng Paywell' + "</td>";
                break;
            case 'CashOutByClickPay':
                rs += "<td>" + 'Rút tiền bằng 1ClickPay' + "</td>";
                break;
            case 'CashOutByPrincePay':
                rs += "<td>" + 'Rút tiền bằng PrincePay' + "</td>";
                break;
            default:
                rs += "<td>" + value.action_name + "</td>";
        }
        rs += "</tr>";
        return rs;
    }
</script>