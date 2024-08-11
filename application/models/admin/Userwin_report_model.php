<?php

class Userwin_report_model extends MY_Model
{
    var $table = 'log_money_user_vin';

    function search($nickName, $toDate, $fromDate, $game, $transId, $page, $page_size)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $page = intval($page);
        $page_size = intval($page_size);

        $options = [
            "projection" => ["_id" => 0],
            'skip' => ($page - 1) * $page_size,
            'limit' => $page_size,
            'sort' => ['trans_time' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $fromDate = "2024-07-09 15:12:29";
        $toDate = "2024-08-09 23:12:29";

        $conds = [];
        if (strlen($fromDate)) {
            $conds[] = ['trans_time' => ['$gte' => $fromDate]];
        }

        if (strlen($toDate)) {
            $conds[] = ['trans_time' => ['$lte' => $toDate]];
        }

        if (strlen($nickName)) {
            $conds[] = ['nick_name' => $nickName];
        }

        if (strlen($game)) {
            $conds[] = ['game' => $game];
        }

        if (strlen($transId)) {
            $conds[] = ['trans_id' => $transId];
        }

        $filter = [];
        if (count($conds)) {
            $filter = [
                '$and' => $conds
            ];
        }

        $results = $this->mongodb_library->find($filter, $options);
        $total = $this->mongodb_library->countDocuments($filter);
        return [
            'success' => true,
            'data' => $results,
            'errorCode' => null,
            'message' => "success",
            'totalBet' => 0,
            'totalData' => $total,
            'totalFee' => 0,
            'totalSoVongcuoc' => 0
        ];
    }
}