<?php $this->load->view('admin/deposit/head', $this->data) ?>
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
                <h6>Danh sách Deposit</h6>
                <table style="float: right">
                    <tr>
                        <td>Tổng số thành công:</td>
                        <td style="color:#0000ff" id="total_success"></td>
                    </tr>
                    <tr>
                        <td>Tổng tiền thành công:</td>
                        <td style="color:#0000ff" id="total_money">
                    </tr>
                    <tr>
                        <td>Tổng số người nạp:</td>
                        <td style="color:#0000ff" id="total_user_charge">
                    </tr>
                </table>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('deposit/userbot') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="fromTime" class="formLeft">Tạo từ:</label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromTime" name="fromTime"
                                           value="<?php echo $this->input->post('fromTime') ?>">
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                </div>
                            </td>

                            <td>
                                <label for="endTime" class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="endTime" name="endTime"
                                           value="<?php echo $this->input->post('endTime') ?>">
                                            <span class="input-group-addon">
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
                            <td><label class="formLeft">NickName:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="nickName" value="<?php echo $this->input->post('nickName') ?>"
                                       name="nickName">
                            </td>
                            <td><label class="formLeft">Nhà cung cấp:</label>
                            </td>
                            <?php $this->load->view('admin/component/selection/provider') ?>
                        </tr>
                    </table>
                </div>

                <div class="formRow">

                    <table>
                        <tr>
                            <td><label class="formLeft">Order Id:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="orderId" value="<?php echo $this->input->post('orderId') ?>" name="orderId">
                            </td>
                            <td><label class="formLeft">Transaction Id:</label>
                            </td>
                            <td><input type="text" class="my-input-class"
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
                                <label for="param_name" class="formLeft"> Trạng thái: </label>
                            </td>
                            <td class="item">
                                <select id="status" name="status" class="my-input-class">
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
                            <td><label for="bankName" class="formLeft">Ngân hàng:</label></td>
                            <td>
                                <?php $this->load->view('/admin/component/selection/bankname'); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">

                    <table>
                        <tr>
                            <td><label class="formLeft">Số tài khoản:</label>
                            </td>
                            <td><input type="text" class="my-input-class"
                                       id="bankAccountNumber"
                                       value="<?php echo $this->input->post('bankAccountNumber') ?>"
                                       name="bankAccountNumber">
                            </td>
                            <td><label class="formLeft">Chủ khoản:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="bankAccountName" value="<?php echo $this->input->post('bankAccountName') ?>"
                                       name="bankAccountName">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="formLeft">Số tiền từ:</label>
                            </td>
                            <td><input type="text" class="my-input-class"
                                       id="fromAmount" value="<?php echo $this->input->post('fromAmount') ?>"
                                       name="fromAmount">
                            </td>
                            <td><label class="formLeft">Đến:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="toAmount" value="<?php echo $this->input->post('toAmount') ?>"
                                       name="toAmount">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="formLeft">Seri thẻ:</label>
                            </td>
                            <td><input type="text" class="my-input-class"
                                       id="sericard" value="<?php echo $this->input->post('sericard') ?>"
                                       name="sericard">
                            </td>
                            <td><label class="formLeft">Mã thẻ:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="pincard" value="<?php echo $this->input->post('pincard') ?>"
                                       name="pincard">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td >
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('deposit/userbot') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                            <td>
                                <span style="margin-left: 20px">
                                    <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name'=>'deposit']); ?>
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
                                <th>Ngày tạo</th>
                                <th>Cập nhật cuối</th>
                                <th>Mô tả</th>
                                <th>Hình thức nạp</th>
                                <th>Trạng thái</th>
                                <th>Người phê duyệt</th>
                                <th style="width:100px;">Hành động</th>
                                <th style="width:100px;">Lịch sử</th>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn duyệt : <span id="nn-modal"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input hidden value="" id="nn" name="nn">
                    <input hidden value="" id="odi" name="odi">
                    <div class="col-sm-3">
                        Trang thái
                    </div>
                    <div class="col-sm-9">
                        <select name="status-modal" id="status-modal" onclick="statusCheck(this.value)" >
                            <option value="4">Thành công</option>
                            <option value="3">Thất bại</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-2" id="gr-reason" style="display:none">
                    <div class="col-sm-3">
                        Lý do
                    </div>
                    <div class="col-sm-9">
                        <textarea id="reason-modal" name="reason-modal" rows="4"></textarea>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="confirm">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10;
    var logo_item = {
        "paywell": "/public/admin/images/logo/paywell.png",
        "clickpay": "/public/admin/images/logo/clickpay",
        "oneclick": "/public/admin/images/logo/oneclick.png",
        "princepay": "/public/admin/images/logo/princepay.png",
        "manualbank": ""
    }

    var status_dict = {
        "0":
            {"text": "Đang chờ xử lý", "label": "pending", "color": "status-pending"},
        "1":
            {"text": "Đã nhận và đang xử lý", "label": "received", "color": "text-info"},
        "2":
            {"text": "Đã xử lý thành công", "label": "success", "color": "text-info"},
        "3":
            {"text": "Đã xử lý thất bại", "label": "failed", "color": "status-fail"},
        "4":
            {"text": "Giao dịch hoàn thất", "label": "completed", "color": "status-complete"},
        "5":
            {"text": "Đang xem xét", "label": "review", "color": "text-info"},
        "11":
            {"text": "Yêu cầu bị gửi quá nhiều lần", "label": "spam", "color": "text-info"},
        "12":
            {"text": "Yêu cầu rút tiền", "label": "request", "color": "status-request"},
    }
    $(document).ready(function(){

        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0)
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59)

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
        initData()
    })
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
        rs += "<td>" + value.Nickname + "</td>";
        rs += "<td>" + $.number(value.Amount, undefined, '.', ',') + "</td>";
        rs += "<td class='icon_image'>" + (logo_url ? "<img src='" + logo_url + "' alt=''> " : ' ') + value.ProviderName + "</td>";

        rs += "<td>" + value.Id + "</td>";
        rs += "<td>" + value.ReferenceId + "</td>";
        rs += "<td class=''>" + value.BankCode + "</td>";
        rs += "<td>" + value.CreatedAt.replace(" ", "</br>") + "</td>";
        rs += "<td class=''>" + value.ModifiedAt.replace(" ", "</br>") + "</td>";
        rs += "<td class=''>" + (value.Description|| '') + "</td>";
        rs += "<td class=''>" + (value.PaymentType|| '') + "</td>";
        rs += "<td title='" + status_dict[value.Status].text + "' class='" + status_dict[value.Status].color + "'>" + status_dict[value.Status].label + "</td>";
        rs += "<td>" + value.UserApprove + "</td>";
        rs += "<td class='option'>";
        rs += '<div ' + crPoppover(value) + ' class="tipS edit-action text-info"> <i class="fa fa-eye " aria-hidden="true"></i> </div>';
        if (value.Status == 0) {
            rs += `<div onclick="approve('${value.Nickname}', ${value.Id}, ${value.Status})"  class="tipS edit-action text-info" style="cursor: pointer" data-toggle="modal" data-target="#exampleModal">Phê duyệt</div>`;
        }
        rs += "<td class='option'>" +
            `<div class="pop-option mt-3"  "><a href= "<?php echo admin_url('report/userwintrans/')?>` + "/" + value.Nickname  + `"   target="_blank">Lịch sử GD</a></div>` +
            `<div class="pop-option mt-3"  "><a href="<?php echo admin_url('report/naprut')?>` + "/" + value.Nickname  + `"  target="_blank">Nạp/Rút</a></div>` +
            "</td>";
        rs += "</td>";
        return rs;
    }

    function crPoppover(value) {
        return ' data-toggle="popover" data-title="Thông tin chi tiết" data-html=true data-trigger="hover" data-placement="left" ' +
            'data-content="' +
            Object.entries(value).map( ([x,y]) => `${x} : ${y}`).join("</br>")
            + '" '
    }

    function initData() {
        var oldPage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('deposit/indexajax')?>",
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
                sericard: $("#sericard").val(),
                pincard: $("#pincard").val(),
                pages: 1,
                size: page_size
            },

            dataType: 'json',
            success: function (response) {
                let total = response.totalRecords;
                $("#total_success").html(response.statistic[0] + "/" + response.totalRecords);
                $("#total_money").html($.number(response.statistic[1], undefined, ',', '.') + "/" + $.number(response.statistic[2], undefined, ',', '.'));
                $("#total_user_charge").html(response.statistic[3]);

                $("#spinner").hide();

                if (total == 0 || response.data.length == 0) {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    var totalPage = Math.floor(total / page_size) + (total % page_size ? 1 : 0);
                    stt = 1;
                    let str = '';
                    $.each(response.data, function (index, value) {
                        str += resultSearchTransction(stt, value);
                        stt++;
                    });
                    $('#logaction').html(str);
                    $('[data-toggle="popover"]').popover()
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('deposit/indexajax')?>",
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
                                        sericard: $("#sericard").val(),
                                        pincard: $("#pincard").val(),
                                        pages: page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                            $("#resultsearch").html("");
                                            $("#spinner").hide();
                                            stt = (page - 1) * page_size + 1;
                                            let str = '';
                                            $.each(response.data, function (index, value) {
                                                str += resultSearchTransction(stt, value);
                                                stt++;
                                            });
                                            $('#logaction').html(str);
                                            $('[data-toggle="popover"]').popover()
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
        })

    };

    function statusCheck(el) {
        if (el == 3) {
            $('#gr-reason').css('display', 'block')
        } else if(el == 4) {
            $('#gr-reason').css('display', 'none')
        }
    }


    $( "#confirm" ).click(function() {
        $('#exampleModal').modal('hide');
        console.log($('#odi').val());
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('deposit/userBotApproveAjax')?>",
            data: {
                "oid":  $('#odi').val(),
                "nn":  $('#nn').val(),
                "st":  $('#status-modal').val(),
                "rs":  $('#reason-modal').val(),
            },
            dataType: 'json',
            success: function (response) {
                $("#spinner").hide();
                console.log(response);
                if (response.success) {
                    alert('Thành công');
                    location.reload();
                } else {
                    alert('Thất bại');
                }
            }, error: function (e) {
                console.error(e.message)
                $("#spinner").hide();
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        })
    });

    function approve(nn, id, st)
    {
        $('#nn-modal').html(nn);
        $('#odi').val(id);
        $('#nn').val(nn);
        return;
    }
</script>