<?php $this->load->view('admin/logminigame/head', $this->data) ?>
<div class="line"></div>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/css/loggamethirdparty.css">
<?php if($role == false): ?>
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
            <h4 id="resultsearch"></h4>
            <div class="title">
                <h6>Lịch sử tài khoản chơi tài xỉu</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('logminigame') ?>" method="post">
                <div class="formRow">

                    <table>
                        <tr>


                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                       class="formLeft"> Từ ngày: </label>
                            </td>
                            <td class="item"><input name="fromDate"
                                                    value="<?php echo $this->input->post('fromDate') ?>"
                                                    id="fromDate" type="text" class="datepicker-input"/></td>

                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 60px;margin-bottom:-2px;width: 120px">Đến ngày:</label></td>
                            <td class="item"><input name="toDate"
                                                    value="<?php echo $this->input->post('toDate') ?>"
                                                    id="toDate" type="text" class="datepicker"/></td>


                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 60px;margin-bottom:-2px;width: 100px">Phiên:</label></td>
                            <td>
                                <input type="text" class="session-2"
                                       id="phientx" value="<?= empty($this->input->get('phientx')) ? $this->input->post('phientx') : $this->input->get('phientx')?>"
                                       name="phientx">
                            </td>

                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 20px">
                            </td>

                        </tr>
                    </table>

                </div>
            </form>
            <div class="formRow"></div>
            <div class="formRow">
                <h4> <input id="money_type" name="money_type" type="text" value="1" style="color: #0000ff" disabled hidden ></input></h4>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered" id="checkAll">
                <thead>
                <tr class="list-logminigame">
                    <td>Phiên</td>
                    <td>Tiền đặt xỉu</td>
                    <td>Tổng đặt xỉu</td>
                    <td>Hoàn trả cửa xỉu</td>
                    <td>Tiền đặt tài</td>
                    <td>Tổng đặt tài</td>
                    <td>Hoàn trả cửa tài</td>
                    <td>Jackpot</td>
                    <td>Kết quả</td>
                    <td>Kết quả giải</td>
                    <td>Loại tiền</td>
                    <td>Ngày tạo</td>
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
    <div id="spinner" class="spinner image-logminigame">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script>


    $(document).ready(function () {
        $("#fromDate").val('<?= date('Y-m-d')?>');
        $("#toDate").val('<?= date("Y-m-d")?>');
        init();
    });

    $(function () {
        $('#toDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#fromDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });

    $("#search_tran").click(function () {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        init();
    });


    function resultSearchtaixiu(referenceId,totalxiu, totaltai, numxiu, numtai, dice1, dice2, dice3,result,totalrefundtai,totalrefundxiu,money,datetime,total_jackpot) {
        var rs = "";
        rs += "<tr>";
        rs += "<td><a style='color: #0000FF' href='logminigame/detailphientaixiu/"+referenceId+ "/history?fromDate="+ datetime +"'>"+referenceId+"</a></td>";
        rs += "<td>" + commaSeparateNumber(numxiu) + "</td>";
        rs += "<td>" + commaSeparateNumber(totalxiu) + "</td>";
        rs += "<td>" + commaSeparateNumber(totalrefundxiu) + "</td>";
        rs += "<td>" + commaSeparateNumber(numtai) + "</td>";
        rs += "<td>" + commaSeparateNumber(totaltai) + "</td>";
        rs += "<td>" + commaSeparateNumber(totalrefundtai) + "</td>";
        rs += "<td>" + (total_jackpot) + "</td>";
        rs += "<td>" + dice1 + "," +dice2+"," + dice3 + "</td>";
        if(result == 1){
            rs += "<td>" + "Tài" + "</td>";
        }else  if(result == 0){
            rs += "<td>" + "Xỉu" + "</td>";
        }
        if(money == 1){
            rs += "<td>" + "Win" + "</td>";
        }else  if(money == 0){
            rs += "<td>" + "Xu" + "</td>";
        }
        rs += "<td>" + datetime + "</td>";
        rs += "</tr>";
        return rs;
    }
     function init() {
        var result = "";
        var oldPage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('logminigame/indexajax')?>",
            data: {
                phientx: $("#phientx").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                money: $("#money_type").val(),
                pages : 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.transactions == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                }else {
                    $("#totalData").html($.number(result.totalRecord, undefined, '.', ','));
                    $("#resultsearch").html("");
                    var totalPage = result.total;
                    $.each(result.transactions, function (index, value) {
                        result += resultSearchtaixiu(value.reference_id, value.total_xiu, value.total_tai, value.num_bet_xiu, value.num_bet_tai, value.dice1, value.dice2, value.dice3, value.result,value.total_refund_tai,value.total_refund_xiu,value.money_type,value.timestamp,value.total_jackpot);
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('logminigame/indexajax')?>",
                                    data: {
                                        phientx: $("#phientx").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        money: $("#money_type").val(),
                                        pages : page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        $.each(result.transactions, function (index, value) {
                                            result += resultSearchtaixiu(value.reference_id, value.total_xiu, value.total_tai, value.num_bet_xiu, value.num_bet_tai, value.dice1, value.dice2, value.dice3, value.result,value.total_refund_tai,value.total_refund_xiu,value.money_type,value.timestamp,value.total_jackpot);
                                        });
                                        $('#logaction').html(result);

                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
                                    },timeout : 10000
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
            },timeout : 10000
        })

    }
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    function query() {
        let query = '?';
        if ($('#toDate').val() != '') {
            query += 'toDate=' + $('#toDate').val()+ '&';
        }
        if ($('#fromDate').val() != '') {
            query += 'fromDate=' + $('#fromDate').val() + '&';
        }
        if ($('#phientx').val() != '') {
            query += 'phientx=' + $('#phientx').val() + '&';
        }
        return query;
    }
</script>

