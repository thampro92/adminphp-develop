<?php $this->load->view('admin/logminigame/head', $this->data) ?>
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
        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>

            <link rel="stylesheet" href="<?php echo public_url() ?>/site/css/loggamethirdparty.css">
            <div class="title">
                <h6>Lịch sử bầu cua</h6>
                <h6 class="total">Tổng Số người chơi:<span class="total-number" id="totalPlayer"></span></h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('logminigame/logbaucua') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser" style="min-width: auto;text-align: left;">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?= empty($this->input->get('fromDate')) ? $this->input->post('fromDate') : $this->input->get('fromDate') ?>">
                                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                            <td>
                                <label for="param_name" class="formLeft formtoDate" style="min-width: auto;text-align: left;"> Đến ngày: </label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?= empty($this->input->get('toDate')) ? $this->input->post('toDate') : $this->input->get('toDate') ?>">
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
                            <td><label class="session-1">Phiên:</label></td>
                            <td><input type="text" class="session-2" id="phienbc"
                                       value="<?= empty($this->input->get('phienbc')) ? $this->input->post('phienbc') : $this->input->get('phienbc') ?>"
                                       name="phienbc"></td>

                            <td><label class="money-type-1">Nick name:</label></td>
                            <td><input type="text" id="nickname"
                                       class="money-type-2"
                                       value="<?= empty($this->input->get('nickname')) ? $this->input->post('nickname') : $this->input->get('nickname') ?>"
                                       name="nickname"></td>
                            <td hidden><label id="labelvin" class="money-type-1" style="margin-left: 19px">Phòng win:</label>
                            </td>

                            <td hidden><select id="menhgiavin" name="menhgiavin"
                                        class="money-type-2" style="margin-left: 1px;width: 212px;">
                                    <option value="" <?= ($this->input->post('menhgiavin') == "" || $this->input->get('menhgiavin') == "") ? "selected" : "" ?> >
                                        Chọn
                                    </option>
                                    <option value="1000" <?= ($this->input->post('menhgiavin') == "1000" || $this->input->get('menhgiavin') == "1000") ? "selected" : "" ?>>
                                        1K Win
                                    </option>
                                    <option value="10000" <?= ($this->input->post('menhgiavin') == "10000" || $this->input->get('menhgiavin') == "10000") ? "selected" : "" ?>>
                                        10K Win
                                    </option>
                                    <option value="100000" <?= ($this->input->post('menhgiavin') == "100000" || $this->input->get('menhgiavin') == "100000") ? "selected" : "" ?>>
                                        100K Win
                                    </option>
                                </select></td>
                            <td hidden><label class="money-type-1">Tiền:</label></td>
                            <td hidden>
                                <select id="money" name="money"
                                        class="money-type-2">
                                    <option value="1" <?php if ($this->input->post('money') == "1") {
                                        echo "selected";
                                    } ?>>Vin
                                    </option>
                                    <option value="0" <?php if ($this->input->post('money') == "0") {
                                        echo "selected";
                                    } ?>>Xu
                                    </option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td hidden><label id="labelxu" class="money-type-1">Phòng xu:</label></td>
                            <td hidden><select id="menhgiaxu" name="menhgiaxu"
                                               class="money-type-2">
                                    <option value="" <?php if ($this->input->post('menhgiaxu') == "") {
                                        echo "selected";
                                    } ?>>Chọn
                                    </option>
                                    <option value="10000" <?php if ($this->input->post('menhgiaxu') == "10000") {
                                        echo "selected";
                                    } ?>>10K Xu
                                    </option>
                                    <option value="100000" <?php if ($this->input->post('menhgiaxu') == "100000") {
                                        echo "selected";
                                    } ?>>100K Xu
                                    </option>
                                    <option value="1000000" <?php if ($this->input->post('menhgiaxu') == "1000000") {
                                        echo "selected";
                                    } ?>>1000K Xu
                                    </option>

                                </select></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB search">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('logminigame/logbaucua') ?>'; "
                                       value="Reset" class="basic">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow"></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr class="list-logminigame">
                    <td>Phiên</td>
                    <td>Nick name</td>
                    <td>Tiền đặt</td>
                    <td>Tiền thắng</td>
                    <td>Tiền</td>
                    <td>Game</td>
                    <td>Phí</td>
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
    <h6 class="total-data">Tổng bản ghi:<span class="total-data-span" id="totalRecord"></span></h6>
    <div id="spinner" class="spinner image-logminigame">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>

