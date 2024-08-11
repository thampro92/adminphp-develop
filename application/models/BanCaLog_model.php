<?php

class BanCaLog_model extends MY_Model
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
        $this->db1 = $this->load->database('cgame', TRUE);
    }

    function  get_log_banca($nn, $ft, $et){
        $this->db1->select('cgame.bc_trans_log.Id, cgame.bc_trans_log.UserId, cgame.bc_trans_log.Time, cgame.bc_trans_log.Cash, cgame.bc_trans_log.CashGain, cgame.bc_trans_log.Extra, cgame.users.nickname');
        $this->db1->from('cgame.users');
        $this->db1->join('cgame.bc_trans_log','cgame.users.user_id = cgame.bc_trans_log.UserId');
        if ($nn != "") {
            $this->db1->where('cgame.users.nickname', $nn);
        }

        if (isset($ft) && isset($et)) {
            $time = get_time_between_day($ft, $et);
            $this->db1->where("DATE_FORMAT(`cgame`.`bc_trans_log`.`Time`, '%Y-%m-%d') BETWEEN " . "'" . $time['start'] . "'" . "AND " . "'" . $time['end'] . "'");
        }
        $this->db1->order_by('Time', 'desc');

        $query = $this->db1->get();
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function  get_log_lode($nn, $ft, $et){
        $this->db1->select('cgame.loto_request.Id, cgame.loto_request.TimePlay, cgame.loto_request.GameMode,cgame.loto_request.TimePlay,cgame.loto_request.Number, cgame.loto_request.Pay,cgame.loto_request.PayRate, cgame.loto_request.Win, cgame.users.nickname');
        $this->db1->from('cgame.users');
        $this->db1->join('cgame.loto_request','cgame.users.user_id = cgame.loto_request.Username');
        if ($nn != "") {
            $this->db1->where('cgame.users.nickname', $nn);
        }

        if (isset($ft) && isset($et)) {
            $time = get_time_between_day($ft, $et);
            $this->db1->where("DATE_FORMAT(`cgame`.`loto_request`.`TimePlay`, '%Y-%m-%d') BETWEEN " . "'" . $time['start'] . "'" . "AND " . "'" . $time['end'] . "'");
        }
        $this->db1->order_by('TimePlay', 'desc');

        $query = $this->db1->get();
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }

}