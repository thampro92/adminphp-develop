<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Log game bài detail</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>

<div class="wrapper">
    <div class="widget" style="width: 70%; margin-left: 100px">
        <table cellpadding="0" cellspacing="0" width="100%" style="font-size: 18px"
               class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr style="line-height: 30px">
                <td>Vị trí</td>
                <td>Tên người chơi</td>
                <td>Hành động</td>
                <td>Nội dung</td>
            </tr>
            </thead>
            <tbody id="logbai">

            </tbody>
        </table>
        <input type="hidden" id="sid" value="<?php echo $sid ?>">
        <input type="hidden" id="createtime" value="<?php echo $createtime ?>">

        <div class="formRow" style="line-height: 30px">
            <h3 id="ketthuc"></h3>
        </div>
    </div>
</div>
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
    $(document).ready(function () {
        $("#spinner").show();


        $createtime =  $("#createtime").val()
        $sid = $("#sid").val();
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loggamebai/ronghodetailajax')?>",
            data: {

                time : $createtime,
                sid : $sid
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result == "" || result == null) {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("Không tìm thấy kết quả");
                    $('#logbai').html("");
                } else {
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result, function (index, value) {
                        result += resultSearchTransction(stt,value.nick_name, value.action, value.content);
                        stt ++;
                    });
                    $('#logbai').html(result);
                }

            }, error: function () {
                $('#logbai').html("");
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })

    })

    function resultSearchTransction(stt,nickname,action, content) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + action + "</td>";
        rs += "<td>" + content + "</td>";
        rs += "</tr>";
        return rs;
    }
</script>