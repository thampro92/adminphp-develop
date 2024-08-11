<?php

class UserLive_model extends MY_Model
{
    public $table = 'result_tai_xiu';
    var $key = 'id';
    // Order mac dinh (VD: $order = array('id', 'desc))
    var $order = '';
    // Cac field select mac dinh khi get_list (VD: $select = 'id, name')
    var $select = '';

    function __construct()
    {
        parent::__construct();
        $this->db1 = $this->load->database('vinplay', TRUE);
    }

    function  get_list_user($nn, $ft, $et){
        $this->db1->select('`users`.`id`, `users`.`user_name`, `users`.`nick_name`, `users`.`password`, `users`.`email`, `users`.`google_id`, `users`.`facebook_id`, `users`.`mobile`, `users`.`identification`, `users`.`avatar`, `users`.`birthday`, `users`.`gender`, `users`.`address`, `users`.`vin`, `users`.`xu`, `users`.`vin_total`, `users`.`xu_total`, `users`.`safe`, `users`.`recharge_money`, `users`.`vip_point`, `users`.`vip_point_save`, `users`.`money_vp`, `users`.`dai_ly`, `users`.`status`, `users`.`create_time`, `users`.`security_time`, `users`.`login_otp`, `users`.`is_bot`, `users`.`update_pw_time`, `users`.`client`, `users`.`manual_quota`, `users`.`is_verify_mobile`, `users`.`referral_code`, `users`.`t_nap`, `users`.`t_rut`, `users`.`rut_times`, `users`.`nap_times`, `users`.`last_login`, `users`.`usertype`, `users`.`telegram_id`, `users`.`parrentUser`');
        $this->db1->from('`vinplay`.`users`');
        if ($nn != "") {
            $this->db1->where('cgame.users.nickname', $nn);
        }

        $this->db1->where("`users`.`usertype` = 10");

        if (isset($ft) && isset($et)) {
            $time = get_time_between_day($ft, $et);
            $this->db1->where("DATE_FORMAT(`vinplay`.`users`.`create_time`, '%Y-%m-%d') BETWEEN " . "'" . $time['start'] . "'" . "AND " . "'" . $time['end'] . "'");
        }
        $this->db1->order_by('id', 'desc');

        $query = $this->db1->get();
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }


}
