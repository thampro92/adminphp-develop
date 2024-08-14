<?php

class Loggamebai_model extends MY_Model
{
    var $coreDB = "DBCoreLog";
    var $table1 = 'log_cao_thap';
    var $table2 = 'rong_ho_results';
    var $table3 = 'rong_ho_transactions';

    function loggamebaisam($transid, $nickname, $fromDate, $toDate, $moneyType, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table1);

//        $fromDate = "2022-09-12 00:00:00";
//        $toDate = "2022-09-19 23:59:59";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . '+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . '+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 50;

        $projection = [
            "_id" => 0,
            "tran_id" => '$trans_id',
            "nickName" => '$nick_name',
            "pot_bet" => 1,
            "step" => 1,
            "bet_value" => 1,
            "result" => 1,
            "prize" => 1,
            "cards" => 1,
            "current_pot" => 1,
            "current_fund" => 1,
            "money_type" => 1,
            "time_log" => 1
        ];

        $options = [
            "projection" => $projection,
            'skip' => ($page - 1) * $maxItem,
            'limit' => $maxItem,
            'sort' => ['create_time' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $conds = [
            ['create_time' => ['$gte' => $startTime, '$lt' => $endTime]],
        ];

        if (strlen($transid)) {
            $conds[] = ['trans_id' => intval($transid)];
        }

        if (strlen($nickname)) {
            $conds[] = ['nick_name' => $nickname];
        }

        if (strlen($moneyType) && intval($moneyType)) {
            $conds[] = ['money_type' => intval($moneyType)];
        }

        $filter = [];
        if (count($conds)) {
            $filter = [
                '$and' => $conds
            ];
        }

        $results = $this->mongodb_library->find($filter, $options);
        $total = $this->mongodb_library->countDocuments($filter);

        $pipeline = [
            [
                '$match' => $filter
            ],
            [
                '$group' => [
                    '_id' => null,
                    'distinctNickNames' => ['$addToSet' => '$nick_name']
                ]
            ],
            [
                '$project' => [
                    '_id' => 0,
                    'distinctNickNameCount' => ['$size' => '$distinctNickNames']
                ]
            ]
        ];

        $result2 = $this->mongodb_library->aggregate($pipeline);

        return [
            'data' => null,
            'errorCode' => "0",
            'message' => null,
            'success' => true,
            'total' => ceil($total / $maxItem),
            'totalPalyers' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0,
            'totalRecord' => $total,
            'transactions' => $results
        ];
    }

    function loggame($fromDate, $toDate, $nickname, $namegame, $sid, $money, $pages)
    {

    }
}