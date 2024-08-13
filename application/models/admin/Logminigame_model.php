<?php

class Logminigame_model extends MY_Model
{
    var $coreDB = "DBCoreLog";
    var $table1 = 'tai_xiu_results';
    var $table2 = 'tai_xiu_transactions';
    var $table3 = 'tai_xiu_md5_results';
    var $table4 = 'tai_xiu_md5_transactions';
    var $table5 = 'bau_cua_results';
    var $table6 = 'bau_cua_transaction';
    var $table7 = 'log_mini_poker';

    function lichsutaixiu($phientx, $fromDate, $toDate, $money, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table1);

//        $fromDate = "2024-07-25";
//        $toDate = "2024-07-25";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 50;

        $projection = [
            '_id' => 0,
            'reference_id' => 1,
            'result' => 1,
            'dice1' => 1,
            'dice2' => 1,
            'dice3' => 1,
            'total_tai' => 1,
            'total_xiu' => 1,
            'num_bet_tai' => 1,
            'num_bet_xiu' => 1,
            'total_prize' => 1,
            'total_refund_tai' => 1,
            'total_refund_xiu' => 1,
            'total_revenue' => 1,
            'money_type' => 1,
            'total_jackpot' => 1,
            'game' => 1,
            'status' => 1,
            'timestamp' => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
                ]
            ],
            'timestamp_db' => [
                '$dateToString' => [
                    'format' => '%d-%m-%YT%H:%M:%S',
                    'date' => '$create_time'
                ]
            ]
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

        if (strlen($phientx)) {
            $conds[] = ['reference_id' => intval($phientx)];
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
            'data' => null,
            'errorCode' => null,
            'message' => "success",
            'success' => true,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results
        ];
    }

    function accounttaixiu($phientx, $botType, $fromDate, $toDate, $nickname, $cuadat, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table2);
//
//        $fromDate = "2024-08-05";
//        $toDate = "2024-08-05";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 100;

        $projection = [
            '_id' => 0,
            'referenceId' => '$reference_id',
            'user_id' => 1,
            'user_name' => '$nick_name',
            'bet_value' => 1,
            'bet_side' => 1,
            'total_prize' => 1,
            'total_refund' => 1,
            'total_exchange' => 1,
            'money_type' => 1,
            'crDate' => 1,
            'total_jackpot' => 1,
            'input_time' => 1,
            'game' => 1,
            'status' => 1,
            'fee' => 1,
            'is_bot' => 1,
            'time_log' => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
                ]
            ],
            'timestamp' => [
                '$dateToString' => [
                    'format' => '%d-%m-%YT%H:%M:%S',
                    'date' => '$create_time'
                ]
            ]
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

        if (strlen($phientx)) {
            $conds[] = ['reference_id' => intval($phientx)];
        }

        if (strlen($botType)) {
            $conds[] = ['is_bot' => intval($botType) === 1];
        }

        if (strlen($nickname)) {
            $conds[] = ['nick_name' => $nickname];
        }

        if (strlen($cuadat) && intval($cuadat) !== -1) {
            $conds[] = ['bet_side' => intval($cuadat)];
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
            'errorCode' => null,
            'message' => "success",
            'success' => true,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results,
            'totalPlayer' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0
        ];
    }

    function taixiumd5($phientx, $fromDate, $toDate, $money, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table3);

//        $fromDate = "2024-07-25";
//        $toDate = "2024-07-25";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 50;

        $projection = [
            '_id' => 0,
            'reference_id' => 1,
            'result' => 1,
            'dice1' => 1,
            'dice2' => 1,
            'dice3' => 1,
            'total_tai' => 1,
            'total_xiu' => 1,
            'num_bet_tai' => 1,
            'num_bet_xiu' => 1,
            'total_prize' => 1,
            'total_refund_tai' => 1,
            'total_refund_xiu' => 1,
            'total_revenue' => 1,
            'money_type' => 1,
            'total_jackpot' => 1,
            'game' => 1,
            'status' => 1,
            'timestamp' => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
                ]
            ],
            'timestamp_db' => [
                '$dateToString' => [
                    'format' => '%d-%m-%YT%H:%M:%S',
                    'date' => '$create_time'
                ]
            ]
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

        if (strlen($phientx)) {
            $conds[] = ['reference_id' => intval($phientx)];
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
            'data' => null,
            'errorCode' => null,
            'message' => "success",
            'success' => true,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results
        ];
    }

    function accounttaixiumd5($phientx, $fromDate, $toDate, $nickname, $cuadat, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table4);
