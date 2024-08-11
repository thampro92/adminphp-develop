<?php $this->load->view('admin/logminigame/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper return-url">
    <a class="" href="<?= admin_url($uriBack) . '?' . $uri?>">
        <i class="fas fa-angle-double-left"></i> Quay lại
    </a>
</div>
<div class="wrapper">
    <div class="widget">
        <input type="hidden" id="phientx" value="<?php echo $phien; ?>">
        <input type="hidden" id="fromDate" value="<?php echo $fromDate; ?>">

        <div class="title">
            <h6>Chi tiết phiên tài xỉu</h6>
        </div>

        <div class="formRow">
            <form class="list_filter form" action="<?php echo admin_url('logminigame/detailphientaixiu/'.$phien . '/' . $uriParam) ?>" method="post">
                <table>
                    <tr>


                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft">Nickname: </label>
                        </td>
                        <td class="item"><input name="name"
                                                value="<?php echo $this->input->post('name') ?>"
                                                id="name" type="text" /></td>

                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Cửa Đặt:</label></td>
                        <td><select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="bet_side" name="bet_side" onchange="getInputSelect(this)">

                                <option value="-1" <?php if($this->input->post('bet_side') == "-1"){echo "selected";} ?>>Tất Cả Cửa</option>
                                <option value="1" <?php if($this->input->post('bet_side') == "1"){echo "selected";} ?>>Tài</option>
                                <option value="0" <?php if($this->input->post('bet_side') == "0"){echo "selected";} ?>>Xỉu</option>

                            </select></td>


                        <td style="">
                            <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                   style="margin-left: 20px">
                        </td>

                    </tr>
                </table>
            </form>
        </div>



            <div class="formRow">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="resulttai">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="height: 20px;">
                                    <td>Phiên</td>
                                    <td>Nick name</td>
                                    <td>Tiền đạt</td>
                                    <td>Cửa đặt</td>
                                    <td>Thưởng</td>
                                    <td>Hoàn trả</td>
                                    <td>Giây đặt</td>
                                    <td>Game</td>
                                    <td>Ngày tạo</td>
                                </tr>
                                </thead>
                                <tbody id="logaction">
                                </tbody>
                            </table>

                        <div class="text-center" style="float: right">
                            <ul id="pagination-demo" class="pagination-lg"></ul>
                        </div>
                        </div>
                        <div id="errortai" style="color: red;text-align: center"></div>

                    </div>
                </div>
            </div>
            <div class="formRow"></div>

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
    }</style><div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>

<h1 id="resultsearch" style="position: absolute;top: 50%;left: 50%"></h1>

<script>
function resulttaixiudetail(reference_id, user_name, bet_value, bet_side, prize, refund, input_time, game, time_log) {
    var rs = "";
    rs += "<tr>";
    rs += "<td>" + reference_id + "</td>";
    rs += "<td>" + user_name + "</td>";
    rs += "<td>" + commaSeparateNumber(bet_value) + "</td>";
    if (bet_side == 0) {
        rs += "<td>" + "Xỉu" + "</td>";
    }
    else if (bet_side == 1) {
        rs += "<td>" + "Tài" + "</td>";
    }
    rs += "<td>" + commaSeparateNumber(prize) + "</td>";
    rs += "<td>" + commaSeparateNumber(refund) + "</td>";
    rs += "<td>" + input_time + "</td>";
    rs += "<td>" + game + "</td>";
    rs += "<td>" + time_log + "</td>";
    rs += "</tr>";
    return rs;
}

$("#search_tran").click(function () {
    init();
});

$(document).ready(function () {
    init();
});

function init() {
    var result = "";
    var oldpage = 0;
    var oldpage1 = 0;
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('logminigame/detailphientaixiuajax')?>",
        data: {
            phientx: $("#phientx").val(),
            cuadat: $("#bet_side").val(),
            fromDate: $("#fromDate").val(),
            pages: 1,
            nickname : $("#name").val()
        },

        dataType: 'json',
        success: function (result) {
            if (result.transactions != "") {
                $('#resulttai').css("display", "block");
                $('#errortai').css("display", "none")
                $("#spinner").hide();
                var totalPage = result.total;
                var countrow = result.totalRecord;
                $("#num").html(countrow);
                $.each(result.transactions, function (index, value) {
                    result += resulttaixiudetail(value.reference_id, value.user_name, value.bet_value, value.bet_side, value.prize, value.refund, value.input_time, value.game, value.time_log);
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
                                url: "<?php echo admin_url('logminigame/detailphientaixiuajax')?>",
                                data: {
                                    phientx: $("#phientx").val(),
                                    cuadat: $("#bet_side").val(),
                                    fromDate: $("#fromDate").val(),
                                    pages: page,
                                    nickname : $("#name").val()
                                },
                                dataType: 'json',
                                success: function (result) {
                                    $("#spinner").hide();
                                    $.each(result.transactions, function (index, value) {
                                        result += resulttaixiudetail(value.reference_id, value.user_name, value.bet_value, value.bet_side, value.prize, value.refund, value.input_time, value.game, value.time_log);
                                    });
                                    $('#logaction').html(result);
                                }
                            });
                        }
                        oldpage = page;
                    }
                });

            } else {
                $("#spinner").hide();
                $('#pagination-demo').css("display", "none");
                $('#resulttai').css("display", "none");
                $('#errortai').html("Không có ai đặt tài");
            }
        }
    });
}
function replacedice(str) {
    return str.replace(/0/g, "bầu").replace(/1/g, "cua").replace(/2/g, "tôm").replace(/3/g, "cá").replace(/4/g, "gà").replace(/5/g, "hưou");
}
function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
    }
    return val;
}
</script>
