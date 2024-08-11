<?php
Class Utmsource_model extends MY_Model
{
    public $table = 'utm_source';

    var $key = 'id';
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
}