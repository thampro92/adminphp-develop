<?php $this->load->view('admin/withdraw/head', $this->data) ?>
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
                <h6>Danh sách Withdraw</h6>
                <h6 style="float: right">Tổng thành công:<span style="color:#0000ff" id="total_money"></span></h6>
                <h6 style="float: right">Tổng tiền thành công:<span style="color:#0000ff" id="total_success"></span></h6>
            </div>            <form class="list_filter form" action="<?php echo admin_url('report/withdraw') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="fromTime" class="formLeft"
                                       style="margin-left: 70px;margin-bottom:-2px;width: 100px">Tạo từ:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromTime" name="fromTime"
                                           value="<?php echo $this->input->post('fromTime') ?>"> <span
                                            class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>

                            <td>
                                <label for="endTime" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                       class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="endTime" name="endTime"
                                           value="<?php echo $this->input->post('endTime') ?>"> <span
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
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">NickName:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="nickName" value="<?php echo $this->input->post('nickName') ?>"
                                       name="nickName">
                            </td>
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nhà cung cấp:</label>
                            </td>
                            <?php $this->load->view('admin/component/selection/provider') ?>
                        </tr>
                    </table>
                </div>

                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Order Id:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="orderId" value="<?php echo $this->input->post('orderId') ?>" name="orderId">
                            </td>
                            <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Transaction Id:</label>
                            </td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="transactionId" value="<?php echo $this->input->post('transactionId') ?>"
                                       name="transactionId">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" style="width: 120px;margin-bottom:-3px;margin-left: 23px;"
                                       class="formLeft"> Trạng thái: </label>
                            </td>
                            <td class="item"><select id="status" name="status"
                                                     style="margin-left: 27px;margin-bottom:-2px;width: 142px">
                                    <option value="">Chọn</option>
                                    <option value="0" <?php if ($this->input->post('status') == "0") {
                                        echo "selected";
                                    } ?>>pending (Đang chờ xử lý)
                                    </option>
                                    <option value="1" <?php if ($this->input->post('status') == 1) {
                                        echo "selected";
                                    } ?>>received (Đã nhận và đang xử lý)
                                    </option>
                                    <option value="2" <?php if ($this->input->post('status') == 2) {
                                        echo "selected";
                                    } ?>>success (Đã xử lý thành công)
                                    </option>
                                    <option value="3" <?php if ($this->input->post('status') == 3) {
                                        echo "selected";
                                    } ?>>failed (Đã xử lý thất bại)
                                    </option>
                                    <option value="4" <?php if ($this->input->post('status') == 4) {
                                        echo "selected";
                                    } ?>>completed (Giao dịch hoàn thất)
                                    </option>
                                    <option value="5" <?php if ($this->input->post('status') == 5) {
                                        echo "selected";
                                    } ?>>review (Đang xem xét)
                                    </option>
                                    <option value="11" <?php if ($this->input->post('status') == 11) {
                                        echo "selected";
                                    } ?>>spam (Yêu cầu bị gửi quá nhiều lần)
                                    </option>
                                    <option value="12" <?php if ($this->input->post('status') == 12) {
                                        echo "selected";
                                    } ?>>request (Yêu cầu rút tiền)
                                    </option>
                                </select>
                            </td>

                            <td><label for="bankName" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Ngân hàng:</label></td>
                            <td>
                                <?php $this->load->view('/admin/component/selection/bankname'); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">

                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Số tài khoản:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="bankAccountNumber" value="<?php echo $this->input->post('bankAccountNumber') ?>" name="bankAccountNumber">
                            </td>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Chủ khoản:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="bankAccountName" value="<?php echo $this->input->post('bankAccountName') ?>" name="bankAccountName">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Số tiền từ:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="fromAmount" value="<?php echo $this->input->post('fromAmount') ?>" name="fromAmount">
                            </td>
                            <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Đến:</label></td>
                            <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                       id="toAmount" value="<?php echo $this->input->post('toAmount') ?>" name="toAmount">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>

                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/withdraw') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                            <td>
                                <span style="margin-left: 20px">
                                    <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name'=>'withdraw']); ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr style="height: 20px;">
                                <th width="40px">STT</th>
                                <th>Nickname</th>
                                <th>Số tiền</th>
                                <th>Nhà CC</th>
                                <th>Order Id</th>
                                <th>Transaction Id</th>
                                <th>Bank Code</th>
                                <th>Số tài khoản</th>
                                <th>Tên chủ khoản</th>
                                <th>Lý do từ chối</th>
                                <th>Ngày tạo</th>
                                <th>Cập nhật cuối</th>
                                <th>Trạng thái</th>
                                <th>Người phê duyệt</th>
                                <th style="width:100px;">Hành động</th>
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
<?php endif; ?>
<style>
    </style>