</div>
<script>
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
    $("#search_tran").click(function () {
        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    });

    function resultlogbaucua(referid, nickname, bet_value, win_value, money_type, game, fee, createAt ) {
        var rs = "";
        rs += "<tr>";
        rs += "<td><a style='color: #0000FF' href='detailbaucua/" + referid + query() + "'>" + referid + "</a>" + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + commaSeparateNumber(bet_value) + "</td>";
        rs += "<td>" + commaSeparateNumber(win_value) + "</td>";
        if (money_type == 0) {
            rs += "<td>" + "xu" + "</td>";
        } else if (money_type == 1) {
            rs += "<td>" + "Win" + "</td>";
        }
        rs += "<td>" + game + "</td>";
        rs += "<td>" + fee + "</td>";
        rs += "<td>" + createAt + "</td>";
        rs += "</tr>";
        return rs;
    }

    $(document).ready(function () {
        var result = "";
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        if ($("#money").val() == 1) {
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('logminigame/logbaucuaajax')?>",
                data: {
                    phienbc: $("#phienbc").val(),
                    nickname: $("#nickname").val(),
                    roomvin: $("#menhgiavin").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    money: $("#money").val(),
                    pages: 1
                },
                dataType: 'json',
                success: function (result) {
                    var totalPage = result.total;
                    var countrow = result.totalRecord;
                    $("#num").html(countrow);
                    $("#spinner").hide();
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("Không tìm thấy kết quả");
                    } else {
                        $("#totalRecord").html($.number(result.totalRecord, undefined, '.', ','));
                        $("#totalPlayer").html($.number(result.totalPlayer, undefined, '.', ','));
                        $("#resultsearch").html("");
                        $.each(result.transactions, function (index, value) {
                            result += resultlogbaucua(value.referent_id, value.nick_name, value.bet_value, value.win_value, value.money_type, value.game, value.fee, value.createAt);
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
                                        url: "<?php echo admin_url('logminigame/logbaucuaajax')?>",
                                        data: {
                                            phienbc: $("#phienbc").val(),
                                            nickname: $("#nickname").val(),
                                            roomvin: $("#menhgiavin").val(),
                                            toDate: $("#toDate").val(),
                                            fromDate: $("#fromDate").val(),
                                            money: $("#money").val(),
                                            pages: page
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $("#spinner").hide();
                                            $.each(result.transactions, function (index, value) {
                                                result += resultlogbaucua(value.referent_id, value.nick_name, value.bet_value, value.win_value, value.money_type, value.game, value.fee, value.createAt);
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
        } else if ($("#money").val() == 0) {
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('logminigame/logbaucuaajax')?>",
                data: {
                    phienbc: $("#phienbc").val(),
                    nickname: $("#nickname").val(),
                    roomxu: $("#menhgiaxu").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    money: $("#money").val(),
                    pages: 1
                },
                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    var totalPage = result.total;
                    var countrow = result.totalRecord;
                    $("#num").html(countrow);
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("Không tìm thấy kết quả");
                    } else {
                        $("#resultsearch").html("");
                        $.each(result.transactions, function (index, value) {
                            result += resultlogbaucua(value.referent_id, value.nick_name, value.bet_value, value.win_value, value.money_type, value.game, value.fee, value.createAt);
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
                                        url: "<?php echo admin_url('logminigame/logbaucuaajax')?>",
                                        data: {
                                            phienbc: $("#phienbc").val(),
                                            nickname: $("#nickname").val(),
                                            roomxu: $("#menhgiaxu").val(),
                                            toDate: $("#toDate").val(),
                                            fromDate: $("#fromDate").val(),
                                            money: $("#money").val(),
                                            pages: page
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $("#spinner").hide();
                                            $.each(result.transactions, function (index, value) {
                                                result += resultlogbaucua(value.referent_id, value.nick_name, value.bet_value, value.win_value, value.money_type, value.game, value.fee, value.createAt);
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

    function replacedice(str) {
        if (!str)
            return "";
        return str.replace(/0/g, "bầu").replace(/1/g, "cua").replace(/2/g, "tôm").replace(/3/g, "cá").replace(/4/g, "gà").replace(/5/g, "hưou");
    }

    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    function query() {
        let query = '?';
        if ($('#toDate').val() != '') {
            query += 'toDate=' + $('#toDate').val() + '&';
        }
        if ($('#fromDate').val() != '') {
            query += 'fromDate=' + $('#fromDate').val() + '&';
        }
        if ($('#phienbc').val() != '') {
            query += 'phienbc=' + $('#phienbc').val() + '&';
        }
        if ($('#menhgiavin').val() != '') {
            query += 'menhgiavin=' + $('#menhgiavin').val() + '&';
        }
        if ($('#nickname').val() != '') {
            query += 'nickname=' + $('#nickname').val() + '&';
        }
        return query;
    }
</script>
