<?php
Class Usergame_model extends MY_Model
{
   public $table = 'users';
    var $key = 'id';
    var $keynn = 'nick_name';
    // Order mac dinh (VD: $order = array('id', 'desc))
    var $order = '';
    // Cac field select mac dinh khi get_list (VD: $select = 'id, name')
    var $select = '';
    function __construct(){
        parent::__construct();
         $this->db1 = $this->load->database('vinplay',TRUE);
    }
    function get_total_game($input = array())
    {
        $this->get_list_set_input_game($input);
        $query = $this->db1->get($this->table);
        return $query->num_rows();
    }
    function get_list_game($input = array())
    {
        //xu ly ca du lieu dau vao
        $this->get_list_set_input_game($input);
        //thuc hien truy van du lieu
        $query = $this->db1->get($this->table);
        return $query->result();
    }



    function deleteTelegramUser($nn)
    {
        if (!$nn)
        {
            return FALSE;
        }
        $sql = "UPDATE `vinplay`.`users` SET `mobile` = '', `is_verify_mobile` = 0, `telegram_id` = '' WHERE `nick_name`='".$nn."'" ;
        if ($this->db1->query($sql) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

function deleteBalance($nn)
    {
        if (!$nn)
        {
            return FALSE;
        } 
        $sql = "UPDATE `vinplay`.`users` SET `vin` = 0, `vin_total` = 0 WHERE `nick_name`='".$nn."'" ;
        if ($this->db1->query($sql) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function  get_log_freezemoney($nn){
        $this->db1->select('vinplay.freeze_money.id, vinplay.freeze_money.session_id, vinplay.freeze_money.user_id, vinplay.freeze_money.nick_name, vinplay.freeze_money.game_name, vinplay.freeze_money.room_id, vinplay.freeze_money.money, vinplay.freeze_money.create_time');
        $this->db1->from('vinplay.freeze_money');
        $this->db1->where('vinplay.freeze_money.status',1);
        $this->db1->where("`vinplay`.`freeze_money`.`money` > 0");

        if ($nn != "") {
            $this->db1->where('vinplay.freeze_money.nick_name', $nn);
        }

        $this->db1->order_by('create_time', 'desc');

        $query = $this->db1->get();


        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }



    /**
     * Gan cac thuoc tinh trong input khi lay danh sach
     * $input : mang du lieu dau vao
     */

    protected function get_list_set_input_game($input = array())
    {
        // Thêm điều kiện cho câu truy vấn truyền qua biến $input['where']
        //(vi du: $input['where'] = array('email' => 'hocphp@gmail.com'))
        if ((isset($input['where'])) && $input['where'])
        {
            $this->db1->where($input['where']);
        }
        //tim kiem like
        // $input['like'] = array('name' , 'abc');
        if ((isset($input['like'])) && $input['like'])
        {
            $this->db1->like($input['like'][0], $input['like'][1]);
        }
        // Thêm sắp xếp dữ liệu thông qua biến $input['order']
        //(ví dụ $input['order'] = array('id','DESC'))
        if (isset($input['order'][0]) && isset($input['order'][1]))
        {
            $this->db1->order_by($input['order'][0], $input['order'][1]);
        }
        else
        {
            //mặc định sẽ sắp xếp theo id giảm dần
            $order = ($this->order == '') ? array($this->table.'.'.$this->key, 'desc') : $this->order;
            $this->db1->order_by($order[0], $order[1]);
        }

        // Thêm điều kiện limit cho câu truy vấn thông qua biến $input['limit']
        //(ví dụ $input['limit'] = array('10' ,'0'))
        if (isset($input['limit'][0]) && isset($input['limit'][1]))
        {
            $this->db1->limit($input['limit'][0], $input['limit'][1]);
        }
    }
    function update($id, $data)
    {
        if (!$id)
        {
            return FALSE;
        }
        $where = array();
        $where[$this->key] = $id;
        $this->update_rule($where, $data);
        return TRUE;
    }
    function update_rule($where, $data)
    {
        if (!$where)
        {
            return FALSE;
        }
        $this->db1->where($where);
        $this->db1->update($this->table, $data);
        $this->log_activities($data, $where, $this->db1->database);
        return TRUE;
    }
    function get_info($id, $field = '')
    {
        if (!$id)
        {
            return FALSE;
        }
        $where = array();
        $where[$this->key] = $id;
        return $this->get_info_rule($where, $field);
    }
    /**
     * Lay thong tin cua row tu dieu kien
     * $where: Mảng điều kiện
     * $field: Cột muốn lấy dữ liệu
     */
    function get_info_rule($where = array(), $field= '')
    {
        if($field)
        {
            $this->db1->select($field);
        }
        $this->db1->where($where);
        $query = $this->db1->get($this->table);
        if ($query->num_rows())
        {
            return $query->row();
        }
        return FALSE;
    }

    function  get_info_daily($username){

        $this->db1->where('user_name',$username);
        $query = $this->db1->get($this->table);
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    function  get_info_nickname($username){

        $this->db1->where('nick_name',$username);
        $query = $this->db1->get($this->table);
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    function  get_info_nickname_daily($username){

        $this->db1->where('nick_name',$username);
        $this->db1->where('dai_ly',0);
        $query = $this->db1->get($this->table);
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function search($query_array,$limit,$offset,$sort_by,$sort_order){
        $sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
        $sort_column = array('create_time','user_name','nick_name','vin_total','id');
        $sort_by = (in_array($sort_by,$sort_column))? $sort_by : 'id';
        $q =    $this->db1->select('*')
            ->from('users')
        ->limit($limit,$offset)
        ->order_by($sort_by,$sort_order);
        if(strlen($query_array['name'])){
            $q->like('user_name',$query_array['name']);
        }
        if(strlen($query_array['nickname'])){
            $q->like('nick_name',$query_array['nickname']);
        }
        if(strlen($query_array['sdt'])){
            $q->like('mobile',$query_array['sdt']);
        }
        $ret['rows'] = $q->get()->result();
        $q = $this->db1->select('COUNT(*) as count',FALSE)
            ->from('users');
        if(strlen($query_array['name'])){
            $q->like('user_name',$query_array['name']);
        }
        if(strlen($query_array['nickname'])){
            $q->like('nick_name',$query_array['nickname']);
        }
        if(strlen($query_array['sdt'])){
            $q->like('mobile',$query_array['sdt']);
        }
        $tmp = $q->get()->result();
        $ret['num_rows'] = $tmp[0]->count;
        return $ret;
    }

    function  get_list_user_live($nn, $ft, $et){
        $this->db1->select('`users`.`id`, `users`.`user_name`, `users`.`nick_name`, `users`.`password`, `users`.`email`, `users`.`google_id`, `users`.`facebook_id`, `users`.`mobile`, `users`.`identification`, `users`.`avatar`, `users`.`birthday`, `users`.`gender`, `users`.`address`, `users`.`vin`, `users`.`xu`, `users`.`vin_total`, `users`.`xu_total`, `users`.`safe`, `users`.`recharge_money`, `users`.`vip_point`, `users`.`vip_point_save`, `users`.`money_vp`, `users`.`dai_ly`, `users`.`status`, `users`.`create_time`, `users`.`security_time`, `users`.`login_otp`, `users`.`is_bot`, `users`.`update_pw_time`, `users`.`client`, `users`.`manual_quota`, `users`.`is_verify_mobile`, `users`.`referral_code`, `users`.`t_nap`, `users`.`t_rut`, `users`.`rut_times`, `users`.`nap_times`, `users`.`last_login`, `users`.`usertype`, `users`.`telegram_id`, `users`.`parrentUser`');
        $this->db1->from('`vinplay`.`users`');
        if (!empty($nn)) {
            $this->db1->where('`vinplay`.`users`.`nick_name`', $nn);
        }

        $this->db1->where("`vinplay`.`users`.`usertype` = 2");

        if (!empty($ft) && !empty($et)) {
            $time = get_time_between_day($ft, $et);
            $this->db1->where("DATE_FORMAT(`vinplay`.`users`.`create_time`, '%Y-%m-%d') BETWEEN " . "'" . $time['start'] . "'" . "AND " . "'" . $time['end'] . "'");
        }
        $this->db1->order_by('`vinplay`.`users`.`id`', 'desc');

        $query = $this->db1->get();

        if($query->result())
        {
            return $query->result();
        }else{
            return array();
        }
    }
    function create($data = array())
    {
        if($this->db1->insert($this->table, $data))
        {
            $this->log_activities($data);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function checknickname($nn)
    {
        $this->db1->select('`users`.`id`, `users`.`user_name`, `users`.`nick_name`, `users`.`password`, `users`.`email`, `users`.`google_id`, `users`.`facebook_id`, `users`.`mobile`, `users`.`identification`, `users`.`avatar`, `users`.`birthday`, `users`.`gender`, `users`.`address`, `users`.`vin`, `users`.`xu`, `users`.`vin_total`, `users`.`xu_total`, `users`.`safe`, `users`.`recharge_money`, `users`.`vip_point`, `users`.`vip_point_save`, `users`.`money_vp`, `users`.`dai_ly`, `users`.`status`, `users`.`create_time`, `users`.`security_time`, `users`.`login_otp`, `users`.`is_bot`, `users`.`update_pw_time`, `users`.`client`, `users`.`manual_quota`, `users`.`is_verify_mobile`, `users`.`referral_code`, `users`.`t_nap`, `users`.`t_rut`, `users`.`rut_times`, `users`.`nap_times`, `users`.`last_login`, `users`.`usertype`, `users`.`telegram_id`, `users`.`parrentUser`');
        $this->db1->from('`vinplay`.`users`');
        if (!empty($nn)) {
            $this->db1->where('`vinplay`.`users`.`nick_name`', $nn);
        }
        $query = $this->db1->get();

        if($query->result())
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function checkusername($un)
    {
        $this->db1->select('`users`.`id`, `users`.`user_name`, `users`.`nick_name`, `users`.`password`, `users`.`email`, `users`.`google_id`, `users`.`facebook_id`, `users`.`mobile`, `users`.`identification`, `users`.`avatar`, `users`.`birthday`, `users`.`gender`, `users`.`address`, `users`.`vin`, `users`.`xu`, `users`.`vin_total`, `users`.`xu_total`, `users`.`safe`, `users`.`recharge_money`, `users`.`vip_point`, `users`.`vip_point_save`, `users`.`money_vp`, `users`.`dai_ly`, `users`.`status`, `users`.`create_time`, `users`.`security_time`, `users`.`login_otp`, `users`.`is_bot`, `users`.`update_pw_time`, `users`.`client`, `users`.`manual_quota`, `users`.`is_verify_mobile`, `users`.`referral_code`, `users`.`t_nap`, `users`.`t_rut`, `users`.`rut_times`, `users`.`nap_times`, `users`.`last_login`, `users`.`usertype`, `users`.`telegram_id`, `users`.`parrentUser`');
        $this->db1->from('`vinplay`.`users`');
        if (!empty($un)) {
            $this->db1->where('`vinplay`.`users`.`user_name`', $un);
        }
        $query = $this->db1->get();

        if($query->result())
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function updateUserLive($nn, $data)
    {
        if (!$nn)
        {
            return FALSE;
        }
        $where = array();
        $where[$this->keynn] = $nn;
        $this->update_rule($where, $data);
        return TRUE;
    }

    function deleteUserLive($nn)
    {
        if (!$nn)
        {
            return FALSE;
        }
        $sql = "UPDATE vinplay.users SET usertype = '0' WHERE nick_name='".$nn."'" ;
        if ($this->db1->query($sql) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function deleteUserBanks($id)
    {
        if (!$id)
        {
            return FALSE;
        }

        $sql = "DELETE FROM vinplay.users_bank WHERE id='".$id."'" ;
        if ($this->db1->query($sql) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }





}

