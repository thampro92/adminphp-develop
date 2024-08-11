<?php $this->load->view('admin/admin/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Sửa đánh dấu tài khoản</h6>
        </div>
        <div id="form" class="form">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
            <fieldset>
                <div class="formRow">
                    <label for="param_username" class="formLeft">Nickname:<span class="req"></span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $nn; ?>" name="nn" id="nn"></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_username" class="formLeft">Số tài khoản:<span class="req"></span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $stk; ?>" name="stk" id="stk"></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_pass" class="formLeft">Màu đánh dấu:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><select id="type" name="type"
                                                     class="my-input-class">
                                    <option value="1" <?php if($this->input->get('type') == "1"){echo "selected";} ?>>Đỏ</option>
                                    <option value="2" <?php if($this->input->get('type') == "2"){echo "selected";} ?>>Vàng</option>
                                </select></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_username" class="formLeft">Lý do đánh dấu:<span class="req"></span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $comment; ?>" name="comment" id="comment"></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </div>
        <div class="formSubmit">
            <input type="submit" id="AddUser" value="Cập Nhật" class="button blueB"
                   style="margin-left: 70px">
            <input type="submit"
                   onclick="window.location.href = '<?php echo admin_url('withdraw/usercheck') ?>'; "
                   value="Quay lại" class="basic" style="margin-left: 20px">
        </div>
    </div>
</div>

<script>
    document.getElementById("AddUser").addEventListener("click", saveUser);

    function saveUser() {
        let nn = $("#nn").val();
        let stk = $("#stk").val();
        let type = $("#type").val();
        let comment = $("#comment").val();

        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('withdraw/addusercheckajax')?>",
            data: {
                nn: nn,
                stk: stk,
                type: type,
                comment : comment,
                update_type: 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.response <= 0) {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html(result.mes);
                } else {
                    window.location.href = "<?php echo admin_url('withdraw/usercheck')?>";
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        });

    }

</script>