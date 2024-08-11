<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Lô đề</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget backaccount">
        <form class="list_filter form" action="<?php echo admin_url('loggamethirdparty/lode') ?>" method="post">
            <div class="formRow row">
                <div class="col-sm-1">
                    <label for="giftCode">Nick name : </label>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="nn" value="<?php echo $this->input->post('nn') ?>" name="nn">
                </div>

                <div class="col-sm-1">
                    <label for="giftCode">Từ ngày : </label>
                </div>
                <div class="col-sm-3">
                    <div class="input-group" id="datetimepicker1">
                        <input type="text" id="fromDate" name="fromDate" value="<?php echo $this->input->post('fromDate') ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-1">
                    <label for="giftCode">Đến ngày : </label>
                </div>
                <div class="col-sm-3">
                    <div class="input-group" id="datetimepicker2">
                        <input type="text" id="toDate" name="toDate" value="<?php echo $this->input->post('toDate') ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="formRow row">
                <div class="col-sm-1">
                    <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB">
                </div>
                <div class="col-sm-1">
                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('loggamethirdparty/lode') ?>';" value="Reset" class="basic">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="float-right"> | Tổng bản ghi:<span style="color:#0000ff" id="total"></span></h3>
                <h3 class="float-right">Tổng người chơi:<span style="color:#0000ff" id="players"></span></h3>
            </div>
            <div class="col-sm-12">
                <div id="resultsearch" class="float-left text-danger"></div>
            </div>
        </div>
        <div class="formRow">
            <div class="row">
                <div class="col-xs-12">
                    <table id="checkAll" class="table table-bordered">
                        <thead>
                        <tr style="height: 20px;">
                            <th style="width:40px">STT</th>
                            <th>Nick Name</th>
                            <th>Ngày Xổ</th>
                            <th>Loại Đề</th>
                            <th>Số Cược</th>
                            <th>Số Tiền</th>
                            <th>Tiền Thắng</th>
                            <th>Kết Quả</th>
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
<div class="container">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10
    var list_data =[]
    $(document).ready(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: '<?= date("Y-m-d", strtotime('-3 days'))?>',
            useCurrent: false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: '<?= date("Y-m-d")?>',
            useCurrent: false,
        });
        if ($("#fromDate").val() > $("#toDate").val()) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
        initData()
    })
    function resultList(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td class='stt'>" + stt + "</td>";
        rs += "<td>" + value.nickname + "</td>";
        rs += "<td>" + value.TimePlay + "</td>";


        if(value.GameMode == 1){
            rs += "<td>Bao Lô 2 Số</td>";
        }else if(value.GameMode == 2){
            rs += "<td>Bao Lô 3 Số</td>";
        }else if(value.GameMode == 3){
            rs += "<td>Lô Xiên 2</td>";
        }else if(value.GameMode == 4){
            rs += "<td>Lô Xiên 3</td>";
        }else if(value.GameMode == 5){
            rs += "<td>Lô Xiên 4</td>";
        }else if(value.GameMode == 9){
            rs += "<td>Đề Đặc Biệt</td>";
        }else if(value.GameMode == 11){
            rs += "<td>Ba Càng</td>";
        }else if(value.GameMode == 5){
            rs += "<td>Lô Xiên 4</td>";
        }else if(value.GameMode == 17){
            rs += "<td>Lô Trượt Xiên 10</td>";
        }else if(value.GameMode == 24){
            rs += "<td>Lô Trượt Xiên 14</td>";
        }else if(value.GameMode == 25){
            rs += "<td>Lô Trượt Xiên 12</td>";
        }else if(value.GameMode == 8){
            rs += "<td>Đề Đầu</td>";
        }else if(value.GameMode == 6){
            rs += "<td>Đầu</td>";
        }else if(value.GameMode == 7){
            rs += "<td>Đuôi</td>";
        }


        rs += "<td>" + value.Number + "</td>";
        rs += "<td>" + commaSeparateNumber((value.Pay * value.PayRate).toString()) + "</td>";
        rs += "<td>" + commaSeparateNumber((value.Win).toString()) + "</td>";

        if(value.Win > 0){
            rs += "<td>Thắng</td>";
        }else{
            rs += "<td>Thua</td>";
        }

        return rs;
    }
    function countUnique(iterable) {


        var tempResult = {}

        for(let { nickname,   Id } of iterable)
            tempResult[nickname] = {
                Id,
                nickname,
                count: tempResult[nickname] ? tempResult[nickname].count + 1 : 1
            }


        let Result = Object.keys(tempResult).length
        console.log(Result)
        return Result;


    }

    function commaSeparateNumber(val) {
        if (val == undefined) {
            return '-'
        }
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    $("#export").click(function () {
        $('#isEx').val(1);
        return;
    });

    function initData() {
        var oldPage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loggamethirdparty/lodeAjax')?>",
            data: {
                nn: $("#nn").val(),
                ft: $("#fromDate").val(),
                et : $("#toDate").val(),
                pg : 1,
                size: page_size
            },
            dataType: 'json',
            success: function (response) {
                let result = response

                result.total = response.length;
                $("#total").html(result.total);
                if (result.total > 0) {
                    $("#players").html(countUnique(response));
                }
                $("#spinner").hide();

                if (result.total == 0) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    // list_data = result.data.fishgamerecords;
                    list_data = result;
                    $("#resultsearch").html("");
                    let totalPage = Math.floor(result.total/page_size) + (result.total%page_size?1:0);
                    stt = 1;
                    let str = ''
                    $.each(list_data, function (index, value) {
                        str += resultList(stt, value);
                        stt++;
                    });
                    $('#logaction').html(str);

                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('loggamethirdparty/lodeAjax')?>",
                                    data: {
                                        nn: $("#nn").val(),
                                        ft: $("#fromDate").val(),
                                        et : $("#toDate").val(),
                                        pages : page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        list_data = response.data.fishgamerecords
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page -1) * page_size + 1;
                                        let str = ''
                                        $.each(list_data, function (index, value) {
                                            str += resultList(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(str);
                                    }, error: function () {
                                        list_data = []
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
                                    },timeout : 20000
                                });
                            }
                            oldPage = page;
                        }
                    });
                }

            }, error: function () {
                list_data = []
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            },timeout : 20000
        })
    };
</script>
<style>
</style>