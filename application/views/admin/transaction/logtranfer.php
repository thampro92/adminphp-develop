<!--<div class="titleArea">-->
<!--    <div class="wrapper">-->
<!--        <div class="pageTitle">-->
<!--        </div>-->
<!--        <div class="clear"></div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="line"></div>-->
<?php //if($role == false): ?>
<!--    <div class="wrapper">-->
<!--        <div class="widget">-->
<!--            <div class="title">-->
<!--                <h6>Bạn không được phân quyền</h6>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<?php //else: ?>
<!--<div class="wrapper">-->
<!--    --><?php //$this->load->view('admin/message', $this->data); ?>
<!---->
<!--    -->
<!--    <link rel="stylesheet"-->
<!--          href="--><?php //echo public_url() ?><!--/site/bootstrap/bootstrap-datetimepicker.css">-->

<!---->
<!--    <script src="--><?php //echo public_url() ?><!--/site/bootstrap/moment.js"></script>-->

<!--    <script-->
<!--        src="--><?php //echo public_url() ?><!--/site/bootstrap/bootstrap-datetimepicker.min.js"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo public_url()?><!--/js/jquery.table2excel.js"></script>-->
<!--    <div class="widget">-->
<!--        <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>-->
<!--        <div class="title">-->
<!--            <h6>Lịch sử chuyển khoản</h6>-->
<!--        </div>-->
<!--        <form class="list_filter form" action="--><?php //echo admin_url('transaction/logtranfer') ?><!--" method="post">-->
<!--            <div class="formRow">-->
<!--                <table>-->
<!--                    <tr>-->
<!--                        <td>-->
<!--                            <label for="param_name" class="formLeft" id="nameuser"-->
<!--                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>-->
<!--                        <td class="item">-->
<!--                            <div class="input-group date" id="datetimepicker1">-->
<!--                                <input type="text" id="toDate" name="toDate" value="--><?php //echo $start_time; ?><!--"> <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--</span>-->
<!--                            </div>-->
<!---->
<!---->
<!--                        </td>-->
<!---->
<!--                        <td>-->
<!--                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"-->
<!--                                   class="formLeft"> Đến ngày: </label>-->
<!--                        </td>-->
<!--                        <td class="item">-->
<!---->
<!--                            <div class="input-group date" id="datetimepicker2">-->
<!--                                <input type="text" id="fromDate" name="fromDate"  value="--><?php //echo $end_time; ?><!--"> <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--</span>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                </table>-->
<!--            </div>-->
<!--            <div class="formRow">-->
<!---->
<!--                <table>-->
<!--                    <tr>-->
<!---->
<!--                        <td><label style="margin-left: 48px;margin-bottom:-2px;width: 100px">Nick name:</label></td>-->
<!--                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                                   id="filter_iname" value="--><?php //echo $this->input->post('name') ?><!--" name="name"></td>-->
<!--                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Giao dịch:</label></td>-->
<!--                        <td><select id="typegd" name="typegd"-->
<!--                                    style="margin-left: 20px;margin-bottom:-2px;width: 145px;">-->
<!--                                <option value="1" --><?php //if($this->input->post("typegd") == "1"){echo "selected";}  ?><!-->Chuyển vin</option>-->
<!--                                <option value="2" --><?php //if($this->input->post("typegd") == "2"){echo "selected";}  ?><!-->Nhận vin</option>-->
<!--                            </select></td>-->
<!---->
<!--                        <td style="">-->
<!--                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"-->
<!--                                   style="margin-left: 123px">-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <input type="reset"-->
<!--                                   onclick="window.location.href = '--><?php //echo admin_url('transaction/logtranfer') ?>//'; "
//                                   value="Reset" class="basic" style="margin-left: 20px">
//                        </td>
//                        <td>
//                            <input type="button" id="exportexel" value="Xuất Exel" class="button blueB" style="margin-left: 20px">
//                        </td>
//
//                    </tr>
//
//                </table>
//
//            </div>
//
//            <div class="formRow">
//            </div>
//        </form>
//        <div class="formRow"></div>
//        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
//            <thead>
//            <tr style="height: 20px;">
//                <td>STT</td>
//                <td>Username</td>
//                <td>Nickname</td>
//                <td>Dịch vụ</td>
//                <td>Hành động</td>
//                <td class="col-sm-3">Mô tả</td>
//                <td style="width:100px;">Số dư</td>
//                <td>Tiền thay đổi</td>
//                <td>Phế</td>
//                <td>Ngày tạo</td>
//            </tr>
//            </thead>
//            <tbody id="logaction">
//            </tbody>
//        </table>
//    </div>
//</div>
<?php //endif; ?>
<!--<style>-->
<!--    td{-->
<!--        word-break: break-all;-->
<!--    }-->
<!--    thead{-->
<!--        font-size: 12px;-->
<!--    }-->
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
<!--<div class="container">-->
<!--    <div id="spinner" class="spinner" style="display:none;">-->
<!--        <img id="img-spinner" src="--><?php //echo public_url('admin/images/gif-load.gif') ?><!--" alt="Loading"/>-->
<!--    </div>-->
<!--    <div class="text-center">-->
<!--        <ul id="pagination-demo" class="pagination-lg"></ul>-->
<!--    </div>-->
<!---->
<!--</div>-->
<!--<script>-->
<!--    $(function () {-->
<!--        $('#datetimepicker1').datetimepicker({-->
<!--            format: 'YYYY-MM-DD HH:mm:ss'-->
<!--        });-->
<!--        $('#datetimepicker2').datetimepicker({-->
<!--            format: 'YYYY-MM-DD HH:mm:ss'-->
<!--        });-->
<!--    });-->
<!--    $("#search_tran").click(function () {-->
<!--        var fromDatetime = $("#toDate").val();-->
<!--        var toDatetime = $("#fromDate").val();-->
<!--        if (fromDatetime > toDatetime) {-->
<!--            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')-->
<!--            return false;-->
<!--        }-->
<!---->
<!--    });-->
<!---->
<!--    $("#exportexel").click(function () {-->
<!--        $("#checkAll").table2excel({-->
<!--            exclude: ".noExl",-->
<!--            name: "Excel Document Name",-->
<!--            filename: "listtranfer",-->
<!--            fileext: ".xls",-->
<!--            exclude_img: true,-->
<!--            exclude_links: true,-->
<!--            exclude_inputs: true-->
<!--        });-->
<!--    });-->
<!--    function resultSearchTransction(stt,username, nickname, servicename, action, description,currentmoney, moneyexchange,fee,time) {-->
<!--        var rs = "";-->
<!--        rs += "<tr>";-->
<!--        rs += "<td>" + stt + "</td>";-->
<!--        rs += "<td>" + username + "</td>";-->
<!--        rs += "<td>" + nickname + "</td>";-->
<!--        rs += "<td>" + servicename + "</td>";-->
<!--        rs += "<td>" + action + "</td>";-->
<!--        rs += "<td>" + description + "</td>";-->
<!--        rs += "<td>" + commaSeparateNumber(currentmoney) + "</td>";-->
<!--        rs += "<td>" + commaSeparateNumber(moneyexchange) + "</td>";-->
<!--        rs += "<td>" + commaSeparateNumber(fee) + "</td>";-->
<!--        rs += "<td>" + time + "</td>";-->
<!--        rs += "</tr>";-->
<!--        return rs;-->
<!--    }-->
<!--    $(document).ready(function () {-->
<!--        var oldPage = 0;-->
<!--        var result = "";-->
<!--        $('#pagination-demo').css("display", "block");-->
<!--        $("#spinner").show();-->
<!--        $.ajax({-->
<!--            type: "POST",-->
<!--            url: "--><?php //echo admin_url('transaction/logtranferajax')?>//",
//            data: {
//                nickname: $("#filter_iname").val(),
//                toDate: $("#toDate").val(),
//                fromDate: $("#fromDate").val(),
//                pages: 1,
//                type: $("#typegd").val()
//            },
//
//            dataType: 'json',
//            success: function (result) {
//                $("#spinner").hide();
//                if (result.transactions == "") {
//                    $('#pagination-demo').css("display", "none");
//                    $("#resultsearch").html("Không tìm thấy kết quả");
//                }else {
//                    $("#resultsearch").html("");
//                    var totalPage = result.totalPages;
//                    stt = 1;
//                    $.each(result.transactions, function (index, value) {
//                        result += resultSearchTransction(stt, value.userName, value.nickName, value.actionName, value.serviceName,value.description, value.currentMoney, value.moneyExchange, value.fee,value.transactionTime);
//                        stt++;
//
//                    });
//                    $('#logaction').html(result);
//                    $('#pagination-demo').twbsPagination({
//                        totalPages: totalPage,
//                        visiblePages: 5,
//                        onPageClick: function (event, page) {
//                            if (oldPage > 0) {
//                                $("#spinner").show();
//                                $.ajax({
//                                    type: "POST",
//                                    url: "<?php //echo admin_url('transaction/logtranferajax')?>//",
//                                    data: {
//                                        nickname: $("#filter_iname").val(),
//                                        toDate: $("#toDate").val(),
//                                        fromDate: $("#fromDate").val(),
//                                        pages: page,
//                                        type: $("#typegd").val()
//                                    },
//                                    dataType: 'json',
//                                    success: function (result) {
//                                        $("#resultsearch").html("");
//                                        $("#spinner").hide();
//                                        stt = 1;
//                                        $.each(result.transactions, function (index, value) {
//                                            result += resultSearchTransction(stt, value.userName, value.nickName, value.actionName, value.serviceName,value.description, value.currentMoney, value.moneyExchange, value.fee,value.transactionTime);
//                                            stt++;
//
//                                        });
//                                        $('#logaction').html(result);
//                                    }, error: function () {
//                                        $("#spinner").hide();
//                                        $('#logaction').html("");
//                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
//                                    },timeout : 20000
//                                });
//                            }
//                             oldPage = page;
//                        }
//                    });
//                }
//            }, error: function () {
//                $("#spinner").hide();
//                $('#logaction').html("");
//                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
//            },timeout : 20000
//        })
//
//    });
//</script>
//<script>
//    function commaSeparateNumber(val) {
//        while (/(\d+)(\d{3})/.test(val.toString())) {
//            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
//        }
//        return val;
//    }
//</script>
