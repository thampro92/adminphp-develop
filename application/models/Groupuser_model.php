<?php
Class GroupUser_model extends MY_Model
{
    var $table = 'cms_group_user';

    public function getByName($name)
    {
        $query = $this->db->select('Id, Name')
            ->where('Name', $name)
            ->get($this->table);
        return $query->row();
    }
}