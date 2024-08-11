<?php $this->load->view('admin/ccu/head', $this->data) ?>

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
        <div class="widget">

            <div class="formRow">
                <form class="list_filter form" action="<?php echo admin_url('ccu/index') ?>" method="post">
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
                                       style="margin-left: 50px;margin-bottom:-2px;width: 100px">Đến ngày:</label></td>
                            <td class="item"><input name="toDate"
                                                    value="<?php echo $this->input->post('toDate') ?>"
                                                    id="toDate" type="text" class="datepicker"/></td>




                            <td style="">
                                <input type="button" id="search_tran" value="Tìm kiếm" class="button blueB"
                                       style="margin-left: 20px">
                            </td>

                        </tr>
                    </table>
                </form>
            </div>
            <div class="formRow">
                <h4>Tổng CCU : <span id="sumccu" style="color: #0000ff"></span></h4>
            </div>
            <table class="table table-bordered table-striped" id="checkAll">
                <thead>
                <tr>
                    <td style="width: 14.15%">
                        Web
                    </td>
                    <td style="width: 14.15%">
                        Android
                    </td>
                    <td style="width: 14.15%">
                        Ios
                    </td>
                    <td style="width: 14.15%">
                        Other
                    </td>

                </tr>
                </thead>
                <tbody id="logccu">
                </tbody>
            </table>
            <div class="formRow">
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="formRow">
                <div id="chartcontainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="<?php echo public_url() ?>/site/bootstrap/highcharts.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/exporting.js"></script>
