<section class="content-header">
    <h1>
        Quản trị giftcode
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="form-group successful">
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <label class="control-label col-sm-2" id="successgift" style="color: #00a65a"></label>
                        </div>
                    </div>
                    <div class="form-group successful">
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <label class="control-label col-sm-2" id="errorgift" style="color: red"></label>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <label class="col-sm-1 control-label text-right" for="exampleInputEmail1">Giftcode</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="money" name="money">
                                    <option value="1">Zik</option>
                                    <option value="0">Xu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <label id="labelvin" class="col-sm-2 control-label text-right">Mệnh giá</label>

                            <div class="col-sm-2" id="menhgiavin" style="padding: 0">
                                <select name="menhgiavin" class="form-control" id="roomvin">
                                    <?php foreach($listvin as $key => $row): ?>
                                        <option value="<?php echo $row ?>"><?php echo $row."K" ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-2" id="menhgiaxu" style="display: none">
                                <select name="menhgiaxu" class="form-control" id="roomxu">
                                    <?php foreach($listxu as $key => $row): ?>
                                        <option value="<?php echo $row ?>"><?php echo $row."M Xu" ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label id="errormg"  style="color:red " class="col-sm-2"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <label class="col-sm-2 control-label text-right">Số lượng:</label>

                            <div class="col-sm-2" style="padding: 0">
                                <input type="text" class="form-control" id="soluong">
                            </div>
                            <label class="col-sm-2 text-left" id="errorsl" style="color: red"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <label class="col-sm-2 control-label text-right">Tên chiến dịch:</label>

                            <div class="col-sm-2" style="padding: 0">
                                <input type="text" class="form-control" id="camp">
                            </div>
                            <label class="col-sm-2 text-left" id="errorsl" style="color: red"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <label class="col-sm-2 control-label text-right" for="datetimepicker1">Hạn sử dụng:</label>
                            <div class="col-sm-2 input-group  text-left" id="datetimepicker1"  style="padding: 0">
                                <input class="form-control" type="text" id="endTime" name="endTime"
                                       value="<?php echo $this->input->post('endTime') ?>"> <span
                                        class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>






                    <div class="form-group" hidden>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <label class="col-sm-2 control-label text-right">Đợt phát hành:</label>

                            <div class="col-sm-2">
                                <select id="phathanh" class="form-control">
                                    <option value="1">Chọn</option>
                                    <?php foreach($listversion as $key => $row): ?>
                                        <option value="<?php echo $row ?>">Đợt <?php echo $row ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2"><input type="submit" value="Thêm giftcode" name="submit"
                                                         class="btn btn-primary pull-left" id="search_tran"></div>
                            <div class="col-sm-1"><input type="reset" value="Reset" name="submit"
                                                         class="btn btn-primary pull-left" id="reset"
                                                         onclick="window.location.href = '<?php echo admin_url('giftcodevh/vhadd') ?>'; ">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-2" hidden>
                            <input type="text" class="form-control" id="maxcamp">
                        </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên chiến dịch</th>
                                <th>Số lượng Giftcode</th>
                                <th>Số lượng Đã sử dụng</th>
                                <th>Mệnh giá</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="logaction">

                            </tbody>
                        </table>

                        <div id="spinner" class="spinner" style="display:none;">
                            <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
                        </div>
                        <div class="text-center pull-right">
                            <ul id="pagination-demo" class="pagination-sm"></ul>
                        </div>

                    </div>
                    <iframe id="my_iframe" style="display:none;"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>
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
    }</style>
