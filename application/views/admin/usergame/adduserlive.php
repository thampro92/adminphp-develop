<?php $this->load->view('admin/admin/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Thêm mới User Live</h6>
        </div>
        <div id="form" class="form">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
            <fieldset>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Username:<span class="req">*</span></label>

                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('username') ?>" name="username" id="username"></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_username" class="formLeft">Nickname:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('fullname') ?>" name="fullname" id="fullname"></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_pass" class="formLeft">Password:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="password" _autocheck="true" value="<?php echo set_value('Password') ?>"  name="Password" id="Password"></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </div>
        <div class="formSubmit">
            <input type="submit" id="AddUser" value="Thêm Mới" class="button blueB"
                   style="margin-left: 70px">
        </div>
    </div>
</div>

<script>
    document.getElementById("AddUser").addEventListener("click", saveUser);

    function saveUser() {
        let un = $("#username").val();
        let nn = $("#fullname").val();
        let pas = $("#Password").val();

        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/adduserliveajax')?>",
            data: {
                un: un,
                nn: nn,
                pas: pas
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.response <= 0) {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html(result.mes);
                } else {
                    window.location.href = "<?php echo admin_url('usergame/userlive')?>";
                }

            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("Hệ thống quá tải. Vui lòng gọi 19008698 hoặc F5 lại pages");
            }, timeout: 20000
        });

    }

</script>