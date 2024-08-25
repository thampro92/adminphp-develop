<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_menu_sbo extends CI_Migration
{
    public function up()
    {
        $data = $this->db->select('id')->where('link', 'loggamethirdparty')->where('Parrent_ID', -1)->get('cms_menu')->row();
        if (!$data) {
            return;
        }
        $data = array(
            'Name' => 'SBO',
            'Param' => '10',
            'Link' => 'loggamethirdparty/sbo',
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
        $this->db->delete('cms_menu', array('Link' => 'loggamethirdparty/sbo'));
    }
}