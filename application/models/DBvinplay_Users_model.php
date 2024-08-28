<?php

class DBvinplay_Users_model extends MY_Model
{
    var $table = 'users';
    var $key = 'id';

    function __construct()
    {
        parent::__construct();
        $this->db_vinplay = $this->load->database('vinplay', TRUE);
    }

    function create($data = array())
    {
        if ($this->db_vinplay->insert($this->table, $data)) {
            $this->log_activities($data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update($id, $data)
    {
        if (!$id) {
            return FALSE;
        }

        $where = array();
        $where[$this->key] = $id;
        $this->update_rule($where, $data);

        return TRUE;
    }

    function updateByUsername($username, $data)
    {
        if (!$username) {
            return FALSE;
        }

        $where = array();
        $where["user_name"] = $username;
        $this->update_rule($where, $data);

        return TRUE;
    }

    function update_rule($where, $data)
    {
        if (!$where) {
            return FALSE;
        }
        $this->db_vinplay->where($where);
        $this->db_vinplay->update($this->table, $data);
        $this->log_activities($data, $where, $this->db_vinplay->database);
        return TRUE;
    }

    /**
     * Kiểm tra đăng nhập dựa trên user_name và md5(password)
     * @param string $username
     * @param string $password
     * @return mixed Trả về một dòng của bảng users nếu thông tin đúng, ngược lại trả về FALSE
     */
    function check_login($username, $hashed_password)
    {
        if (!$username || !$hashed_password) {
            return FALSE;
        }

        // Điều kiện tìm kiếm trong cơ sở dữ liệu
        $this->db_vinplay->where('user_name', $username);
        $this->db_vinplay->where('password', $hashed_password);

        // Thực hiện truy vấn
        $query = $this->db_vinplay->get($this->table);

        // Nếu tìm thấy 1 kết quả
        if ($query->num_rows() == 1) {
            $user = $query->row(); // Trả về dòng dữ liệu
            return [
                "address" => $user->address,
                "appSecure" => 0,
                "avatar" => "0",
                "birthday" => "",
                "certificate" => false,
                "createTime" => "31-07-2022",
                "daiLy" => 100,
                "email" => 0,
                "ipAddress" => "",
                "luckyRotate" => 0,
                "mobileSecure" => intval($user->is_verify_mobile),
                "nickname" => "qtrigame1",
                "username" => "qtrigame1",
                "verifyMobile" => false,
                "vinTotal" => 0,
                "vippoint" => 0,
                "vippointSave" => 0,
                "xuTotal" => 0
            ];
        } else {
            return FALSE; // Không tìm thấy kết quả phù hợp
        }
    }
}