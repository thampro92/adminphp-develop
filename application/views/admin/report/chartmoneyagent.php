<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<?php if($role == false): ?>
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
        <script src="<?php echo public_url() ?>/site/bootstrap/highcharts.js"></script>
        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>

            <div class="title">
                <h6>Biểu đồ tổng số vin đại lý</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/chartmoneyagent') ?>" method="post">
                <div class="formRow">

                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $start_time?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>                            </td>

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                       class="formLeft"> Đến ngày: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $end_time?>" > <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                            <td style="">
                                <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/chartmoneyagent') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow">
                <div id="chartContainer" style="min-width: 310px; height: 400px; margin: 0 auto">
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-sm"></ul>
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

<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')
            return false;
        }
    });
    $(document).ready(function () {
        var oldPage = 0;
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/chartmoneytotalajax')?>",
            data: {
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                pages : 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.totals == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                }else {
                    var Agent1 = [];
                    var Agent2 = [];
                    var Time = [];
                    $.each(result.totals, function (index, value) {
                        Agent1.push(value.moneyAgent1);
                        Agent2.push(value.moneyAgent2);
                        Time.push(value.timeLog);
                    });
                    chart(Agent1,Agent2,Time);

                    if($('#pagination-demo').data("twbs-pagination")){
                        $('#pagination-demo').twbsPagination('destroy');
                    }

                    $('#pagination-demo').twbsPagination({
                        totalPages: 1000,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            var Agent1 = [];
                            var Agent2 = [];
                            var Time = [];
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/chartmoneytotalajax')?>",
                                    data: {
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        pages : page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.totals, function (index, value) {
                                            Agent1.push(value.moneyAgent1);
                                            Agent2.push(value.moneyAgent2);
                                            Time.push(value.timeLog);
                                        });
                                        chart(Agent1,Agent2,Time);
                                    }
                                });
                            }
                            oldPage = page;
                        }
                    });
                }
            }
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

    function chart (agent1,agent2,date) {
        Highcharts.chart('chartContainer', {
            title: {
                text: 'Biểu đồ luồng tiền',
                x: -20 //center
            },
            xAxis: {
                categories: date,
            },
            yAxis: {
                title: {
                    text: 'Tổng tiền'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]

            },
            chart: {
                zoomType: 'x'

            },
            tooltip: {
                valueSuffix: ' Vin'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Đại lý cấp 1',
                data: agent1
            }]
        });

    }
</script>