<script>
    $(".successful").click(function () {
        $(".successful").hide();
    });
    $("#search_tran").click(function () {


        if ($("#camp").val() == "") {
            $("#errorsl").html("Bạn phải nhập Tên chiến dịch");
            $("#errorph").html("");
            return false;
        }else if ($("#soluong").val() == "") {
            $("#errorsl").html("Bạn phải nhập số lượng giftcode");
            $("#errorph").html("");
            return false;
        } else if ($("#phathanh").val() == "") {
            $("#errorph").html("Bạn phải chọn đợt phát hành giftcode");
            $("#errorsl").html("");
            return false;
        }else if($("#soluong").val() > 1000000){
            $("#errorsl").html("");
            $("#errorph").html("");
            $("#errorgift").html("Bạn chỉ được xuất 1000000 giftcode");
            $("#successgift").html("");
            return false;
        }


        if ($("#money").val() == 1) {
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcodevh/vhaddajax') ?>",
                data: {
                    money: $("#roomvin").val(),
                    quantity: $("#soluong").val(),
                    version: $("#phathanh").val(),
                    moneytype: $("#money").val(),
                    camp: $("#camp").val(),
                    maxcamp : $("#maxcamp").val(),
                    endTime : $("#endTime").val()
                },
                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    if (result == 1) {
                        $("#successgift").html("Bạn Thêm giftcode thành công");
                        $("#errorgift").html("");
                    } else if (result = 2) {
                        $("#errorgift").html("Bạn Thêm giftcode thất bại");
                        $("#successgift").html("");
                    }
                    $("#errorph").html("");
                    $("#errorsl").html("");
                    inilist();
                }, error: function () {
                    $("#spinner").hide();
                    $("#errorgift").html("Hệ thống quá tải.Vui lòng thử lại");
                    $("#errorsl").html("");
                    $("#errorph").html("");
                    $("#successgift").html("");
                }, timeout: 60000
            })
        } else if ($("#money").val() == 0) {
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcodevh/vhaddajax') ?>",
                data: {
                    money: $("#roomxu").val(),
                    quantity: $("#soluong").val(),
                    version: $("#phathanh").val(),
                    moneytype: $("#money").val(),
                    camp: $("#camp").val(),
                    maxcamp : $("#maxcamp").val(),
                    endTime : $("#endTime").val()
                },
                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    if (result == 1) {
                        $("#successgift").html("Bạn Thêm giftcode thành công");
                        $("#errorgift").html("");
                    } else if (result == 2) {
                        $("#errorgift").html("Bạn Thêm giftcode thất bại");
                        $("#successgift").html("");
                    }
                    $("#errorph").html("");
                    $("#errorsl").html("");
                    inilist();
                }, error: function () {
                    $("#spinner").hide();
                    $("#errorgift").html("Hệ thống quá tải.Vui lòng thử lại");
                    $("#errorsl").html("");
                    $("#errorph").html("");
                    $("#successgift").html("");
                }, timeout: 60000
            })
        }
    });
    $(document).ready(function () {


        var startDate = moment(new Date()).add(15, 'days').hours(0).minutes(0).seconds(0).milliseconds(0)


        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent: false,
        });


        $('#soluong').on('paste', function (e) {
            let pastedData = e.originalEvent.clipboardData.getData('text');
            let money = parseInt(pastedData);
            if(isNaN(money) || money <= 0) {
                alert("Vui lòng nhập số lớn hơn 0");
                e.preventDefault();
            }
        });
        $("#soluong").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $('#money').change(function () {
            var val = $("#money option:selected").val();
            if (val == 1) {
                $("#labelvin").css("display", "block");
                $("#menhgiavin").css("display", "block");
                $("#menhgiaxu").css("display", "none");
            } else if (val == 0) {
                $("#menhgiaxu").css("display", "block");
                $("#labelvin").css("display", "block");
                $("#menhgiavin").css("display", "none");
            }
        });


        /////
        inilist();
    });


    function inilist() {

        var result = "";
        var oldpage = 0;

        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcodevh/listcampajax') ?>",
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result.counts<=0){
                    $("#resultsearch").html("Không tìm thấy kết quả")
                }else {
                    var totalPage = result.total;
                    var countrow = result.totalRecord;
                    $("#num").html(countrow);
                    stt = 1;
                    $.each(result.data, function (index, value) {
                        result += resultgiftcodevin(stt, value.campain, value.quantity, value.used, value.price, value.create_time, value.export);
                        stt++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if(oldpage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('giftcodevh/listcampajax') ?>",
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.data, function (index, value) {
                                            result += resultgiftcodevin(stt, value.campain, value.quantity, value.used, value.price, value.create_time, value.export);
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
        });
    }

    function ActiveCode(money, quantity, camp ) {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcodevh/vhaddgcajax') ?>",
            data: {
                money: money,
                quantity: quantity,
                source: 'GVH',
                version: '1',
                moneytype: '1',
                camp: camp
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result == 1) {
                    $("#successgift").html("Bạn Active giftcode thành công");
                    $("#errorgift").html("");
                } else if (result == 2) {
                    $("#errorgift").html("Bạn Active thất bại");
                    $("#successgift").html("");
                }
                $("#errorph").html("");
                $("#errorsl").html("");
                inilist();
            }, error: function () {
                $("#spinner").hide();
                $("#errorgift").html("Hệ thống quá tải.Vui lòng thử lại");
                $("#errorsl").html("");
                $("#errorph").html("");
                $("#successgift").html("");
            }, timeout: 60000
        })

    }




    function DonwloadCode(camp ) {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcodevh/donwloadCamp') ?>",
            data: {
                camp: camp
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                //fte-sq.org
                //vb52.vip
                window.open(result.message.replace("vb52.vip", "domainsieudep.com"), '_blank').focus();
            }, error: function () {
                $("#spinner").hide();
                $("#errorgift").html("Hệ thống quá tải.Vui lòng thử lại");
                $("#errorsl").html("");
                $("#errorph").html("");
                $("#successgift").html("");
            }, timeout: 60000
        })

    }




    function resultgiftcodevin(stt,camp, countgiftcode, countgiftcodeuse, price,createtime, gcexport) {

        $("#maxcamp").val(stt);
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + camp + "</td>";
        rs += "<td>" + countgiftcode + "</td>";
        rs += "<td>" + countgiftcodeuse + "</td>";
        rs += "<td>" + price + "</td>";
        rs += "<td>" + createtime + "</td>";
        if(gcexport >= 1){
            rs += "<td style='color: #00CC00'>" + "Active" + "</td>";
        }else{
            rs += "<td style='color: #ff0000'>" + "Inactive" + "</td>";
        }

        if(gcexport < 1){
            rs += "<td class='option'>" +
                    "<a href=\"#\" title=\"Active Giftcode\" onclick=\"ActiveCode(" + price + "," + countgiftcode + "," + "'" + camp + "'" +  ");\" class=\"text-primary btn-circle\"> <i class=\"fa fa-check fa-2x\" aria-hidden=\"true\"></i></a>" +
            "</td>";
        }else{
            rs += "<td class='option'>" +
                        "<a href=\"#\" onclick=\"DonwloadCode(" + "'" + camp + "'" +  ");\" title=\"Tải Giftcode\" class=\"text-primary btn-circle\">  <i class=\"fa fa-download fa-2x\" aria-hidden=\"true\"></i></a>" +
                "</td>";
        }

        rs += "</tr>";
        return rs;
    }



</script>
