<?php

class Uservinplay_usergame_model extends MY_Model
{
    var $table1 = 'deposit_paygate';
    var $table2 = 'withdrawal_paygate';
    var $table3 = 'vip_bonus';

    function search($username, $nickname, $phone, $fieldname, $timkiemtheo, $toDate, $fromDate, $typetaikhoan, $pages, $record, $typetk, $email, $refcode)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table1);

        $fromDate = "2023-10-22 00:30:55";
        $toDate = "2023-10-22 23:30:55";
        //Lay ds nickname o 2 bang 1,2
        $filter = [
            '$and' => [
                ['CreatedAt' => ['$gte' => $fromDate]],
                ['CreatedAt' => ['$lte' => $toDate]]
            ]
        ];

        $options = ["projection" => ["_id" => 0, 'Username' => 1, 'Nickname' => 1]];

        $depositAccounts = $this->getAccounts($this->table1, $filter, $options);
        $withdrawalAccounts = $this->getAccounts($this->table2, $filter, $options);
        $accounts = $this->mergeUnique($depositAccounts, $withdrawalAccounts);

        foreach ()


    }

    protected function getAccounts($table, $filter, $options)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($table);

        return $this->mongodb_library->find($filter, $options);
    }

    protected function mergeUnique($array1, $array2)
    {
        if (!is_array($array1))
            $array1 = [];

        if (!is_array($array2))
            $array2 = [];

        // Tạo một mảng kết hợp từ mảng 1
        $merged = $array1;

        // Duyệt qua từng phần tử của mảng 2
        foreach ($array2 as $item2) {
            $isUnique = true;

            // Kiểm tra xem phần tử trong mảng 2 có trùng với phần tử trong mảng 1 không
            foreach ($array1 as $item1) {
                if ($item1['Username'] === $item2['Username'] && $item1['Nickname'] === $item2['Nickname']) {
                    $isUnique = false;
                    break;
                }
            }

            // Nếu không trùng, thêm vào mảng kết hợp
            if ($isUnique) {
                $merged[] = $item2;
            }
        }

        return $merged;
    }
}