//
//        $fromDate = "2024-08-05";
//        $toDate = "2024-08-05";
        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 100;

        $projection = [
            '_id' => 0,
            'referenceId' => '$reference_id',
            'user_id' => 1,
            'user_name' => '$nick_name',
            'bet_value' => 1,
            'bet_side' => 1,
            'total_prize' => 1,
            'total_refund' => 1,
            'total_exchange' => 1,
            'money_type' => 1,
            'crDate' => 1,
            'total_jackpot' => 1,
            'input_time' => 1,
            'game' => 1,
            'status' => 1,
            'fee' => 1,
            'is_bot' => 1,
            'time_log' => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
                ]
            ],
            'timestamp' => [
                '$dateToString' => [
                    'format' => '%d-%m-%YT%H:%M:%S',
                    'date' => '$create_time'
                ]
            ]
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

        if (strlen($phientx)) {
            $conds[] = ['reference_id' => intval($phientx)];
        }

        if (strlen($nickname)) {
            $conds[] = ['nick_name' => $nickname];
        }

        if (strlen($cuadat) && intval($cuadat) !== -1) {
            $conds[] = ['bet_side' => intval($cuadat)];
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
            'errorCode' => null,
            'message' => "success",
            'success' => true,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results,
            'totalPlayer' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0
        ];
    }

    function logphienbaucua($phienbc, $room, $fromDate, $toDate, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table5);

//        $fromDate = "2022-09-13";
//        $toDate = "2022-09-13";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 50;

        $projection = [
            '_id' => 0,
            'reference_id' => 1,
            'room' => 1,
            'min_bet_value' => 1,
            'dice1' => 1,
            'dice2' => 1,
            'x_pot' => 1,
            'x_value' => 1,
            'bet_value' => 1,
            'bet_bau' => 1,
            'bet_cua' => 1,
            'bet_tom' => 1,
            'bet_ca' => 1,
            'bet_ga' => 1,
            'bet_huou' => 1,
            'prize' => 1,
            'prize_bau' => 1,
            'prize_cua' => 1,
            'prize_tom' => 1,
            'prize_ca' => 1,
            'prize_ga' => 1,
            'prize_huou' => 1,
            'time_log' => 1,
            'total' => 1,
            'totalBet' => 1,
            'totalPrize' => 1,
            'totalMoney' => 1
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

        if (strlen($phienbc)) {
            $conds[] = ['reference_id' => intval($phienbc)];
        }

        if (strlen($room)) {
            $conds[] = ['room' => intval($room)];
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
            'data' => null,
            'errorCode' => "0",
            'message' => null,
            'success' => true,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results
        ];
    }

    function logbaucua($phienbc, $nickname, $roomvin, $roomxu, $money, $fromDate, $toDate, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table6);

//        $fromDate = "2022-11-19";
//        $toDate = "2023-07-03";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 50;

        $projection = [
            '_id' => 0,
            'referent_id' => '$reference_id',
            'bet_value' => 1,
            'bet_bau' => 1,
            'bet_ca' => 1,
            'bet_cua' => 1,
            'bet_ga' => 1,
            'bet_huou' => 1,
            'bet_tom' => 1,
            'dices' => 1,
            'money_exchange' => 1,
            'money_type' => 1,
            'prize' => 1,
            'prize_bau' => 1,
            'prize_cua' => 1,
            'prize_tom' => 1,
            'prize_ca' => 1,
            'prize_ga' => 1,
            'prize_huou' => 1,
            'time_log' => 1,
            'room' => 1,
            'user_name' => 1
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

        if (strlen($phienbc)) {
            $conds[] = ['reference_id' => intval($phienbc)];
        }

        if (strlen($nickname)) {
            $conds[] = ['user_name' => $nickname];
        }

        if (strlen($roomvin) && intval($roomvin) !== -1) {
            $conds[] = ['room' => intval($roomvin)];
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
                    'distinctNickNames' => ['$addToSet' => '$user_name']
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
            'totalRecord' => $total,
            'transactions' => $results,
            'totalPlayer' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0
        ];
    }

    function logminipoker($fromDate, $toDate, $nickname, $roomvin, $roomxu, $money, $pages)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table7);

//        $fromDate = "2022-10-16";
//        $toDate = "2023-01-03";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 50;

        $projection = [
            "user_name"=> 1,
            "bet_value"=> 1,
            "result"=> 1,
            "prize"=> 1,
            "cards"=> 1,
            "current_pot"=> 1,
            "current_fund"=> 1,
            "money_type"=> 1,
            "time_log"=> 1
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

        if (strlen($nickname)) {
            $conds[] = ['user_name' => $nickname];
        }

        if (strlen($roomvin) && intval($roomvin)) {
            $conds[] = ['bet_value' => intval($roomvin)];
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
                    'distinctNickNames' => ['$addToSet' => '$user_name']
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
            'totalRecord' => $total,
            'transactions' => $results,
            'total_player' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0
        ];
    }
}