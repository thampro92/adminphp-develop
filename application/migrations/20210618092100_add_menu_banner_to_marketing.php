<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_menu_banner_to_marketing extends CI_Migration
{
    public function up()
    {
        $data = $this->db->select('id')->where('link', 'marketing')->where('Parrent_ID', -1)->get('menu')->row();
        if (!$data) {
            return;
        }
        $data = array(
            'Name' => 'Danh sách banner',
            'Param' => '10',
            'Link' => 'banner',
            'Status' => 'A',
            'Parrent_ID' => $data->id,
            'isThuong' => '1',
            'isDaily' => '0',
            'isSuper' => '0',
        );
        $this->db->insert('menu', $data);
    }

    public function down()
    {
        $this->db->delete('menu', array('Link' => 'banners'));
    }
}