<script>
    $(document).ready(function () {
        $("#fromDate").val('<?= date('Y-m-d H:i:s', strtotime("-12 hours"))?>');
        $("#toDate").val('<?= date("Y-m-d H:i:s")?>');
        getCcu();
    });


    var inverval_timer;
    inverval_timer = setInterval(function () {
        $("#fromDate").val('<?= date('Y-m-d H:i:s', strtotime("-12 hours"))?>');
        $("#toDate").val('<?= date("Y-m-d H:i:s")?>');
        getCcu();
        //window.location.reload(true);
    }, 15000);


    $("#search_tran").click(function () {
        getCcu();
    });
    $(function () {
        $('#toDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#fromDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });

    function getInputSelect(selectObject) {
        var value = selectObject.value;

        if (value == '') {
            $("#version").empty();

            select = document.getElementById('version');

            var opt = document.createElement('option');
            opt.value = "";
            opt.innerHTML = "Tất Cả Version VB52 + Lux52";
            select.appendChild(opt);
        }

        if (value == 'vb') {
            $("#version").empty();
            select = document.getElementById('version');
            var rs = "";
            rs += `<option value="" <?php if ($this->input->post('version') == "") {
                echo "selected";
            } ?>>Tất Cả Version VB52</option>`;
            rs += `<option value="web" <?php if ($this->input->post('version') == "web") {
                echo "selected";
            } ?>>VB52 web</option>`;
            rs += `<option value="i1.0" <?php if ($this->input->post('version') == "i1.0") {
                echo "selected";
            } ?>>VB52 i1.0</option>`;
            rs += `<option value="i2.0" <?php if ($this->input->post('version') == "i2.0") {
                echo "selected";
            } ?>>VB52 i2.0</option>`;
            rs += `<option value="a1.0" <?php if ($this->input->post('version') == "a1.0") {
                echo "selected";
            } ?>>VB52 a1.0</option>`;
            rs += `<option value="a2.0" <?php if ($this->input->post('version') == "a2.0") {
                echo "selected";
            } ?>>VB52 a2.0</option>`;
            rs += `<option value="a3.0" <?php if ($this->input->post('version') == "a3.0") {
                echo "selected";
            } ?>>VB52 a3.0</option>`;
            rs += `<option value="a4.0" <?php if ($this->input->post('version') == "a4.0") {
                echo "selected";
            } ?>>VB52 a4.0</option>`;
            rs += `<option value="a5.0" <?php if ($this->input->post('version') == "a5.0") {
                echo "selected";
            } ?>>VB52 a5.0</option>`;
            rs += `<option value="unknow" <?php if ($this->input->post('version') == "unknow") {
                echo "selected";
            } ?>>VB52 Không Xác Định</option>`;
            select.innerHTML = rs;
        }
        if (value == 'lux') {
            $("#version").empty();
            select = document.getElementById('version');
            var rs = "";
            rs += `<option value="" <?php if ($this->input->post('version') == "") {
                echo "selected";
            } ?>>Tất Cả Version Lux52</option>`;
            rs += `<option value="lxweb" <?php if ($this->input->post('version') == "lxweb") {
                echo "selected";
            } ?>>Lux52 web</option>`;
            rs += `<option value="lxi1.0" <?php if ($this->input->post('version') == "lxi1.0") {
                echo "selected";
            } ?>>Lux52 lxi1.0</option>`;
            rs += `<option value="lxa1.0" <?php if ($this->input->post('version') == "lxa1.0") {
                echo "selected";
            } ?>>Lux52 lxa1.0</option>`;
            rs += `<option value="lxa2.0" <?php if ($this->input->post('version') == "lxa2.0") {
                echo "selected";
            } ?>>Lux52 lxa2.0</option>`;
            rs += `<option value="lxa3.0" <?php if ($this->input->post('version') == "lxa3.0") {
                echo "selected";
            } ?>>Lux52 lxa3.0</option>`;
            rs += `<option value="lxunknow" <?php if ($this->input->post('version') == "lxunknow") {
                echo "selected";
            } ?>>Lux52 Không Xác Định</option>`;
            select.innerHTML = rs;
        }

    }


    function getCcu() {

        var result = "";
        var newlabels = [];
        var ccu = [];
        var Web = [];
        var Android = [];
        var Ios = [];
        var Winphone = [];
        var Facebook = [];
        var Destkop = [];
        var Other = [];

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('ccu/indexajax')?>",
            data: {
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                game: $("#game").val(),
                version: $("#version").val()
            },
            dataType: 'json',
            success: function (data) {

                var count = 0;
                $.each(data.transactions, function (i, item) {
                    newlabels.push(item.ts);
                    ccu.push(item.ccu);
                    Web.push(item.web);
                    Android.push(item.ad);
                    Ios.push(item.ios);
                    Winphone.push(item.wp);
                    Facebook.push(item.fb);
                    Destkop.push(item.dt);
                    Other.push(item.ot);
                    count++;

                });

                result += resultccu(Web[count - 1], Android[count - 1], Ios[count - 1], Winphone[count - 1], Facebook[count - 1], Destkop[count - 1], Other[count - 1]);
                $('#logccu').html(result);
                $('#sumccu').html(ccu[count - 1]);
                $(function () {
                    $('#container').highcharts({
                        title: {
                            text: 'Tổng CCU',
                            x: -20 //center
                        },
                        subtitle: {
                            text: '',
                            x: -20
                        },
                        chart: {
                            zoomType: 'x'
                        },
                        rangeSelector: {
                            selected: 1
                        },
                        xAxis: {
                            categories: newlabels
                        },

                        yAxis: {
                            title: {
                                text: 'ccu'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            },

                            ]
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle',
                            borderWidth: 0
                        },
                        series: [{
                            name: 'CCU',
                            data: ccu
                        }]
                    });
                });
                chart(Web, Android, Ios, Winphone, Facebook, Destkop, Other, newlabels);
            }
        });
    }

    function chart(web, android, ios, winphone, facebook, destkop, other, date) {
        Highcharts.chart('chartcontainer', {
            title: {
                text: 'CCU từng thiết bị',
                x: -20 //center
            },
            xAxis: {
                categories: date,
            },
            yAxis: {
                title: {
                    text: 'Tổng User'
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
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Web',
                data: web
            }, {
                name: 'Android',
                data: android

            }, {
                name: 'IOS',
                data: ios

            },
                {
                    name: 'Winphone',
                    data: winphone,
                    visible: false

                },
                {
                    name: 'App Facebook',
                    data: facebook,
                    visible: false

                },
                {
                    name: 'Destkop',
                    data: destkop,
                    visible: false

                },
                {
                    name: 'Other',
                    data: other,
                    visible: false

                }]
        });

    }

    function resultccu(web, android, ios, winphone, facebook, destkop, other) {
        web = !web ? 0 : web;
        android = !android ? 0 : android;
        ios = !ios ? 0 : ios;
        other = !other ? 0 : other;
        var rs = "";
        rs += "<tr>";
        rs += "<td style='color: #0000ff'>" + web + "</td>";
        rs += "<td style='color: #0000ff'>" + android + "</td>";
        rs += "<td style='color: #0000ff'>" + ios + "</td>";
        rs += "<td style='color: #0000ff'>" + other + "</td>";
        rs += "</tr>";
        return rs;
    }
</script>