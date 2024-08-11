<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Chi tiết giao dịch Nạp/Rút</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div><link rel="stylesheet"
                              href="<?php echo public_url() ?>/site/css/loggamethirdparty.css">

<?php $this->load->view('admin/error')?>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <h4 id="resultsearch"></h4>

        <form class="list_filter form" action="<?php echo admin_url('report/revenuedetail?'); echo "/"?>" method="post">
            <div class="formRow">
                <table>
                    <tr class="nickname">
                        <td><label>Nick name:</label></td>
                        <td><input type="text"
                                   id="nickName" value="<?php echo $this->input->post('nickName') ?>" name="nickName"></td>
                        <td><label class="session-1">Kênh TT:</label></td>
                        <td>
                            <select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="pt" name="pt">
                                    <option value="0" <?php if($this->input->post('pt') == "0"){echo "selected";} ?>>Chọn</option>
                                    <option value="1" <?php if($this->input->post('pt') == "1"){echo "selected";} ?>>Card</option>
                                    <option value="2" <?php if($this->input->post('pt') == "2"){echo "selected";} ?>>Bank</option>
                                    <option value="3" <?php if($this->input->post('pt') == "3"){echo "selected";} ?>>Momo</option>
                            </select>
                        </td>
                        <td><label class="session-1">OS:</label></td>
                        <td>
                            <select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="pf" name="pf">
                                <option value="0" <?php if($this->input->post('pf') == "0"){echo "selected";} ?>>Tất Cả</option>
                                <option value="1" <?php if($this->input->post('pf') == "1"){echo "selected";} ?>>Web</option>
                                <option value="2" <?php if($this->input->post('pf') == "2"){echo "selected";} ?>>Android</option>
                                <option value="3" <?php if($this->input->post('pf') == "3"){echo "selected";} ?>>ios</option>
                            </select>
                        </td>
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
                        <td><label class="money-type-1" style="margin-left: 7px">Hình Thức:</label></td>
                        <td><select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="t" name="t">
                                <option value="1" <?php if($this->input->post('t') == "1"){echo "selected";} ?>>Nạp</option>
                                <option value="2" <?php if($this->input->post('t') == "2"){echo "selected";} ?>>Rút</option>
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
                                   onclick="window.location.href = '<?php echo admin_url('report/revenuedetail') ?>'; "
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
                <td style="width: 0px;">UserId</td>
                <td>User Name</td>
                <td>Nick Name</td>
                <td>Kênh</td>
                <td style="width: 0px;">Số tiền</td>
                <td>Phí</td>
                <td>Description</td>
                <td>Khởi Tạo</td>
                <td>Hoàn Thành</td>
            </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
    </div>
</div>

<div class="container">

    <div id="spinner" class="spinner image-loggameslot">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 500
    $("#search_tran").click(function () {        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }

    });

    $(function () {

        const strf = '<?php echo $ft; ?>';
        if(strf !== ''){
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate:  strf,
                useCurrent : false,
            });
        }

        const stre = '<?php echo $et; ?>'
        if(stre!== ''){
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate:  stre,
                useCurrent : false,
            });
        }

        const nn = '<?php echo $nn; ?>'
        if(nn !== ''){
            document.getElementById("nickName").value = nn;
        }

        const pt = '<?php echo $t; ?>'
        if(pt !== ''){
            document.getElementById('pt').value=pt;
        }

        const t = '<?php echo $pt; ?>'
        if(pt !== ''){
            document.getElementById('t').value=t;
        }


        const pf = '<?php echo $pf; ?>'
        if(pf !== ''){
            document.getElementById('pf').value=pf;
        }



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
        initData()
    });

    function initData() {
        var fromdate = $("#fromDate").val();
        var todate   =   $("#toDate").val();
        var oldpage = 0;

        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/revenuedetailajax')?>",
            data: {
                nickName: $("#nickName").val(),
                toDate: todate,
                fromDate: fromdate,
                t : $("#t").val(),
                pt: $("#pt").val(),
                pf: $("#pf").val(),
                page : 1,
                maxItem: page_size
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.result == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    let totalPage = Math.floor(result.totalData/10) + (result.totalData%10?1:0);
                    $("#totalData").html($.number(result.totalData, undefined, '.', ','));
                    $("#totalBet").html($.number(result.totalBet, undefined, '.', ','));
                    $("#totalFee").html($.number(result.totalFee, undefined, '.', ','));
                    $("#totalSoVongcuoc").html($.number(result.totalSoVongcuoc, undefined, '.', ','));
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.result, function (index, value) {
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
                                    url: "<?php echo admin_url('report/revenuedetailajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        toDate: todate,
                                        fromDate: fromdate,
                                        t : $("#t").val(),
                                        pt: $("#pt ").val(),
                                        page : page,
                                        maxItem: page_size
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = (page - 1) * page_size + 1;
                                        $.each(result.result, function (index, value) {
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
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.UserId + "</td>";
        rs += "<td>" + value.Username + "</td>";
        rs += "<td>" + value.Nickname + "</td>";
        rs += "<td>" + value.ProviderName + "</td>";
        rs += "<td>" + $.number(value.Amount, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.AmountFee, undefined, '.', ',') + "</td>";

        rs += "<td>" + value.BankCode + " - " + value.Description + "</td>";

        rs += "<td>" + value.CreatedAt + "</td>";
        rs += "<td>" + value.ModifiedAt + "</td>";

        rs += "</tr>";
        return rs;
    }
</script>