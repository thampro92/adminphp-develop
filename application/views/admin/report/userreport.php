
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Báo cáo User</h5>
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
                <h6>Báo cáo User đăng ký</h6>
            </div>

            <form class="list_filter form" action="<?php echo admin_url('report/userreport') ?>" method="post">


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
                                <td>Ngày</td>
                                <td>Đăng ký mới</td>
                                <td>Nạp mới</td>
                                <td>Đăng ký bảo mật</td>
                                <td>Cả Nạp và Đăng ký bảo mật</td>
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
            url: "<?php echo admin_url('report/userreportajax')?>",
            data: {
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
                    let total = 0;

                    result.sort(function(a,b){
                        // Turn your strings into dates, and then subtract them
                        // to get a value that is either negative, positive, or zero.
                        return new Date(b.message) - new Date(a.message);
                    });

                    $.each(result, function (index, value) {
                        result += resultSearchTransction(value);
                        total++;
                    });
                    $('#logaction').html(result);
                    $('#total').html(total);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if(oldpage>0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/userreportajax')?>",
                                    data: {
                                        fromDate: $('#fromDate').val(),
                                        toDate: $('#toDate').val()
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = (page - 1) * 10 + 1;
                                        $.each(result.data, function (index, value) {
                                            result += resultSearchTransction(value);
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

        rs += "<tr>";


//{"success":true,"message":"2022-08-28","errorCode":"200","data":null,"register":46,"recharge":0,"secMobile":16,"both":0}
        rs += "<td>" + data.message + "</td>";
        rs += "<td>" + data.register + "</td>";
        rs += "<td>" + data.recharge + "</td>";
        rs += "<td>" + data.secMobile + "</td>";
        rs += "<td>" + data.both + "</td>";
        rs += "</tr>";


        return rs;
    }

</script>