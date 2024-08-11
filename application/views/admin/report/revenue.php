
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Báo cáo doanh thu</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php //if (!empty($uri)) { ?>
<!--    <div class="wrapper return-url">-->
<!--        <a class="" href="--><?//= admin_url('agency/listUserOfAgency') . '?' .$uri ?><!--">-->
<!--            <i class="fas fa-angle-double-left"></i> Quay lại-->
<!--        </a>-->
<!--    </div>-->
<?php //} ?>
<link rel="stylesheet"
      href="<?php echo public_url() ?>/site/css/loggamethirdparty.css"><?php if(false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>Bạn không được phân quyền</h6>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php $this->load->view('admin/error')?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>
        <div class="widget">
            <h4 id="resultsearch"></h4>
            <div class="title">
                <h6>Tiền Nạp/Rút Game(VNĐ)</h6>
            </div>

            <form class="list_filter form" action="<?php echo admin_url('report/revenue') ?>" method="post">

                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="session-1">NickName:</label></td>
                            <td><input class="session-2" type="text" id="nn" value="<?= empty($this->input->get('nn')) ? $this->input->post('nn') : $this->input->get('nn') ?>" name="nn"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>

                            <td>
                                <label for="param_name" class="formLeft" id="nameuser">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate" value="<?= empty($this->input->get('fromDate')) ?   $this->input->post('fromDate') : $this->input->get('fromDate') ?>"> <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <label for="param_name" class="formLeft formtoDate "> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">

                           <input type="text" id="toDate" name="toDate" value="<?= empty($this->input->get('toDate')) ? $this->input->post('toDate') : $this->input->get('toDate') ?>"> <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
    </span>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>

                <div class="formRow row">
                    <div class="col-sm-1">
                        <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB">
                    </div>
                    <div class="col-sm-1">
                        <input type="reset"  value="Reset" class="basic">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="float-right">Tổng bản ghi:<span style="color:#0000ff" id="total"></span></h3>
                </div>
                <div class="col-sm-12">
                    <div id="resultsearch" class="float-left text-danger"></div>
                </div>
            </div>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered" id="checkAll">
                            <thead>
                            <tr class="list-loggameslot">
                                <td>Kênh CARD</td>
                                <td>Kênh MOMO</td>
                                <td>Kênh Banks</td>
                                <td>Tổng Tiền</td>
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
<?php endif;?>
<div class="container">
    <div id="spinner" class="spinner image-loggameslot">
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
            format: 'YYYY-MM-DD',
            defaultDate: startDate,
            useCurrent : false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: endDate,
            useCurrent : false,
        });

    });
    $(document).ready(function () {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/revenueajax')?>",
            data: {
                nn: $('#nn').val(),
                fromDate: $('#fromDate').val(),
                toDate: $('#toDate').val()
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    let totalPage = 1;
                    $("#resultsearch").html("");
                    $('#logaction').html(resultSearchTransction(result));
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if(oldpage>0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/revenueajax')?>",
                                    data: {
                                        nn: $('#nn').val(),
                                        fromDate: $('#fromDate').val(),
                                        toDate: $('#toDate').val()
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = (page - 1) * 10 + 1;
                                        $.each(result.data, function (index, value) {
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
                }            }, error: function () {
                $('#logaction').html("");
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    });

    function resultSearchTransction(data) {
        var rs = "";

        var nn = $('#nn').val();
        var ft = $('#fromDate').val();
        var et =  $('#toDate').val();

        var card = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=1" + "&t=1&");
        var momo = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=1" + "&t=3&");
        var bank = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=1" + "&t=2&");


        rs += "<tr>";
        rs +=  "<td colspan=\"4\">Nạp WEB: </td>"
        rs += "</tr>";

        rs += "<tr>";

        rs += "<td>" +
        `<a href="<?php echo admin_url('report/revenuedetail?')?>`
            + card + "pf=1" +
            `"  target="_blank">`+ data.totalmoney_deposit_card_web + `</a>` +
        "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` +  momo + "pf=1"  + `"  target="_blank">`+ data.totalmoney_deposit_momo_web + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bank + "pf=1"  + `"  target="_blank">`+ data.totalmoney_deposit_bank_web + `</a>` +
            "</td>";

        rs += "<td>" + data.totalmoney_deposit_web + "</td>";
        rs += "</tr>";


        rs += "<tr>";
        rs +=  "<td colspan=\"4\">Nạp Android: </td>"
        rs += "</tr>";

        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>`
            + card+ "pf=2" +
            `"  target="_blank">`+ data.totalmoney_deposit_card_android + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` +  momo+ "pf=2"  + `"  target="_blank">`+ data.totalmoney_deposit_momo_android + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bank+ "pf=2"  + `"  target="_blank">`+ data.totalmoney_deposit_bank_android + `</a>` +
            "</td>";

        rs += "<td>" + data.totalmoney_deposit_android + "</td>";
        rs += "</tr>";


        rs += "<tr>";
        rs +=  "<td colspan=\"4\">Nạp ios: </td>"
        rs += "</tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>`
            + card + "pf=3" +
            `"  target="_blank">`+ data.totalmoney_deposit_card_ios + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` +  momo+ "pf=3"  + `"  target="_blank">`+ data.totalmoney_deposit_momo_ios + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bank+ "pf=3"  + `"  target="_blank">`+ data.totalmoney_deposit_bank_ios + `</a>` +
            "</td>";

        rs += "<td>" + data.totalmoney_deposit_ios + "</td>";
        rs += "</tr>";

        rs += "<tr>";
        rs +=  "<td style='text-align: right;' colspan=\"4\">Tổng Nạp: " +  data.totalmoney_deposit +  "</td>";
        rs += "</tr>";



        var cardO = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=2" + "&t=1&");
        var momoO = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=2" + "&t=3&");
        var bankO = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=2" + "&t=2&");

        rs +=  "<td colspan=\"4\">Rút WEB: </td>"
        rs += "</tr>";
        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + cardO  + "pf=1" + `"  target="_blank">`+ data.totalmoney_cashout_card_web + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + momoO  + "pf=1" + `"  target="_blank">`+ data.totalmoney_cashout_momo_web + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bankO  + "pf=1" + `"  target="_blank">`+ data.totalmoney_cashout_bank_web + `</a>` +
            "</td>";

        rs += "<td>" + data.totalmoney_cashout_web + "</td>";
        rs += "</tr>";


        rs +=  "<td colspan=\"4\">Rút Android: </td>"
        rs += "</tr>";
        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + cardO  + "pf=2" + `"  target="_blank">`+ data.totalmoney_cashout_card_android + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + momoO  + "pf=2" + `"  target="_blank">`+ data.totalmoney_cashout_momo_android + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bankO  + "pf=2" + `"  target="_blank">`+ data.totalmoney_cashout_bank_android + `</a>` +
            "</td>";

        rs += "<td>" + data.totalmoney_cashout_android + "</td>";
        rs += "</tr>";



        rs +=  "<td colspan=\"4\">Rút ios: </td>"
        rs += "</tr>";
        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + cardO  + `"  target="_blank">`+ data.totalmoney_cashout_card_ios + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + momoO  + `"  target="_blank">`+ data.totalmoney_cashout_momo_ios + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bankO  + `"  target="_blank">`+ data.totalmoney_cashout_bank_ios + `</a>` +
            "</td>";

        rs += "<td>" + data.totalmoney_cashout_ios+ "</td>";
        rs += "</tr>";
        rs +=  "<td style='text-align: right;' colspan=\"4\">Tổng Rút: " +  data.totalmoney_cashout +  "</td>";

        return rs;
    }

</script>