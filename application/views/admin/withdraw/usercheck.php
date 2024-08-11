<?php $this->load->view('admin/usergame/head', $this->data) ?>
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
        <script
            src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
            <div class="title">
                <h6>Danh sách đánh dấu tài khoản</h6>
                <h6 style="float: right">Tổng số tài khoản:<span style="color:#0000ff" id="numuser"></span></h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('withdraw/usercheck') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label class="formLeft" id="nameuser">Từ ngày:</label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?php echo $this->input->post('fromDate') ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </td>
                            <td>
                                <label  class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?php echo $this->input->post('toDate') ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="formLeft">Nickname:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="nickname" value="<?php echo $this->input->post('nickname') ?>"
                                       name="nickname">
                            </td>
                            <td>
                                <label  class="formLeft"> Số tài khoản: </label>
                            </td>
                            <td><input type="text" class="my-input-class"
                                       id="stk" value="<?php echo $this->input->post('stk') ?>"
                                       name="stk">
                            </td>
                            <td ><label class="formLeft">Màu đánh dấu:</label></td>
                            <td class="item"><select id="type" name="type"
                                                     class="my-input-class">
                                    <option value="" <?php if($this->input->post('type') == ""){echo "selected";} ?>>Chọn màu</option>
                                    <option value="1" <?php if($this->input->post('type') == "1"){echo "selected";} ?>>Đỏ</option>
                                    <option value="2" <?php if($this->input->post('type') == "2"){echo "selected";} ?>>Vàng</option>
                                </select></td>

                            <td hidden>
                                <label  class="formLeft"> Hiển thị: </label>
                            </td>
                            <td class="item"><select id="record" name="record"
                                                     class="my-input-class" hidden>
                                    <option value="50" <?php if ($this->input->post('record') == 50) {
                                        echo "selected";
                                    } ?> >50
                                    </option>
                                    <option value="100" <?php if ($this->input->post('record') == 100) {
                                        echo "selected";
                                    } ?>>100
                                    </option>
                                    <option value="200" <?php if ($this->input->post('record') == 200) {
                                        echo "selected";
                                    } ?>>200
                                    </option>
                                    <option value="500" <?php if ($this->input->post('record') == 500) {
                                        echo "selected";
                                    } ?>>500
                                    </option>
                                    <option value="1000" <?php if ($this->input->post('record') == 1000) {
                                        echo "selected";
                                    } ?>>1000
                                    </option>
                                    <option value="2000" <?php if ($this->input->post('record') == 2000) {
                                        echo "selected";
                                    } ?>>2000
                                    </option>
                                    <option value="5000" <?php if ($this->input->post('record') == 5000) {
                                        echo "selected";
                                    } ?>>5000
                                    </option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow" hidden>
                    <table>
                        <tr>
                            <td><label class="formLeft">Điện thoại:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="phone" value="<?php echo $this->input->post('phone') ?>" name="phone"></td>
                            <td><label class="formLeft">Email:</label></td>
                            <td><input type="text" class="my-input-class"
                                       id="txtemail" value="<?php echo $this->input->post('txtemail') ?>"
                                       name="txtemail"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td style="">
                                <input type="reset" id="search_tran1" value="Thêm mới đánh dấu User" class="button blueB"
                                       onclick="window.location.href = '<?php echo admin_url('withdraw/addusercheck') ?>'; "
                                       style="margin-left: 70px">
                            </td>
                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('withdraw/usercheck') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
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
                                <td>STT</td>
                                <td>Nickname</td>
                                <td>Số tài khoản</td>
                                <td>Lý do đánh dấu</td>
                                <td>Ngày tạo</td>
                                <td>Hành động</td>
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
    td {
        word-break: break-all;
    }

    thead {
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
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0)
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59)

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // defaultDate: startDate,
            useCurrent: false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // defaultDate: endDate,
            useCurrent: false,
        });
        // $('#datetimepicker1').data("DateTimePicker").maxDate(endDate);
        // $('#datetimepicker2').data("DateTimePicker").minDate(startDate);
        //
        // $("#datetimepicker1").on("dp.change", function (e) {
        //     $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        //
        // });
        // $("#datetimepicker2").on("dp.change", function (e) {
        //     $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        // });
    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    });

    function resultSearchTransction(stt, nick_name, type, create_time, bank_number, comment) {

        var rs = "";

        if(type == 1){
            rs += "<tr style='background:red;'>";
        } else if(type == 2){
            rs += "<tr style='background:yellow;'>";
        }else{
            rs += "<tr>";
        }


        rs += "<td>" + stt + "</td>";
        rs += "<td>" + (nick_name || '-') + "</td>";
        rs += "<td>" + (bank_number || '-') + "</td>";
        rs += "<td>" + (comment || '-') + "</td>";
        rs += "<td>" + create_time + "</td>";
        rs += "<td class='option'>" +
            "<a href= \"<?php echo admin_url('withdraw/editusercheck?nn=')?>"+(nick_name||'-')+"&stk="+(bank_number||'-')+"&type="+type+"&comment="+comment+"\" title=\"Sửa User\" class=\"text-primary\"> <i class=\"fa fa-edit\" style='color:black;' aria-hidden=\"true\"></i></a>" +
            "<a href=\"#\" title=\"Xóa User\" onclick=\"deletenn('" + (nick_name || '-') + "','" + (bank_number || '-') + "','" + type + "','" + 2 + "');\" class=\"text-primary\"> <i class=\"fa fa fa-trash\" style='color:black;' aria-hidden=\"true\"></i></a>" +
            "</td>";
        return rs;
    }

    function deletenn(nn, stk, type, update_type) {
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('withdraw/addusercheckajax') ?>",
            data: {
                nn: nn,
                stk: stk,
                type: type,
                update_type: 2
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.response>0) {
                    $("#resultsearch").html("Xóa thành công");
                    $("#logaction").html("");
                    window.location.href = '<?php echo admin_url('withdraw/usercheck') ?>';
                } else {
                    $("#resultsearch").html("Xóa thất bại");
                    $("#logaction").html("");
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        })

    }


    $(document).ready(function () {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('withdraw/usercheckajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                stk: $("#stk").val(),
                nickname: $("#nickname").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                pages: 1,
                record: $("#record").val(),
                type: $("#type").val()
            },

            dataType: 'json',
            success: function (result) {
                $("#numuser").html(result.length);
                $("#spinner").hide();
                if (result == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    $("#resultsearch").html("");
                    var totalPage = 1;
                    stt = 1;
                    $.each(result, function (index, value) {
                        result += resultSearchTransction(stt, value.nick_name, value.type, value.create_time, value.bank_number, value.comment);
                        stt++;
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
                                    url: "<?php echo admin_url('withdraw/usercheckajax')?>",
                                    // url: "http://192.168.0.251:8082/api_backend",
                                    data: {
                                        stk: $("#stk").val(),
                                        nickname: $("#nickname").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        pages: 1,
                                        record: $("#record").val(),
                                        type: $("#type").val()

                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result, function (index, value) {
                                            result += resultSearchTransction(stt, value.nick_name, value.type, value.create_time, value.bank_number, value.comment);
                                            stt++;
                                        });
                                        $('#logaction').html(result);
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

    });
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>
