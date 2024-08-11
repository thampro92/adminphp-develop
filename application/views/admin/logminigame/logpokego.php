<?php $this->load->view('admin/logminigame/head', $this->data) ?>
<div class="line"></div>
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
    <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
    <div class="widget">
        

        
        
        
        <div class="title">
            <h6>Lịch sử Candy</h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('logminigame/logCandy') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $this->input->post('toDate')?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft"> Đến ngày: </label>
                        </td>
                        <td class="item">

                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $this->input->post('fromDate')?>"> <span class="input-group-addon">
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
                        <td><label  style="margin-left: 70px;margin-bottom:-2px;width: 80px;">Phiên:</label></td>
                        <td ><input type="text" style="margin-left: 0px;margin-bottom:-2px;width: 150px"  id="phienbc" value="<?php echo $this->input->post('phienbc') ?>" name="phienbc"></td>

                        <td><label  id = "labelvin" style="margin-left: 75px;margin-bottom:-2px;width: 80px;">Nickname:</label></td>

                        <td ><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"  id="name" value="<?php echo $this->input->post('name') ?>" name="name"></td>

                    </tr>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>
            <td><label  id = "labelvin" style="margin-left: 65px;margin-bottom:-2px;width: 75px;">Phòng Win:</label></td>

            <td><select id="menhgiavin" name="menhgiavin"
                        style="margin-left: 10px;margin-bottom:-2px;width: 150px;">
                    <option value="" <?php if($this->input->post('menhgiavin')== "" ){echo "selected";} ?> >Chọn</option>
                    <option value="100" <?php if($this->input->post('menhgiavin')== "100" ){echo "selected";} ?>>100 Win</option>
                    <option value="1000" <?php if($this->input->post('menhgiavin')== "1000" ){echo "selected";} ?>>1K Win</option>
                    <option value="10000" <?php if($this->input->post('menhgiavin')== "10000" ){echo "selected";} ?>>10K Win</option>
                </select></td>
                        <td><label  id = "labelvin" style="margin-left: 80px;margin-bottom:-2px;width: 75px;">Phòng xu:</label></td>

                        <td><select id="menhgiaxu" name="menhgiaxu"
                                    style="margin-left: 10px;margin-bottom:-2px;width: 150px;">
                                <option value="" <?php if($this->input->post('menhgiaxu')== "" ){echo "selected";} ?> >Chọn</option>
                                <option value="1000" <?php if($this->input->post('menhgiaxu')== "1000" ){echo "selected";} ?>>1K Xu</option>
                                <option value="10000" <?php if($this->input->post('menhgiaxu')== "10000" ){echo "selected";} ?>>10K Xu</option>
                                <option value="100000" <?php if($this->input->post('menhgiaxu')== "100000" ){echo "selected";} ?>>100K Xu</option>
                            </select></td>

                    </tr>
                    </table>
                </div>
            <div class="formRow">
                <table>
                    <tr>
                        <td><label  id = "labelvin" style="margin-left: 70px;margin-bottom:-2px;width: 70px;">Tiền:</label></td>

                        <td><select id="money_type" name="money_type"
                                    style="margin-left: 10px;margin-bottom:-2px;width: 150px;">
                                <option value="1" <?php if($this->input->post('money_type')== "1" ){echo "selected";} ?>>Vin</option>
                                <option value="0" <?php if($this->input->post('money_type')== "0" ){echo "selected";} ?>>Xu</option>
                            </select></td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 40px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('logminigame/logCandy') ?>'; "
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
                <td>Phiên</td>
                <td>Nickname</td>
                <td>Phòng</td>
                <td>Dòng đặt</td>
                <td>Dòng thắng</td>
                <td>Tiền thưởng</td>
                <td>Tổng thưởng</td>
                <td>Kết quả</td>
                <td>Tiền</td>
                <td>Thời gian</td>
            </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>

    </div>
