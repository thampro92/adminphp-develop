<?php

class Userlogin_usergame_model extends MY_Model
{
    var $table = 'user_log_logins';

    function search($nickname, $iplogin, $devicelogin, $toDate, $fromDate, $status, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $page = intval($pages);
        $pageSize = 50;


        $options = [
            "projection" => [
                "_id" => 0
            ],
            'skip' => ($page - 1) * $pageSize,
            'limit' => $pageSize,
            'sort' => ['trans_time' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $conds = [];
        if (strlen($fromDate)) {
            $conds[] = ['time_log' => ['$gte' => $fromDate]];
        }

        if (strlen($toDate)) {
            $conds[] = ['time_log' => ['$lte' => $toDate]];
        }

        if (strlen($nickname)) {
            $conds[] = ['nick_name' => $nickname];
        }

        if (strlen($iplogin)) {
            $conds[] = ['ip' => $iplogin];
        }

        if (strlen($devicelogin)) {
            $conds[] = ['agent' => $devicelogin];
        }

        if (intval($status)) {
            $conds[] = ['type' => intval($status)];
        }

        $filter = [];
        if (count($conds)) {
            $filter = [
                '$and' => $conds
            ];
        }

        $results = $this->mongodb_library->find($filter, $options);
        foreach ($results as &$result){
            $result['security'] = false;
            if (isset($result['time_log'])) {
                $result['time_log'] = $result['time_log']->toDateTime()->format('Y-m-d H:i:s');
            }
        }

        $total = $this->mongodb_library->countDocuments($filter);

        return [
            'success' => true,
            'data' => null,
            'errorCode' => "0",
            'transactions' => $results,
            'message' => null,
            'total' => ceil($total / $pageSize),
            'totalRecord' => $total,
            'user' => []
        ];
    }
}