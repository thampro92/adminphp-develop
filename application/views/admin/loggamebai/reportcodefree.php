<?php //$this->load->view('admin/loggamebai/head', $this->data) ?>
<!--<div class="line"></div>-->
<?php //if ($role == false): ?>
<!--    <div class="wrapper">-->
<!--        <div class="widget">-->
<!--            <div class="title">-->
<!--                <h6>Bạn không được phân quyền</h6>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<?php //else: ?>
<!--    --><?php //$this->load->view('admin/error')?>
<!--    <div class="wrapper">-->
<!--    --><?php //$this->load->view('admin/message', $this->data); ?>
<!--    -->

<!--    -->
<!--    <script src="--><?php //echo public_url() ?><!--/site/bootstrap/moment.js"></script>-->

<!---->
<!--    <div class="widget">-->
<!--    <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>-->
<!---->
<!--    <div class="title">-->
<!--        <h6>Chi tiết code free poker tour </h6>-->
<!--    </div>-->
<!--    <form class="list_filter form" action="--><?php //echo admin_url('loggamebai/reportcodefree') ?><!--" method="post">-->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <label for="param_name" class="formLeft" id="nameuser"-->
<!--                           style="margin-left: 70px;margin-bottom:-2px;width: 100px">Từ ngày:</label></td>-->
<!--                <td class="item">-->
<!--                    <div class="input-group date" id="datetimepicker1">-->
<!--                        <input type="text" id="toDate" name="toDate"-->
<!--                               value="--><?php //echo $this->input->post('toDate') ?><!--"> <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--</span>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </td>-->
<!---->
<!--                <td>-->
<!--                    <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"-->
<!--                           class="formLeft"> Đến ngày: </label>-->
<!--                </td>-->
<!--                <td class="item">-->
<!---->
<!--                    <div class="input-group date" id="datetimepicker2">-->
<!--                        <input type="text" id="fromDate" name="fromDate"-->
<!--                               value="--><?php //echo $this->input->post('fromDate') ?><!--"> <span-->
<!--                            class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--</span>-->
<!--                    </div>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!--    <div class="formRow">-->
<!---->
<!--        <table>-->
<!--            <tr>-->
<!--                <td><label style="margin-left: 100px;margin-bottom:-2px;width: 120px">Id:</label></td>-->
<!--                <td><input type="text" style="margin-left: -50px;margin-bottom:-2px;width: 150px"-->
<!--                           id="txt_id" value="--><?php //echo $this->input->post('txt_id') ?><!--" name="txt_id">-->
<!--                </td>-->
<!--                <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nickname:</label></td>-->
<!--                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                           id="nickname" value="--><?php //echo $this->input->post('nickname') ?><!--" name="nickname">-->
<!--                </td>-->
<!---->
<!---->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!---->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <label for="param_name" style="width: 120px;margin-bottom:-3px;margin-left: 100px;"-->
<!--                           class="formLeft">Code: </label>-->
<!--                </td>-->
<!--                <td><input type="text" style="margin-left: -50px;margin-bottom:-2px;width: 150px"-->
<!--                           id="txt_code" value="--><?php //echo $this->input->post('txt_code') ?><!--" name="txt_code">-->
<!--                </td>-->
<!---->
<!--                <td>-->
<!--                    <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"-->
<!--                           class="formLeft">Giá trị code: </label>-->
<!--                </td>-->
<!--                <td class="item"><select id="select_gtcode" name="select_gtcode"-->
<!--                                         style="margin-left: 5px;margin-bottom:-2px;width: 150px">-->
<!--                        <option value="-1">Chọn</option>-->
<!--                        <option value="10000" --><?php //if ($this->input->post('select_gtcode') == "10000") {
//                            echo "selected";
//                        } ?><!-->10K-->
<!--                        </option>-->
<!--                        <option value="50000" --><?php //if ($this->input->post('select_gtcode') == "50000") {
//                            echo "selected";
//                        } ?><!-- >50K-->
<!--                        </option>-->
<!--                        <option value="100000" --><?php //if ($this->input->post('select_gtcode') == "100000") {
//                            echo "selected";
//                        } ?><!-- >100K-->
<!--                        </option>-->
<!--                        <option value="200000" --><?php //if ($this->input->post('select_gtcode') == "200000") {
//                            echo "selected";
//                        } ?><!-- >200K-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!---->
<!--                <td>-->
<!--                    <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"-->
<!--                           class="formLeft">Trạng thái: </label>-->
<!--                </td>-->
<!---->
<!--                <td class="item"><select id="select_tt" name="select_tt"-->
<!--                                         style="margin-left: 5px;margin-bottom:-2px;width: 150px">-->
<!--                        <option value="-1"--><?php //if ($this->input->post('select_tt') == "") {
//                            echo "selected";
//                        } ?><!-->Chọn-->
<!--                        </option>-->
<!--                        <option value="0" --><?php //if ($this->input->post('select_tt') == "0") {
//                            echo "selected";
//                        } ?><!-->Chưa active-->
<!--                        </option>-->
<!--                        <option value="1" --><?php //if ($this->input->post('select_tt') == "1") {
//                            echo "selected";
//                        } ?><!-->Đã active-->
<!--                        </option>-->
<!--                        <option value="2" --><?php //if ($this->input->post('select_tt') == "2") {
//                            echo "selected";
//                        } ?><!-->Block-->
<!--                        </option>-->
<!--                        <option value="3" --><?php //if ($this->input->post('select_tt') == "3") {
//                            echo "selected";
//                        } ?><!-->Đã sử dụng-->
<!--                        </option>-->
<!--                        <option value="4" --><?php //if ($this->input->post('select_tt') == "4") {
//                            echo "selected";
//                        } ?><!-->Hết hạn-->
<!--                        </option>-->
<!---->
<!--                    </select>-->
<!---->
<!--                </td>-->
<!---->
<!--                <td>-->
<!--                    <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"-->
<!--                           class="formLeft"> Tìm theo: </label>-->
<!--                </td>-->
<!--                <td class="item"><select id="search_type" name="search_type"-->
<!--                                         style="margin-left: 5px;margin-bottom:-2px;width: 150px">-->
<!--                        <option value="0" --><?php //if ($this->input->post('search_type') == 0) {
//                            echo "selected";
//                        } ?><!-- >Thời gian tạo-->
<!--                        </option>-->
<!--                        <option value="1" --><?php //if ($this->input->post('search_type') == 1) {
//                            echo "selected";
//                        } ?><!-->Thời gian sử dụng-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </td>-->
<!---->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!---->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td><label style="margin-left: 47px;margin-bottom:-2px;width: 100px">Lô Id:</label></td>-->
<!--                <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"-->
<!--                           id="txt_loid" value="--><?php //echo $this->input->post('txt_loid') ?><!--" name="txt_loid">-->
<!--                </td>-->
<!--                <td><label style="margin-left: 47px;margin-bottom:-2px;width: 100px">Loại Code:</label></td>-->
<!--                <td><select id="typecode" name="typecode"-->
<!--                            style="margin-left: 30px;margin-bottom:-2px;width: 150px">-->
<!--                        <option value="-1" --><?php //if ($this->input->post('typecode') == "-1") {
//                            echo "selected";
//                        } ?><!-->Chọn-->
<!--                        </option>-->
<!--                        <option value="1" --><?php //if ($this->input->post('typecode') == "1") {
//                            echo "selected";
//                        } ?><!-->Daily-->
<!--                        </option>-->
<!--                        <option value="2" --><?php //if ($this->input->post('typecode') == "2") {
//                            echo "selected";
//                        } ?><!-->Vip-->
<!--                        </option>-->
<!--                    </select></td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!---->
<!--    <div class="formRow">-->
<!--        <table>-->
<!--            <tr>-->
<!--                <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Thông tin thêm:</label></td>-->
<!--                <td><input type="text" style="margin-left: 18px;margin-bottom:-2px;width: 150px"-->
<!--                           id="txt_thongtin" value="--><?php //echo $this->input->post('txt_thongtin') ?><!--" name="txt_thongtin">-->
<!--                </td>-->
<!---->
<!--                <td style="">-->
<!--                    <input type="submit" id="search_tran" value="Tìm kiếm" class="button blueB"-->
<!--                           style="margin-left: 70px">-->
<!--                </td>-->
<!--                <td style="">-->
<!--                    <input type="button" id="exportexel" value="Xuất Exel" class="button blueB"-->
<!--                           style="margin-left: 20px">-->
<!--                </td>-->
<!---->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!--    </form>-->
<!---->
<!--    <div class="formRow">-->
<!--        <div class="row">-->
<!--            <div class="col-xs-12">-->
<!--                <table id="checkAll" class="table table-bordered" style="table-layout: fixed">-->
<!--                    <thead>-->
<!--                    <tr style="height: 20px;">-->
<!--                        <td style="width: 70px">ID</td>-->
<!--                        <td style="width: 70px">Lô</td>-->
<!--                        <td style="width: 170px">Code</td>-->
<!--                        <td>Tên game</td>-->
<!--                        <td>Loại code</td>-->
<!--                        <td>Mệnh giá</td>-->
<!--                        <td>Trạng thái</td>-->
<!--                        <td style="width: 170px">Hạn sử dụng</td>-->
<!--                        <td style="width: 170px">Ngày tạo</td>-->
<!--                        <td>Nickname sử dụng</td>-->
<!--                        <td>Thông tin thêm</td>-->
<!--                        <td>Thời gian sử dụng</td>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody id="logaction">-->
<!--                    </tbody>-->
<!--                </table>-->
<!--                <div id="pagination" style="float: right"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    </div>-->
<!--    </div>-->
<?php //endif; ?>
<!--<style>-->
<!--    td {-->
<!--        word-break: break-all;-->
<!--    }-->
<!---->
<!--    thead {-->
<!--        font-size: 12px;-->
<!--    }-->
<!---->
<!--    .spinner {-->
<!--        position: fixed;-->
<!--        top: 50%;-->
<!--        left: 50%;-->
<!--        margin-left: -50px; /* half width of the spinner gif */-->
<!--        margin-top: -50px; /* half height of the spinner gif */-->
<!--        text-align: center;-->
<!--        z-index: 1234;-->
<!--        overflow: auto;-->
<!--        width: 100px; /* width of the spinner gif */-->
<!--        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */-->
<!--    }</style>-->
<!--<div class="container">-->
<!--    <div id="spinner" class="spinner" style="display:none;">-->
<!--        <img id="img-spinner" src="--><?php //echo public_url('admin/images/gif-load.gif') ?><!--" alt="Loading"/>-->
<!--    </div>-->
<!--    <div class="text-center">-->
<!--        <ul id="pagination-demo" class="pagination-lg"></ul>-->
<!--    </div>-->
<!--</div>-->
<!--<script type="text/javascript" src="--><?php //echo public_url() ?><!--/js/jquery.table2excel.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo public_url()?><!--/js/jquery.simplePagination.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo public_url()?><!--/admin/css/simplePagination.css" media="screen" />-->
<!--<script>-->
<!--    $(function () {-->
<!--        $('#datetimepicker1').datetimepicker({-->
<!--            format: 'YYYY-MM-DD 00:00:00'-->
<!--        });-->
<!--        $('#datetimepicker2').datetimepicker({-->
<!--            format: 'YYYY-MM-DD 23:59:59'-->
<!--        });-->
<!---->
<!--    });-->
<!--    $("#search_tran").click(function () {-->
<!--        var fromDatetime = $("#toDate").val();-->
<!--        var toDatetime = $("#fromDate").val();-->
<!--        if (fromDatetime > toDatetime) {-->
<!--            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu')-->
<!--            return false;-->
<!--        }-->
<!--    });-->
<!--    function resultSearchTransction(id,lo,code,gamename,typecode,amount,status,expire,createTime,nickname, addInfo, useTime) {-->
<!---->
<!--        var rs = "";-->
<!--        rs += "<tr>";-->
<!--        rs += "<td>" + id + "</td>";-->
<!--        rs += "<td>" + lo + "</td>";-->
<!--        rs += "<td>" + code + "</td>";-->
<!--        rs += "<td>" + gamename + "</td>";-->
<!--        if(typecode == 1 ){-->
<!--            rs += "<td>" + "Daily" + "</td>";-->
<!--        }else if(typecode == 2){-->
<!--            rs += "<td>" + "Vip" + "</td>";-->
<!--        }-->
<!--        rs += "<td>" + commaSeparateNumber(amount) + "</td>";-->
<!--        rs += "<td>" + checkStatus(status) + "</td>";-->
<!---->
<!--        if(expire != null ){-->
<!--            rs += "<td>" + moment.unix(expire/1000).format("DD-MM-YYYY HH:mm:ss")+ "</td>";-->
<!--        }else{-->
<!--            rs += "<td>" + "" + "</td>";-->
<!--        }-->
<!--        if(createTime != null ){-->
<!--            rs += "<td>" + moment.unix(createTime/1000).format("DD-MM-YYYY HH:mm:ss")+ "</td>";-->
<!--        }else{-->
<!--            rs += "<td>" + "" + "</td>";-->
<!--        }-->
<!--        if(nickname != null ){-->
<!--        rs += "<td>" + nickname + "</td>";-->
<!--        }else{-->
<!--            rs += "<td>" + "" + "</td>";-->
<!--        }-->
<!--        if(addInfo != null ){-->
<!--            rs += "<td>" + addInfo + "</td>";-->
<!--        }else{-->
<!--            rs += "<td>" + "" + "</td>";-->
<!--        }-->
<!--        if(useTime != null ){-->
<!--            rs += "<td>" + moment.unix(useTime/1000).format("DD-MM-YYYY HH:mm:ss")+ "</td>";-->
<!--        }else{-->
<!--            rs += "<td>" + "" + "</td>";-->
<!--        }-->
<!--        rs += "</tr>";-->
<!--        return rs;-->
<!--    }-->
<!---->
<!--    function checkStatus(status){-->
<!--        var str = "";-->
<!--        if(status == 0){-->
<!--            str = "Chưa active";-->
<!--        }else if(status == 1){-->
<!--            str = "Đã active";-->
<!--        }else if(status == 2){-->
<!--            str = "Block";-->
<!--        }else if(status == 3){-->
<!--            str = "Đã sử dụng";-->
<!--        }else if(status == 4){-->
<!--            str = "Hết hạn";-->
<!--        }-->
<!--        return str;-->
<!--    }-->
<!--    $(document).ready(function () {-->
<!---->
<!--        var result = "";-->
<!--        $('#pagination-demo').css("display", "block");-->
<!--        $("#spinner").show();-->
<!--        $.ajax({-->
<!--            type: "POST",-->
<!--            url: "--><?php //echo admin_url('loggamebai/reportcodefreeajax')?>//",
//            data: {
//                toDate: $("#toDate").val(),
//                fromDate: $("#fromDate").val(),
//                id : $("#txt_id").val(),
//                nickname:$("#nickname").val(),
//                code: $("#txt_code").val(),
//                amount: $("#select_gtcode").val(),
//                status: $("#select_tt").val(),
//                search: $("#search_type").val(),
//                loid: $("#txt_loid").val(),
//                typecode: $("#typecode").val(),
//                thongtin: $("#txt_thongtin").val()
//            },
//
//            dataType: 'json',
//            success: function (res) {
//                $("#spinner").hide();
//                if (res == "") {
//                    $('#pagination-demo').css("display", "none");
//                    $("#resultsearch").html("Không tìm thấy kết quả");
//                } else {
//                    $("#resultsearch").html("");
//                    $.each(res, function (index, value) {
//                        result += resultSearchTransction( value.id, value.packageId, value.code, value.gamename, value.type, value.amount, value.status, value.expire, value.createTime, value.nickname, value.addInfo, value.useTime);
//
//                    });
//                    $('#logaction').html(result);
//                    Pagging();
//                }
//            }, error: function () {
//                $("#spinner").hide();
//                $('#logaction').html("");
//                $("#resultsearch").html("");
//                $("#error-popup").modal("show");
//            }, timeout: timeOutApi
//        })
//        function Pagging(){
//            var items = $("#checkAll #logaction tr");
//            var numItems = items.length;
//            console.log(numItems);
//
//            var perPage = 50;
//            // only show the first 2 (or "first per_page") items initially
//            items.slice(perPage).hide();
//            // now setup pagination
//            $("#pagination").pagination({
//                items: numItems,
//                itemsOnPage: perPage,
//                cssStyle: "light-theme",
//                onPageClick: function(pageNumber) { // this is where the magic happens
//                    // someone changed page, lets hide/show trs appropriately
//                    var showFrom = perPage * (pageNumber - 1);
//                    var showTo = showFrom + perPage;
//
//                    items.hide() // first hide everything, then show for the new page
//                        .slice(showFrom, showTo).show();
//                }
//            });
//        }
//   });
//
//
//    $("#exportexel").click(function () {
//        $("#checkAll").table2excel({
//            exclude: ".noExl",
//            name: "Excel Document Name",
//            filename: "Report",
//            fileext: ".xls",
//            exclude_img: true,
//            exclude_links: true,
//            exclude_inputs: true
//        });
//    });
//</script>
//<script>
//    function commaSeparateNumber(val) {
//        while (/(\d+)(\d{3})/.test(val.toString())) {
//            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
//        }
//        return val;
//    }
//</script>