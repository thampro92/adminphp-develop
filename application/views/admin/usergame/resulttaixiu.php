<div>
    <h4 id="taixiuResultsearch" style="color: red;margin-left: 20px"></h4>
	<?php if ($admin_info->Status == "A"): ?>
      <div class="title">
          <h4>SET RESULT TÀI XỈU<span style="color: #0000FF"></span></h4>
      </div>
      <div class="formRow">
          <div class="row">
              <div class="col-sm-1">
                  <label class="nickname">Result:</label>
              </div>
              <div class="col-sm-2">
                  <input type="text" class="form-control" id="taixiuResult">
              </div>
          </div>
      </div>
      <div class="formRow">
          <div class="row">
              <div class="col-sm-1">
                  <input type="button" id="taixiu" value="Set Result" class="button blueB">
              </div>
          </div>
      </div>

      <div class="title">
          <h6 class="title-jackpot">Result tài xỉu</h6>
      </div>
      <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck">
          <thead>
          <tr>
              <td style="min-width: 700px">Result</td>
              <td>Hành động</td>
          </tr>
          </thead>
          <tbody id="taixiuLogaction">
          <tr>
              <td id="taixiuResultData"></td>
              <td><a href="" id="taixiu-icon" class="tipS reject-action verify_action text-danger btn-circle"> <i
                              class="fa fa-times" aria-hidden="true"></i></a></td>
          </tr>
          </tbody>
      </table>
	<?php else: ?>
      <div class="title">
          <h4>Bạn không được phân quyền</h4>
      </div>
	<?php endif; ?>
</div>

<style>
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
    }

    #taixiu {
        margin-left: -2px;
    }

    .title .title-jackpot {
        margin-left: -10px;
    }

    .nickname {
        margin-left: -4px;
    }
</style>
<div id="taixiuSpinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>

<script>
    $("#taixiu").click(function () {
        if ($("#taixiuResult").val() == "") {
            alert("vui lòng nhập Result");
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('usergame/setresulttaixiuajax')?>",
                data: {
                    result: $("#taixiuResult").val(),
                }, dataType: 'json',
                success: function (result) {
                    $("#taixiuSpinner").hide();
                    $("#taixiuResultsearch").html("");
                    window.location = '<?php echo admin_url('usergame/setresult') ?>';
                }, error: function (xhr) {
                    window.location = '<?php echo admin_url('login') ?>';
                }
            });
        }
    });

    $(document).ready(function () {
        listresulttaixiu()
    });

    function listresulttaixiu() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/listresulttaixiuajax')?>",
            data: {},
            dataType: 'json',
            success: function (result) {
                if (result.data == null) {
                    $("#taixiuResultsearch").html("Không tìm thấy kết quả");
                    $('#taixiuLogaction').hide();
                } else {
                    var rs = result.data[0] + ',' + result.data[1] + ',' + result.data[2];
                    $('#taixiuLogaction').show();
                    $("#taixiuResultData").html(rs);
                    removetaixiu();
                }
            }, error: function () {
                $('#taixiuLogaction').html("");
                $("#taixiuSpinner").hide();
            }, timeout: 40000
        });
    }

    function removetaixiu() {
        $("#taixiu-icon").click(function () {
            if (confirm("Bạn có chắc chắn xóa không?")) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('usergame/deleteresulttaixiuajax')?>",
                    data: {},
                    dataType: 'json',
                    success: function (result) {
                    }, error: function () {
                        $('#taixiuLogaction').html("");
                        $("#taixiuSpinner").hide();
                    }, timeout: 40000
                });
            }
        });
    }
</script>