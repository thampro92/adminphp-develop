<!--<div class="titleArea">-->
<!--    <div class="wrapper">-->
<!--        <div class="pageTitle">-->
<!---->
<!--        </div>-->
<!--        <div class="clear"></div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="line"></div>-->
<?php //if ($role == false): ?>
<!--    <div class="wrapper">-->
<!--        <div class="widget">-->
<!--            <div class="title">-->
<!--                <h6>Bạn không được phân quyền</h6>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<?php //else: ?>
<!--    <div class="wrapper">-->
<!--    --><?php //$this->load->view('admin/message', $this->data); ?>
<!--    -->
<!--    <link rel="stylesheet"-->
<!--          href="--><?php //echo public_url() ?><!--/site/bootstrap/bootstrap-datetimepicker.css">-->

<!--    -->
<!--    <script src="--><?php //echo public_url() ?><!--/site/bootstrap/moment.js"></script>-->

<!--    <script-->
<!--        src="--><?php //echo public_url() ?><!--/site/bootstrap/bootstrap-datetimepicker.min.js"></script>-->
<!--    <div class="widget">-->
<!--    <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>-->
<!---->
<!--    <div class="title">-->
<!--        <h6>Lịch sử nạp Win qua ngân lượng</h6>-->
<!--    </div>-->
<!--    <form class="list_filter form" action="--><?php //echo admin_url('report/rechargebynganluong') ?><!--" method="post">-->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <label for="param_name" class="formLeft" id="nameuser"-->
<!--                           style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>-->
<!--                <td class="item">-->
<!--                    <div class="input-group date" id="datetimepicker1">-->
<!--                        <input type="text" id="toDate" name="toDate"-->
<!--                               value="--><?php //echo $start_time ?><!--"> <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--</span>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </td>-->
<!---->
<!--                <td>-->
<!--                    <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"-->
<!--                           class="formLeft"> Đến ngày: </label>-->
<!--                </td>-->
<!--                <td class="item">-->
<!---->
<!--                    <div class="input-group date" id="datetimepicker2">-->
<!--                        <input type="text" id="fromDate" name="fromDate"-->
<!--                               value="--><?php //echo $end_time ?><!--"> <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--</span>-->
<!--                    </div>-->
<!--                </td>-->
<!---->
<!---->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!--    <div class="formRow">-->
<!---->
<!--        <table>-->
<!--            <tr>-->
<!--                <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>-->
<!--                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                           id="filter_iname" value="--><?php //echo $this->input->post('name') ?><!--" name="name">-->
<!--                </td>-->
<!--                <td><label style="margin-left: 70px;margin-bottom:-2px;width: 100px">Trạng thái:</label>-->
<!--                </td>-->
<!--                <td><select id="select_status" name="select_status"-->
<!--                            style="margin-left: 0px;margin-bottom:-2px;width: 143px">-->
<!--                        <option value="00" --><?php //if ($this->input->post('select_status') == "00") {
//                            echo "selected";
//                        } ?><!-- selected="selected">Thành công-->
<!--                        </option>-->
<!--                        <option value="" --><?php //if ($this->input->post('select_status') == "") {
//                            echo "selected";
//                        } ?><!-->Tát cả-->
<!--                        </option>-->
<!---->
<!--                    </select>-->
<!--                </td>-->
<!---->
<!--            </tr>-->
<!---->
<!--        </table>-->
<!---->
<!--    </div>-->
<!---->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Ip:</label></td>-->
<!--                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                           id="txtip" value="--><?php //echo $this->input->post('txtip') ?><!--" name="txtip"></td>-->
<!--                <td><label style="margin-left: 70px;margin-bottom:-2px;width: 100px">Ngân hàng:</label></td>-->
<!--                <td><select id="select_bank" name="select_bank"-->
<!--                            style="margin-left: 0px;margin-bottom:-2px;width: 143px">-->
<!--                        <option value="">Chọn</option>-->
<!--                        <option value="BIDV" --><?php //if ($this->input->post('select_bank') == "BIDV") {
//                            echo "selected";
//                        } ?><!-->BIDV-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="VietinBank" --><?php //if ($this->input->post('select_bank') == "VietinBank") {
//                            echo "selected";
//                        } ?><!-->VietinBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="VietcomBank" --><?php //if ($this->input->post('select_bank') == "VietcomBank") {
//                            echo "selected";
//                        } ?><!-->VietcomBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="MaritimeBank" --><?php //if ($this->input->post('select_bank') == "MaritimeBank") {
//                            echo "selected";
//                        } ?><!-->MaritimeBank-->
<!--                        </option>-->
<!--                        <option value="VPBank" --><?php //if ($this->input->post('select_bank') == "VPBank") {
//                            echo "selected";
//                        } ?><!-->VPBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="VietABank" --><?php //if ($this->input->post('select_bank') == "VietABank") {
//                            echo "selected";
//                        } ?><!-->VietABank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="TechcomBank" --><?php //if ($this->input->post('select_bank') == "TechcomBank") {
//                            echo "selected";
//                        } ?><!-->TechcomBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="EximBank" --><?php //if ($this->input->post('select_bank') == "EximBank") {
//                            echo "selected";
//                        } ?><!-->EximBank-->
<!--                        </option>-->
<!--                        <option value="VIBBank" --><?php //if ($this->input->post('select_bank') == "VIBBank") {
//                            echo "selected";
//                        } ?><!-->VIBBank-->
<!--                        </option>-->
<!--                        <option value="TPBank" --><?php //if ($this->input->post('select_bank') == "TPBank") {
//                            echo "selected";
//                        } ?><!-->TPBank-->
<!--                        </option>-->
<!--                        <option value="SHB" --><?php //if ($this->input->post('select_bank') == "SHB") {
//                            echo "selected";
//                        } ?><!-->SHB-->
<!--                        </option>-->
<!--                        <option value="SeaBank" --><?php //if ($this->input->post('select_bank') == "SeaBank") {
//                            echo "selected";
//                        } ?><!-->SeaBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="SacomBank" --><?php //if ($this->input->post('select_bank') == "SacomBank") {
//                            echo "selected";
//                        } ?><!-->SacomBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="OceanBank" --><?php //if ($this->input->post('select_bank') == "OceanBank") {
//                            echo "selected";
//                        } ?><!-->OceanBank-->
<!--                        </option>-->
<!--                        <option value="MBBank" --><?php //if ($this->input->post('select_bank') == "MBBank") {
//                            echo "selected";
//                        } ?><!-->MBBank-->
<!--                        </option>-->
<!--                        <option value="GPBank" --><?php //if ($this->input->post('select_bank') == "GPBank") {
//                            echo "selected";
//                        } ?><!-->GPBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="BacABank" --><?php //if ($this->input->post('select_bank') == "BacABank") {
//                            echo "selected";
//                        } ?><!-->BacABank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="AgriBank" --><?php //if ($this->input->post('select_bank') == "AgriBank") {
//                            echo "selected";
//                        } ?><!-->AgriBank-->
<!--                        </option>-->
<!--                        <option value="ABBank" --><?php //if ($this->input->post('select_bank') == "ABBank") {
//                            echo "selected";
//                        } ?><!-->ABBank-->
<!--                        </option>-->
<!--                        <option value="ACB" --><?php //if ($this->input->post('select_bank') == "ACB") {
//                            echo "ACB";
//                        } ?><!-->ACB-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="OricomBank" --><?php //if ($this->input->post('select_bank') == "OricomBank") {
//                            echo "selected";
//                        } ?><!-->OricomBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="LienVietPostBank" --><?php //if ($this->input->post('select_bank') == "LienVietPostBank") {
//                            echo "selected";
//                        } ?><!-->LienVietPostBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="DongABank" --><?php //if ($this->input->post('select_bank') == "DongABank") {
//                            echo "selected";
//                        } ?><!-->DongABank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="BaoVietBank" --><?php //if ($this->input->post('select_bank') == "BaoVietBank") {
//                            echo "selected";
//                        } ?><!-->BaoVietBank-->
<!--                        </option>-->
<!--                        <option value="HDBank" --><?php //if ($this->input->post('select_bank') == "HDBank") {
//                            echo "selected";
//                        } ?><!-->HDBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="KienLongBank" --><?php //if ($this->input->post('select_bank') == "KienLongBank") {
//                            echo "selected";
//                        } ?><!-->KienLongBank-->
<!--                        </option>-->
<!--                        <option-->
<!--                            value="NamABank" --><?php //if ($this->input->post('select_bank') == "NamABank") {
//                            echo "selected";
//                        } ?><!-->NamABank-->
<!--                        </option>-->
<!--                        <option value="NCB" --><?php //if ($this->input->post('select_bank') == "NCB") {
//                            echo "selected";
//                        } ?><!-->NCB-->
<!--                        </option>-->
<!--                        <option value="VRB" --><?php //if ($this->input->post('select_bank') == "VRB") {
//                            echo "selected";
//                        } ?><!-->VRB-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Mã giao dịch:</label>-->
<!--                </td>-->
<!--                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                           id="txtvinplay" value="--><?php //echo $this->input->post('txtvinplay') ?><!--"-->
<!--                           name="txtvinplay"></td>-->
<!--                <td style="">-->
<!--                    <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"-->
<!--                           style="margin-left: 50px">-->
<!--                </td>-->
<!--                <td>-->
<!--                    <input type="reset"-->
<!--                           onclick="window.location.href = '--><?php //echo admin_url('report/rechargebynganluong') ?>//'; "
//                           value="Reset" class="basic" style="margin-left: 20px">
//                </td>
//            </tr>
//        </table>
//    </div>
//    </form>
//    <div class="formRow">
//        <div class="row">
//            <div class="col-sm-2">
//                <h5>Tổng:<span style="color: #0000ff" id="summoney"></span></h5>
//            </div>
//            <div class="col-sm-8">
//            </div>
//            <div class="col-sm-2">
//                <h5>Tổng giao dịch:<span style="color: #0000ff" id="sumrecord"></span></h5>
//            </div>
//        </div>
//    </div>
//    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
//        <thead>
//        <tr style="height: 20px;">
//            <td>STT</td>
//            <td>Nickname</td>
//            <td>Tiền</td>
//            <td>Ngân hàng</td>
//            <td>IP</td>
//            <td>Mã giao dịch</td>
//            <td style="width: 10%">Token</td>
//            <td>Thời gian</td>
//            <td>Trạng thái</td>
//            <td>Mô tả</td>
//            <td>Thời gian cập nhật</td>
//        </tr>
//        </thead>
//        <tbody id="logaction">
//        </tbody>
//    </table>
//    </div>
//    </div>
//
<?php //endif; ?>
<!--<style>-->
<!--    td {-->
<!--        word-break: break-all;-->
<!--    }-->
<!---->
<!--    thead {-->
<!--        font-size: 12px;-->
<!--    }-->
<!---->
<!--    .spinner {-->
<!--        position: fixed;-->
<!--        top: 50%;-->
<!--        left: 50%;-->
<!--        margin-left: -50px; /* half width of the spinner gif */-->
<!--        margin-top: -50px; /* half height of the spinner gif */-->
<!--        text-align: center;-->
<!--        z-index: 1234;-->
<!--        overflow: auto;-->
<!--        width: 100px; /* width of the spinner gif */-->
<!--        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */-->
<!--    }</style>-->
<!--<div class="container" style="margin-right:20px;">-->
<!--    <div id="spinner" class="spinner" style="display:none;">-->
<!--        <img id="img-spinner" src="--><?php //echo public_url('admin/images/gif-load.gif') ?><!--" alt="Loading"/>-->
<!--    </div>-->
<!--    <div class="text-center">-->
<!--        <ul id="pagination-demo" class="pagination-sm"></ul>-->
<!--        <ul id="pagination-search" class="pagination-sm"></ul>-->
<!--    </div>-->
<!---->
<!--</div>-->
<!--<script>-->
<!--$(function () {-->
<!--    $('#datetimepicker1').datetimepicker({-->
<!--        format: 'YYYY-MM-DD HH:mm:ss'-->
<!--    });-->
<!--    $('#datetimepicker2').datetimepicker({-->
<!--        format: 'YYYY-MM-DD HH:mm:ss'-->
<!--    });-->
<!---->
<!--});-->
<!---->
<!---->
<!--$("#search_tran").click(function () {-->
<!--    var fromDatetime = $("#toDate").val();-->
<!--    var toDatetime = $("#fromDate").val();-->
<!--    if (fromDatetime > toDatetime) {-->
<!--        alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')-->
<!--        return false;-->
<!--    }-->
<!---->
<!--    var result = "";-->
<!--    var oldpage = 0;-->
<!---->
<!---->
<!--    $("#spinner").show();-->
<!--    $.ajax({-->
<!--        type: "POST",-->
<!--        url: "--><?php //echo admin_url('report/rechargebynganluongajax')?>//",
//
//        data: {
//            nickname: $("#filter_iname").val(),
//            txtvinplay: $("#txtvinplay").val(),
//            txtip: $("#txtip").val(),
//            bank: $("#select_bank").val(),
//            status: $("#select_status").val(),
//            toDate: $("#toDate").val(),
//            fromDate: $("#fromDate").val(),
//            pages: 1
//        },
//
//        dataType: 'json',
//        success: function (result) {
//            $("#spinner").hide();
//
//            if (result.records == "") {
//                $("#resultsearch").html("Không tìm thấy kết quả");
//                $('#pagination-demo').html("");
//                $('#logaction').html("");
//            } else {
//                $("#resultsearch").html("");
//                var totalPage = result.totalPages;
//                var totalmoney = commaSeparateNumber(result.totalMoney);
//                var totalrecord = commaSeparateNumber(result.totalSuccess);
//                $('#summoney').html(totalmoney);
//                $('#sumrecord').html(totalrecord);
//                stt = 1;
//                $.each(result.records, function (index, value) {
//                    result += resultSearchTransction(stt, value.orderCode, value.nickname, value.email, value.mobile, value.totalAmount, value.bank, value.ip, value.errorCodeReturn, value.descReturn, value.transTime, value.updateTime,value.token);
//                    stt++;
//                });
//                $('#logaction').html(result);
//
//                if ($('#pagination-demo').data("twbs-pagination")) {
//                    $('#pagination-demo').twbsPagination('destroy');
//                }
//                $('#pagination-demo').twbsPagination({
//                    totalPages: totalPage,
//                    visiblePages: 5,
//                    onPageClick: function (event, page) {
//                        if (oldpage > 0) {
//                            $("#spinner").show();
//                            $.ajax({
//                                type: "POST",
//                                url: "<?php //echo admin_url('report/rechargebynganluongajax')?>//",
//
//                                data: {
//                                    nickname: $("#filter_iname").val(),
//                                    txtvinplay: $("#txtvinplay").val(),
//                                    txtip: $("#txtip").val(),
//                                    bank: $("#select_bank").val(),
//                                    status: $("#select_status").val(),
//                                    toDate: $("#toDate").val(),
//                                    fromDate: $("#fromDate").val(),
//                                    pages: page
//
//                                },
//                                dataType: 'json',
//                                success: function (result) {
//                                    $("#resultsearch").html("");
//                                    $("#spinner").hide();
//                                    stt = 1;
//                                    $.each(result.records, function (index, value) {
//                                        result += resultSearchTransction(stt, value.orderCode, value.nickname, value.email, value.mobile, value.totalAmount, value.bank, value.ip, value.errorCodeReturn, value.descReturn, value.transTime, value.updateTime,value.token);
//                                        stt++;
//                                    });
//                                    $('#logaction').html(result);
//                                }, error: function () {
//                                    $("#spinner").hide();
//                                    $('#logaction').html("");
//                                    $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
//                                }, timeout: 20000
//                            });
//                        }
//                        oldpage = page;
//                    }
//                });
//            }
//
//        }, error: function () {
//            $("#spinner").hide();
//            $('#logaction').html("");
//            $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
//        }, timeout: 20000
//    })
//});
//function resultSearchTransction(stt, tid, nickname, email, mobile, money, bank, ip, status, description, time, updatetime,token) {
//    var rs = "";
//    rs += "<tr>";
//    rs += "<td>" + stt + "</td>";
//    rs += "<td>" + nickname + "</td>";
//    rs += "<td>" + commaSeparateNumber(money) + "</td>";
//    rs += "<td>" + bank + "</td>";
//    rs += "<td>" + ip + "</td>";
//    rs += "<td>" + tid + "</td>";
//    rs += "<td>" + token + "</td>";
//    rs += "<td>" + time + "</td>";
//    rs += "<td>" + status + "</td>";
//    rs += "<td>" + description + "</td>";
//    rs += "<td>" + updatetime + "</td>";
//    rs += "</tr>";
//    return rs;
//}
//
//$(document).ready(function () {
//    $('select option:contains("Thành công")').prop('selected', true);
//    $("#resultsearch").html("Vụi lòng ấn nút tìm kiếm");
//
//
//});
//</script>
//<script>
//    function commaSeparateNumber(val) {
//        while (/(\d+)(\d{3})/.test(val.toString())) {
//            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
//        }
//        return val;
//    }
//</script>