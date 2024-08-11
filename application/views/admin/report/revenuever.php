
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Báo cáo doanh thu</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>

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
            <div class="formRow">
                <form class="list_filter form" action="<?php echo admin_url('report/revenuever') ?>" method="post">
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
                                       style="margin-left: 50px;margin-bottom:-2px;width: 110px">Đến ngày:</label></td>
                            <td class="item"><input name="toDate"
                                                    value="<?php echo $this->input->post('toDate') ?>"
                                                    id="toDate" type="text" class="datepicker"/></td>


                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Game:</label></td>
                            <td><select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="game" name="game" onchange="getInputSelect(this)">

                                    <option value="" <?php if($this->input->post('game') == ""){echo "selected";} ?>>Tất Cả Game</option>
                                    <option value="vb" <?php if($this->input->post('game') == "vb"){echo "selected";} ?>>VB52</option>
                                    <option value="lux" <?php if($this->input->post('game') == "lux"){echo "selected";} ?>>Lux52</option>

                                </select></td>

                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Version:</label></td>

                            <td><select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="version" name="version">

                                    <option value="" <?php if($this->input->post('version') == ""){echo "selected";} ?>>Tất Cả Version VB52 + Lux52</option>

                                </select></td>





                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 20px">
                            </td>

                        </tr>
                    </table>
                </form>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <h3 class="float-right"> <span style="color:#0000ff" id="total"></span></h3>
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


    $(document).ready(function () {
        $("#fromDate").val('<?= date('Y-m-d')?>');
        $("#toDate").val('<?= date("Y-m-d")?>');
        init();
    });

    $("#search_tran").click(function () {
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

    function getInputSelect(selectObject) {
        var value = selectObject.value;

        if(value == ''){
            $("#version").empty();

            select = document.getElementById('version');

            var opt = document.createElement('option');
            opt.value = "";
            opt.innerHTML = "Tất Cả Version VB52 + Lux52";
            select.appendChild(opt);
        }

        if(value == 'vb'){
            $("#version").empty();
            select = document.getElementById('version');
            var rs = "";
            rs += `<option value="" <?php if($this->input->post('version') == ""){echo "selected";} ?>>Tất Cả Version VB52</option>`;
            rs += `<option value="web" <?php if($this->input->post('version') == "web"){echo "selected";} ?>>VB52 web</option>`;
            rs += `<option value="i1.0" <?php if($this->input->post('version') == "i1.0"){echo "selected";} ?>>VB52 i1.0</option>`;
            rs += `<option value="i2.0" <?php if($this->input->post('version') == "i2.0"){echo "selected";} ?>>VB52 i2.0</option>`;
            rs += `<option value="a1.0" <?php if($this->input->post('version') == "a1.0"){echo "selected";} ?>>VB52 a1.0</option>`;
            rs += `<option value="a2.0" <?php if($this->input->post('version') == "a2.0"){echo "selected";} ?>>VB52 a2.0</option>`;
            rs += `<option value="a3.0" <?php if($this->input->post('version') == "a3.0"){echo "selected";} ?>>VB52 a3.0</option>`;
            rs += `<option value="a4.0" <?php if($this->input->post('version') == "a4.0"){echo "selected";} ?>>VB52 a4.0</option>`;
            rs += `<option value="a5.0" <?php if($this->input->post('version') == "a5.0"){echo "selected";} ?>>VB52 a5.0</option>`;
            rs += `<option value="unknow" <?php if($this->input->post('version') == "unknow"){echo "selected";} ?>>VB52 Không Xác Định</option>`;
            select.innerHTML = rs;
        }
        if(value == 'lux'){
            $("#version").empty();
            select = document.getElementById('version');
            var rs = "";
            rs += `<option value="" <?php if($this->input->post('version') == ""){echo "selected";} ?>>Tất Cả Version Lux52</option>`;
            rs += `<option value="lxweb" <?php if($this->input->post('version') == "lxweb"){echo "selected";} ?>>Lux52 web</option>`;
            rs += `<option value="lxi1.0" <?php if($this->input->post('version') == "lxi1.0"){echo "selected";} ?>>Lux52 lxi1.0</option>`;
            rs += `<option value="lxa1.0" <?php if($this->input->post('version') == "lxa1.0"){echo "selected";} ?>>Lux52 lxa1.0</option>`;
            rs += `<option value="lxa2.0" <?php if($this->input->post('version') == "lxa2.0"){echo "selected";} ?>>Lux52 lxa2.0</option>`;
            rs += `<option value="lxa3.0" <?php if($this->input->post('version') == "lxa3.0"){echo "selected";} ?>>Lux52 lxa3.0</option>`;
            rs += `<option value="lxunknow" <?php if($this->input->post('version') == "lxunknow"){echo "selected";} ?>>Lux52 Không Xác Định</option>`;
            select.innerHTML = rs;
        }

    }


     function init() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var oldpage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/revenueverajax')?>",
            data: {
                game: $('#game').val(),
                version: $('#version').val(),
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
                                    url: "<?php echo admin_url('report/revenueverajax')?>",
                                    data: {
                                        game: $('#game').val(),
                                        version: $('#version').val(),
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
    }

    function resultSearchTransction(data) {
        var rs = "";

        var nn = '';
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
            `"  target="_blank">`+ $.number(data.deposit_web_card, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` +  momo + "pf=1"  + `"  target="_blank">`+ $.number(data.deposit_web_momo, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bank + "pf=1"  + `"  target="_blank">`+ $.number(data.deposit_web_bank, undefined, '.', ',') + `</a>` +
            "</td>";

        rs += "<td>" + $.number(data.deposit_web, undefined, '.', ',') + "</td>";
        rs += "</tr>";


        rs += "<tr>";
        rs +=  "<td colspan=\"4\">Nạp Android: </td>"
        rs += "</tr>";

        rs += "<tr>";

        //$.number(value.Amount, undefined, '.', ',')

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>`
            + card+ "pf=2" +
            `"  target="_blank">`+ $.number(data.deposit_ad_card, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` +  momo+ "pf=2"  + `"  target="_blank">`+ $.number(data.deposit_ad_momo, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bank+ "pf=2"  + `"  target="_blank">`+ $.number(data.deposit_ad_bank, undefined, '.', ',')+ `</a>` +
            "</td>";

        rs += "<td>" + $.number(data.deposit_ad, undefined, '.', ',') + "</td>";
        rs += "</tr>";


        rs += "<tr>";
        rs +=  "<td colspan=\"4\">Nạp ios: </td>"
        rs += "</tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>`
            + card + "pf=3" +
            `"  target="_blank">`+ $.number(data.deposit_ios_card, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` +  momo+ "pf=3"  + `"  target="_blank">`+ $.number(data.deposit_ios_momo, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bank+ "pf=3"  + `"  target="_blank">`+ $.number(data.deposit_ios_bank, undefined, '.', ',') + `</a>` +
            "</td>";

        rs += "<td>" + $.number(data.deposit_ios, undefined, '.', ',') + "</td>";
        rs += "</tr>";

        rs += "<tr>";
        rs +=  "<td style='text-align: right;' colspan=\"4\">Tổng Nạp: " +  $.number(data.deposit, undefined, '.', ',') +  "</td>";
        rs += "</tr>";



        var cardO = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=2" + "&t=1&");
        var momoO = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=2" + "&t=3&");
        var bankO = ("nn=" + nn + "&ft=" + ft + "&et=" + et + "&pt=2" + "&t=2&");

        rs +=  "<td colspan=\"4\">Rút WEB: </td>"
        rs += "</tr>";
        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + cardO  + "pf=1" + `"  target="_blank">`+ $.number(data.withdrawal_web_card, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + momoO  + "pf=1" + `"  target="_blank">`+ $.number(data.withdrawal_web_momo, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bankO  + "pf=1" + `"  target="_blank">`+ $.number(data.withdrawal_web_bank, undefined, '.', ',') + `</a>` +
            "</td>";

        rs += "<td>" + $.number(data.withdrawal_web, undefined, '.', ',') + "</td>";
        rs += "</tr>";


        rs +=  "<td colspan=\"4\">Rút Android: </td>"
        rs += "</tr>";
        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + cardO  + "pf=2" + `"  target="_blank">`+ $.number(data.withdrawal_ad_card , undefined, '.', ',')+ `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + momoO  + "pf=2" + `"  target="_blank">`+ $.number(data.withdrawal_ad_momo , undefined, '.', ',')+ `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bankO  + "pf=2" + `"  target="_blank">`+ $.number(data.withdrawal_ad_bank , undefined, '.', ',')+ `</a>` +
            "</td>";

        rs += "<td>" + $.number(data.withdrawal_ad , undefined, '.', ',')+ "</td>";
        rs += "</tr>";



        rs +=  "<td colspan=\"4\">Rút ios: </td>"
        rs += "</tr>";
        rs += "<tr>";

        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + cardO  + `"  target="_blank">`+ $.number(data.withdrawal_ios_card, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + momoO  + `"  target="_blank">`+ $.number(data.withdrawal_ios_momo, undefined, '.', ',') + `</a>` +
            "</td>";
        rs += "<td>" +
            `<a href="<?php echo admin_url('report/revenuedetail?')?>` + bankO  + `"  target="_blank">`+ $.number(data.withdrawal_ios_bank, undefined, '.', ',') + `</a>` +
            "</td>";

        rs += "<td>" + $.number(data.withdrawal_ios, undefined, '.', ',')+ "</td>";
        rs += "</tr>";
        rs +=  "<td style='text-align: right;' colspan=\"4\">Tổng Rút: " +  $.number(data.withdrawal , undefined, '.', ',')+  "</td>";

        return rs;
    }

</script>