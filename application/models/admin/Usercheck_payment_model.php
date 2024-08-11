<?php

class Usercheck_payment_model extends MY_Model
{
    var $table = 'warning_account';

    function search($type, $nickName, $stk, $toDate, $fromDate, $pages, $record)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $pages = intval($pages);
        $record = intval($record);

        $options = [
            "projection" => [
                "_id" => 0
            ],
            'skip' => ($pages - 1) * $record,
            'limit' => $record,
            'sort' => ['create_time' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $conds = [];
        if (strlen($fromDate)) {
            $conds[] = ['create_time' => ['$gte' => $fromDate]];
        }

        if (strlen($toDate)) {
            $conds[] = ['create_time' => ['$lte' => $toDate]];
        }

        if (strlen($nickName)) {
            $conds[] = ['nick_name' => $nickName];
        }

        if (intval($type)) {
            $conds[] = ['type' => intval($type)];
        }

        if (strlen($stk)) {
            $conds[] = ['bank_number' => $stk];
        }

        $filter = [];
        if (count($conds)) {
            $filter = [
                '$and' => $conds
            ];
        }

        $results = $this->mongodb_library->find($filter, $options);

        return (array)$results;
    }
}