<div class="container">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10
    var list_data = []
    var logo_item = {
        "paywell": "/public/admin/images/logo/paywell.png",
        "clickpay": "/public/admin/images/logo/clickpay",
        "oneclick": "/public/admin/images/logo/oneclick.png",
        "princepay": "/public/admin/images/logo/princepay.png",
        "manualbank": ""
    }

    var status_dict = {
        "0":
            {"text": "Đang chờ xử lý", "label": "pending", "color": "text-info"},
        "1":
            {"text": "Đã nhận và đang xử lý", "label": "received", "color": "text-info"},
        "2":
            {"text": "Đã xử lý thành công", "label": "success", "color": "text-info"},
        "3":
            {"text": "Đã xử lý thất bại", "label": "failed", "color": ""},
        "4":
            {"text": "Giao dịch hoàn thất", "label": "completed", "color": ""},
        "5":
            {"text": "Đang xem xét", "label": "review", "color": "text-info"},
        "11":
            {"text": "Yêu cầu bị gửi quá nhiều lần", "label": "spam", "color": "text-info"},
        "12":
            {"text": "Yêu cầu rút tiền", "label": "request", "color": "text-primary"},
    }
    $(document).ready(function(){
        initData()
    })

    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0)
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59)

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // defaultDate: startDate,
            useCurrent : false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // defaultDate: endDate,
            useCurrent : false,
        });
        // $('#datetimepicker1').data("DateTimePicker").maxDate(endDate);
        // $('#datetimepicker2').data("DateTimePicker").minDate(startDate);
        //
        // $("#datetimepicker1").on("dp.change", function (e) {
        //     $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        //
        // });
        // $("#datetimepicker2").on("dp.change", function (e) {
        //     $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        // });
    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#fromTime").val();
        var toDatetime = $("#endTime").val();
        if (fromDatetime > toDatetime) {
            bootbox.alert({
                message: '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> Ngày kết thúc phải lớn hơn ngày bắt đầu',
                backdrop: true,
                centerVertical: true
            })
            return false;
        }
    });

    function resultSearchTransction(stt, value) {
        let logo_url = logo_item[value.ProviderName] ? logo_item[value.ProviderName] : ""

        var rs = "";
        rs += "<tr>";
        rs += "<td class='stt'>" + stt + "</td>";
        rs += "<td class=''>" + value.Nickname + "</td>";
        rs += "<td class=''>" + $.number(value.Amount, undefined, '.', ',') + "</td>";
        rs += "<td class='icon_image'>" + (logo_url ? "<img src='" + logo_url + "' alt=''> " : ' ') + value.ProviderName + "</td>";

        rs += "<td class=''>" + value.Id + "</td>";
        rs += "<td class=''>" + value.ReferenceId + "</td>";
        rs += "<td class=''>" + value.BankCode + "</td>";
        rs += "<td class=''>" + value.BankAccountNumber + "</td>";
        rs += "<td class=''>" + value.BankAccountName + "</td>";
        rs += "<td class=''>" + (value.Description|| '') + "</td>";
        rs += "<td class=''>" + value.CreatedAt.replace(" ", "</br>") + "</td>";
        rs += "<td class=''>" + value.ModifiedAt.replace(" ", "</br>") + "</td>";
        rs += "<td class=' "+status_dict[value.Status].color +"' title='" + status_dict[value.Status].text + "'>" + status_dict[value.Status].label + "</td>";
        rs += "<td>" + value.UserApprove + "</td>";
        rs += "<td class='option'>" +
            '<div ' + crPoppover(value) + ' class="tipS view-action text-info btn-circle"> <i class="fa fa-eye " aria-hidden="true"></i> </div>' +
            "</td>";
        return rs;
    }

    function crPoppover(value) {
        return ' data-toggle="popover" data-title="Thông tin chi tiết" data-html=true data-trigger="hover" data-placement="left" ' +
            'data-content="' +
                Object.entries(value).map( ([x,y]) => `${x} : ${y}`).join("</br>")
            + '" '
    }

    function messageBody(value) {
        return '<table class="table"><tr><th>Trường dữ liệu<th/><th>Thuộc tính<th/></tr>' +
            '<tr><td>Nickname<td/><td>' + value.Nickname + '<td/></tr>' +
            '<tr><td>Số tiền<td/><td>' + $.number(value.Amount, undefined, '.', ',') + '<td/></tr>' +
            '<tr><td>Nhà CC<td/><td>' + value.ProviderName + '<td/></tr>' +
            '<tr><td>Order Id<td/><td>' + value.Id + '<td/></tr>' +
            '<tr><td>Transaction Id<td/><td>' + value.ReferenceId + '<td/></tr>' +
            '<tr><td>Ngân hàng<td/><td>' + value.BankCode + '<td/></tr>' +
            '<tr><td>Số tài khoản<td/><td>' + value.BankAccountNumber + '<td/></tr>' +
            '<tr><td>Tên chủ khoản<td/><td>' + value.BankAccountName + '<td/></tr>' +
            '<tr><td>Ngày tạo<td/><td>' + value.CreatedAt + '<td/></tr>' +
            '<tr><td>Trạng thái<td/><td>' + status_dict[value.Status].text + '<td/></tr>' +
            '</table>'
    }

    function handleActionListener() {
        $('.tipS.view-action').click( function (e){
            e.preventDefault()
        })
    }

    function initData() {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('withdraw/indexajax')?>",
            data: {
                nickName: $("#nickName").val(),
                nhaCungCap: $("#nhaCungCap").val(),
                orderId: $("#orderId").val(),
                transactionId: $("#transactionId").val(),
                bankName: $("#bankName").val(),
                bankAccountName: $("#bankAccountName").val(),
                bankAccountNumber: $("#bankAccountNumber").val(),
                fromTime: $("#fromTime").val(),
                endTime: $("#endTime").val(),
                status: $("#status").val(),
                fromAmount: $("#fromAmount").val(),
                toAmount: $("#toAmount").val(),
                pages: 1,
                size: page_size
            },

            dataType: 'json',
            success: function (response) {
                let result = response.data
                let total = response.totalRecords
                $("#total_success").html(result.statistic[0] + "/" + response.totalRecords);
                $("#total_money").html($.number(result.statistic[1], undefined, ',', '.') + "/" + $.number(result.statistic[2], undefined, ',', '.'));

                $("#spinner").hide();

                if (total == 0 || !result.data || result.data.length == 0 ) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    list_data = result.data
                    $("#resultsearch").html("");
                    var totalPage = Math.floor(total / page_size) + (total % page_size ? 1 : 0);
                    stt = 1;

                    $.each(list_data, function (index, value) {
                        result += resultSearchTransction(stt, value);
                        stt++;
                    });
                    $('#logaction').html(result);
                    handleActionListener();
                    $('[data-toggle="popover"]').popover()
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('withdraw/indexajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        nhaCungCap: $("#nhaCungCap").val(),
                                        orderId: $("#orderId").val(),
                                        transactionId: $("#transactionId").val(),
                                        bankName: $("#bankName").val(),
                                        bankAccountName: $("#bankAccountName").val(),
                                        bankAccountNumber: $("#bankAccountNumber").val(),
                                        fromTime: $("#fromTime").val(),
                                        endTime: $("#endTime").val(),
                                        status: $("#status").val(),
                                        fromAmount: $("#fromAmount").val(),
                                        toAmount: $("#toAmount").val(),
                                        pages: page,
                                        size: page_size

                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        result = response.data
                                        list_data = result.data

                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page - 1) * page_size + 1;
                                        let str = ''
                                        $.each(list_data, function (index, value) {
                                            str += resultSearchTransction(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(str);
                                        handleActionListener();
                                        $('[data-toggle="popover"]').popover()
                                    }, error: function (e) {
                                        list_data = []
                                        console.error(e)
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

            }, error: function (e) {
                list_data = []
                console.error(e)
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        })

    };
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>