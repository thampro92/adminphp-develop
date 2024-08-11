<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Biến động số dư</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div><link rel="stylesheet"
                              href="<?php echo public_url() ?>/site/css/loggamethirdparty.css"><?php if($role == false): ?>
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
                <h6>Biến động số dư</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/userwin') ?>" method="post">

                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="money-type-1" style="margin-left: 7px">Chọn Game:</label></td>
                            <td><select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="game" name="game">
                                    <option value="" <?php if($this->input->post('game') == ""){echo "selected";} ?>>Tất Cả</option>
                                    <option value="vb" <?php if($this->input->post('game') == "vb"){echo "selected";} ?>>VB52</option>
                                    <option value="lux" <?php if($this->input->post('game') == "lux"){echo "selected";} ?>>Lux52</option>
                                </select></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr class="nickname">
                            <td><label>Nick name:</label></td>
                            <td><input type="text"
                                       id="nickName" value="<?php echo $this->input->post('nickName') ?>" name="nickName"></td>
                            <td><label class="session-1">Số Phiên:</label></td>
                            <td><input type="text" class="session-2"
                                       id="transId" value="<?php echo $this->input->post('transId') ?>" name="transId"></td>
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
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $this->input->post('fromDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>                            </td>
                            <td>
                                <label for="param_name" class="formLeft formtoDate"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $this->input->post('toDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div hidden class="formRow">
                    <table>
                        <tr>
                            <td><label class="session-1">User id:</label></td>
                            <td><input type="text" class="session-2"
                                       id="userId" value="<?php echo $this->input->post('userId') ?>" name="userId"></td>
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
                                       onclick="window.location.href = '<?php echo admin_url('report/userwin') ?>'; "
                                       value="Reset" class="basic">
                            </td>
                            <td>
                            <span style="margin-left: 20px">
                                <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name'=>'biendongsodu', 'columns_excel' => "0,1,2,3,4,5,6,7,8"]); ?>
                            </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr class="list-loggameslot">
                    <td>STT</td>
                    <td style="width: 0px;">Transaction id</td>
                    <td>Nick name</td>
                    <td>Current money</td>
                    <td>Money exchange</td>
                    <td style="width: 0px;">Phế</td>
                    <td>Trans time</td>
                    <td>Action name</td>
                    <td>Description</td>
                    <td>Game</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif;?>
<div class="container">
    <h6 class="total-data">Tổng bản ghi:<span class="total-data-span" id="totalData"></span></h6>
    <div id="spinner" class="spinner image-loggameslot">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10
    $("#search_tran").click(function () {        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }

    });

    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0);
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59);
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent : false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: endDate,
            useCurrent : false,
        });

    });
    $(document).ready(function () {
        initData()
    });

    function initData() {
        var fromdate;
        var todate;
        var oldpage = 0;
        if($("#toDate").val()!=""){
            var match = $("#toDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            todate = moment.unix(date.getTime()/1000).format("YYYY-MM-DD HH:mm:ss")
        }
        else{
            todate =  "";
        }
        if($("#fromDate").val()!=""){
            var match = $("#fromDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            fromdate = moment.unix(date.getTime()/1000).format("YYYY-MM-DD HH:mm:ss")
        }
        else{
            fromdate =  "";
        }
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/userwinajax')?>",
            data: {
                nickName: $("#nickName").val(),
                game: $("#game").val(),
                toDate: todate,
                fromDate: fromdate,
                transId : $("#transId").val(),
                page : 1,
                page_size: page_size
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.data == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    let totalPage = Math.floor(result.totalData/10) + (result.totalData%10?1:0);
                    $("#totalData").html($.number(result.totalData, undefined, '.', ','));
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.data, function (index, value) {
                        result += resultSearchTransction(stt,value);
                        stt ++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if(oldpage>0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/userwinajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        game: $("#game").val(),
                                        toDate: todate,
                                        fromDate: fromdate,
                                        transId : $("#transId").val(),
                                        page : page,
                                        page_size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = (page - 1) * page_size + 1;
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
                }
            }, error: function () {
                $('#logaction').html("");
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    }
    function resultSearchTransction(stt,value) {
        value.game = !value.game ? "" : value.game;
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.trans_id + "</td>";
        rs += "<td>" + value.nick_name + "</td>";
        rs += "<td>" + $.number(value.current_money, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.money_exchange, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.fee, undefined, '.', ',') + "</td>";
        rs += "<td>" + value.trans_time + "</td>";
        rs += "<td>" + value.action_name + "</td>";
        rs += "<td title='" + value.description + "'>" + value.description + "</td>";
        rs += "<td>" + value.game + "</td>";
        rs += "</tr>";
        return rs;
    }
</script>