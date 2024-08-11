<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Maketting</h5>
        </div>
        <div class="horControlB menu_action">
            <ul>
                <li>
                    <a href="<?php echo admin_url('banner') ?>">
                        <img src="<?php echo public_url('admin') ?>/images/icons/control/16/list.png">
                        <span>Danh sách</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="wrapper return-url">
    <a class="" href="<?= admin_url('banner')?>">
        <i class="fas fa-angle-double-left"></i> Quay lại
    </a>
</div>
<div class="wrapper">
    <div class="widget backaccount">
        <section class="content-header">
            <h1>
                Thêm banner
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form class="box">
                        <div class="box-body">
                            <div class="form-group successful">
                                <div class="row">
                                    <label class="control-label col-sm-2 text-danger" id="errorgift"></label>
                                </div>
                                <div class="row">
                                    <label class="control-label col-sm-2 text-success" id="success-gift"></label>
                                </div>
                            </div>
                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-1 control-label" for="inputGiftCode">Tên: (*)</label>
                                    <input class="col-sm-3 form-control" type="text" id="title" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-1 control-label" for="inputType">Path: (*)</label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <input class="form-control" type="text" id="path" name="path">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-1 control-label" for="inputType">Action: </label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <input class="form-control" type="number" id="action" name="action">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-1 control-label" for="inputType">Url: </label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <input class="form-control" type="text" id="url" name="url">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="submit" value="Thêm mới" name="submit" class="btn btn-primary" id="add_banner">
                                        <input type="reset" value="Reset" name="submit" style="min-width: 120px"
                                               class="btn btn-primary ml-3" id="reset"
                                               onclick="window.location.href ='<?php echo admin_url('banner/create') ?>';">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>
<style>
</style>
<script>
    $(document).ready(function (){
        $("#reset").on('click', function (e){
            reset()
        })
    })

    function reset() {
        $(this).find("input").val('')
    }

    $("#add_banner").click(function (e) {
        e.preventDefault()
        if(!$("#title").val() || !$("#title").val()) {
            $('#errorgift').html('Nhập đầy đủ các trường bắt buộc');
            return;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?= admin_url('banner/createAjax') ?>",
            data: {
                tt: $("#title").val(),
                ip: $("#path").val(),
                url: $("#url").val(),
                ac: $("#action").val()
            },
            dataType: 'json',
            success: function (response) {
                $("#spinner").hide();
                if (response.success) {
                    reset()
                    $('#success-gift').html('Thêm banner thành công');
                    window.location.href = '<?= admin_url('banner') ?>'
                } else {
                    $("#errorgift").html(response.message)
                }
            }, error: function () {
                $("#spinner").hide();
                $("#errorgift").html("Hệ thống quá tải. Vui lòng thử lại!");
            }, timeout: 60000
        })
    });
</script>
