<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_menu_log_chiem_tinh extends CI_Migration
{
    public function up()
    {
        $data = $this->db->select('id')->where('link', 'loggameslot')->where('Parrent_ID', -1)->get('cms_menu')->row();
        if (!$data) {
            return;
        }
        $data = array(
            'Name' => 'Chiêm tinh',
            'Param' => '20',
            'Link' => 'loggameslot/chiemtinh',
            'Status' => 'A',
            'Parrent_ID' => $data->id,
            'isThuong' => '1',
            'isDaily' => '0',
            'isSuper' => '0',
        );
        $this->db->insert('cms_menu', $data);
    }

    public function down()
    {
        $this->db->delete('cms_menu', array('Link' => 'loggameslot/chiemtinh'));
    }
}