</div>
<?php endif; ?>
<style>
    td{
        word-break: break-all;
    }
    thead{
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
            format: 'HH:mm:ss DD-MM-YYYY'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'HH:mm:ss DD-MM-YYYY'
        });

    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    })
    function resultlogCandy(stt,referid,nickname,room,linebet,linewin,prizeline,prize,result,money,time_log) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + referid + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + room + "</td>";
        rs += "<td class='col-sm-2'>" + linebet + "</td>";
        rs += "<td class='col-sm-2'>" + linewin + "</td>";
        rs += "<td class='col-sm-2'>" + prizeline + "</td>";
        rs += "<td>" + commaSeparateNumber(prize) + "</td>";
        rs += "<td>" + resultCandy(result) + "</td>";
        if(money == 1){
            rs += "<td>" + "Win" + "</td>";
        }else{
            rs += "<td>" + "Xu" + "</td>";
        }
        rs += "<td>" + time_log + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function () {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();

        if ($("#money_type").val() == 1){

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('logminigame/logCandyajax')?>",
                data: {
                    phienbc: $("#phienbc").val(),
                    nickname: $("#name").val(),
                    money : $("#money_type").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    roomvin: $("#menhgiavin").val(),
                    pages : 1
                },

                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("Không tìm thấy kết quả");
                    } else {
                        var totalPage = result.total;
                        var countrow = result.totalRecord;
                        $("#num").html(countrow);
                        stt = 1;
                        $.each(result.transactions, function (index, value) {
                            result += resultlogCandy(stt, value.reference_id, value.user_name, value.bet_value, value.lines_betting, value.lines_win, value.prizes_on_line, value.prize, value.result, value.money_type, value.time_log);
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
                                        url: "<?php echo admin_url('logminigame/logCandyajax')?>",
                                        data: {
                                            phienbc: $("#phienbc").val(),
                                            nickname: $("#name").val(),
                                            money : $("#money_type").val(),
                                            toDate: $("#toDate").val(),
                                            fromDate: $("#fromDate").val(),
                                            roomvin: $("#menhgiavin").val(),
                                            pages : page
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $("#spinner").hide();
                                            stt = 1;
                                            $.each(result.transactions, function (index, value) {
                                                result += resultlogCandy(stt, value.reference_id, value.user_name, value.bet_value, value.lines_betting, value.lines_win, value.prizes_on_line, value.prize, value.result, value.money_type, value.time_log);
                                                stt++;
                                            });
                                            $('#logaction').html(result);
                                        }
                                    });
                                }
                                oldpage = page;
                            }
                        });

                    }
                }
            })

    }else{
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('logminigame/logCandyajax')?>",
                data: {
                    phienbc: $("#phienbc").val(),
                    nickname: $("#name").val(),
                    money : $("#money_type").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    roomxu: $("#menhgiaxu").val(),
                    pages : 1
                },

                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("Không tìm thấy kết quả");
                    } else {
                        var totalPage = result.total;
                        var countrow = result.totalRecord;
                        $("#num").html(countrow);
                        stt = 1;
                        $.each(result.transactions, function (index, value) {
                            result += resultlogCandy(stt, value.reference_id, value.user_name, value.bet_value, value.lines_betting, value.lines_win, value.prizes_on_line, value.prize, value.result, value.money_type, value.time_log);
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
                                        url: "<?php echo admin_url('logminigame/logCandyajax')?>",
                                        data: {
                                            phienbc: $("#phienbc").val(),
                                            nickname: $("#name").val(),
                                            money : $("#money_type").val(),
                                            toDate: $("#toDate").val(),
                                            fromDate: $("#fromDate").val(),
                                            roomxu: $("#menhgiaxu").val(),
                                            pages : page
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $("#spinner").hide();
                                            stt = 1;
                                            $.each(result.transactions, function (index, value) {
                                                result += resultlogCandy(stt, value.reference_id, value.user_name, value.bet_value, value.lines_betting, value.lines_win, value.prizes_on_line, value.prize, value.result, value.money_type, value.time_log);
                                                stt++;
                                            });
                                            $('#logaction').html(result);
                                        }
                                    });
                                }
                                oldpage = page;
                            }
                        });

                    }
                }
            })
        }
    });
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function resultCandy(count) {
        var strresult;
        switch (count) {
            case 0:
                strresult = "Trượt";
                break;
            case 1:
                strresult = "Thắng";
                break;
            case 2:
                strresult = "Thắng lớn";
                break;
            case 3:
                strresult = "Nổ hũ";
                break;
            case 4:
                strresult = "Nổ hũ x2";
                break;
            case 100:
                strresult = "Lỗi hệ thống";
                break;
            case 101:
                strresult = "Đặt cược không hợp lệ";
                break;
            case 102:
                strresult = "Không đủ tiền";
                break;
        }
        return strresult;
    }
</script>
