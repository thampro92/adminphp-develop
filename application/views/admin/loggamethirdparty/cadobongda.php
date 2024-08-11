<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Cá độ thể thao</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget backaccount">
        <form class="list_filter form" action="<?php echo admin_url('loggamethirdparty/cadobongda') ?>" method="post">
            <div class="formRow row">
                

                <div class="col-sm-1">
                    <label for="fromDate">Từ ngày : </label>
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
                    <label for="toDate">Đến ngày : </label>
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
                    <label for="nn">Nick name : </label>
                </div> 
                <div class="col-sm-2">
                    <input type="text" id="nn" value="<?php echo $this->input->post('nn') ?>" name="nn">
                </div>
                <div class="col-sm-1">
                    <label for="Platform">Search : </label>
                </div> 
                <div class="col-sm-2">
                    <input type="text" id="Platform" value="<?php echo $this->input->post('Platform') ?>" name="Platform">
                </div>

                <div class="col-sm-1">
                    <label for="bet_side">Trạng Thái : </label>
                </div> 
                <div class="col-sm-2">
                    <select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="bet_side" name="bet_side" onchange="getInputSelect(this)">
                    <option value="-1" <?php if($this->input->post('bet_side') == "-1"){echo "selected";} ?>>Tất Cả Trạng Thái</option>
                    <option value="0" <?php if($this->input->post('bet_side') == "0"){echo "selected";} ?>>Cược Chưa Tính</option>
                    <option value="1" <?php if($this->input->post('bet_side') == "1"){echo "selected";} ?>>Cược Đã Tính</option>
                    </select>
                </div> 

            </div>

            <div class="formRow row">
                <div class="col-sm-1">
                    <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB">
                </div>
                <div class="col-sm-1">
                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('loggamethirdparty/cadobongda') ?>';" value="Reset" class="basic">
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
                    <table id="checkAll" class="table table-bordered">
                        <thead>
                        <tr style="height: 60px;">
                            <th>STT</th>
                            <th>ID</th>
                            <th>Nick Name</th>
                            <th>Tên giải đấu</th>
                            <th>Tên trận đấu</th>
                            <th>Bắt đầu đá</th>
                            <th>Tên kèo đặt</th>
                            <th>Tên cửa đặt</th>
                            <th>Tổng chi phí</th>
                            <th>Tỷ lệ cược</th>
                            <th>Tiền thắng</th>
                            <th>Trạng thái</th>
                            <th>Thời gian đặt</th>
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
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 1000
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
        rs += "<td>" + value.bet_id + "</td>";
        rs += "<td>" + value.nn + "</td>";
        rs += "<td>" + value.league_name + "</td>";
        rs += "<td>" + value.match_name + "</td>";
        rs += "<td>" + value.start_time + "</td>";
        rs += "<td>" + value.bet_name + "</td>";
        rs += "<td>" + value.odd_name + "</td>";
        rs += "<td>" + commaSeparateNumber((value.total_bet_amount).toString()) + "</td>";
        rs += "<td>" + value.ood_bet + "</td>";
        rs += "<td>" + commaSeparateNumber((value.win_amount).toString()) + "</td>";  
        rs += "<td>" + value.status + "</td>";
        rs += "<td>" + value.bet_time + "</td>"; 
    
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
            url: "<?php echo admin_url('loggamethirdparty/cadobongdaAjax')?>",
            data: {
                nn: $("#nn").val(),
                ft: $("#fromDate").val(),
                et : $("#toDate").val(),
                Platform: $("#Platform").val(),
                bet_side: $("#bet_side").val(),
                pages : 1,
                size: page_size
            },
            dataType: 'json',
            success: function (response) {
                let result = response.data;
                let total = response.total;
                $("#total").html(total);
                if (total > 0) {
                    $("#players").html(countUnique(response.data));
                }
                $("#spinner").hide();

                if (total == 0) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                } else {
                    // list_data = result.data.fishgamerecords;
                    list_data = result;
                    $("#resultsearch").html("");
                    let totalPage = Math.floor(total/page_size) + (total%page_size?1:0);
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
                                    url: "<?php echo admin_url('loggamethirdparty/cadobongdaAjax')?>",
                                    data: { 
                                        nn: $("#nn").val(),
                                        ft: $("#fromDate").val(),
                                        et : $("#toDate").val(),
                                        Platform: $("#Platform").val(),
                                        bet_side: $("#bet_side").val(),
                                        pages : page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        list_data = response.data;
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