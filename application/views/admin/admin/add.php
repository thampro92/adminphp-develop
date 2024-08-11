<!-- head -->
<?php $this->load->view('admin/admin/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Thêm mới người dùng</h6>
        </div>
        <form id="form" class="form" enctype="multipart/form-data" method="post" action="<?= admin_url('admin/create')?>">
            <fieldset>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Username:<span class="req">*</span></label>

                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo set_value('username') ?>" name="username"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('username') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_username" class="formLeft">Nickname:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('fullname') ?>" id="param_username" name="fullname"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('fullname') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Bộ phận:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"> <select for="inputEmail3" id="selectchucnang" name="typeaccount">
                                <option value="W">Vận hành</option>
                                <option value="LM">Leader Maketing</option>
                                <option value="M">Maketing</option>
                                <option value="S">Chăm sóc khách hàng</option>
                                <option value="LS">Chăm sóc khách hàng leader</option>
                                <option value="L">Lãnh đạo</option>
                                <option value="D">Chăm sóc đại lý</option>
                                <option value="Q">Quản lý chung</option>
                                <option value="K">Kế toán</option>
                                <option value="C">Developer</option>
                                <option value="A">Admin</option>
                            </select></span>
                        <div class="clear error" name="name_error"><?php echo form_error('typeaccount') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formSubmit">
                    <input type="submit" class="redB" value="Thêm mới">
                </div>
            </fieldset>
        </form>
    </div>
</div>