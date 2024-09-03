<?php

class Loggamebai_model extends MY_Model
{
    var $coreDB = "DBCoreLog";
    var $table1 = 'caothap_transactions';
    var $table2 = 'log_game_BaCay_detail';
    var $table3 = 'xoc_dia_transactions';
    var $table4 = 'log_game_Tlmn_detail';
    var $table5 = 'log_game_Binh_detail';
    var $table6 = 'log_game_Lieng_detail';
    var $table7 = 'log_game_BaiCao_detail';
    var $table8 = 'log_game_Sam_detail';
    var $table9 = 'log_game_Poker_detail';
    var $table10 = 'rong_ho_transactions';

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
            "nick_name" => 1,
            "reference_id" => 1,
            "bet_value" => 1,
            "result" => 1,
            "step" => 1,
            "win_value" => 1,
            "jackpot" => 1,
            "time_log" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
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

        if (strlen($transid)) {
            $conds[] = ['reference_id' => intval($transid)];
        }

        if (strlen($nickname)) {
            $conds[] = ['nick_name' => $nickname];
        }

        if (strlen($moneyType) && intval($moneyType)) {
            //$conds[] = ['money_type' => intval($moneyType)];
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
        $this->load->library('mongodb_library');

//        $fromDate = 1722038401;
//        $toDate = 1722124741;

        $startTime = new MongoDB\BSON\UTCDateTime($fromDate * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime($toDate * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = 100;

        $projection = [
            "actionName" => ['$literal' => null],
            "createTime" => '$create_time',
            "gameName" => ['$literal' => $namegame],
            "id" => ['$literal' => null],
            "logDetail" => '$log_detail',
            "moneyType" => '$money_type',
            "nickName" => '$nick_name',
            "sessionId" => '$session_id',
            'timeLog' => '$create_time',
            "time" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => ['$toDate' => ['$toLong' => '$create_time']]
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

        if (strlen($sid) && $namegame != "rongho") {
            $conds[] = ['session_id' => $sid];
        }

        if (strlen($nickname)) {
            $conds[] = ['nick_name' => $nickname];
        }

        $filter = [
            '$and' => $conds
        ];


        switch ($namegame) {
            case 'BaCay';
                $this->mongodb_library->selectCollection($this->table2);
                break;
            case 'XocDia';
                $this->mongodb_library->selectCollection($this->table3);
                break;
            case 'Tlmn';
                $this->mongodb_library->selectCollection($this->table4);
                break;
            case 'Binh';
                $this->mongodb_library->selectCollection($this->table5);
                break;
            case 'Lieng';
                $this->mongodb_library->selectCollection($this->table6);
                break;
            case 'BaiCao';
                $this->mongodb_library->selectCollection($this->table7);
                break;
            case 'Sam';
                $this->mongodb_library->selectCollection($this->table8);
                break;
            case 'Poker';
                $this->mongodb_library->selectCollection($this->table9);
                break;
            case 'rongho';
                $this->mongodb_library->selectDatabase($this->coreDB);
                $this->mongodb_library->selectCollection($this->table10);

                $projection = [
                    "actionName" => ['$literal' => null],
                    "createTime" => [
                        '$dateToString' => [
                            'format' => '%Y-%m-%d %H:%M:%S',
                            'date' => '$create_time'
                        ]
                    ],
                    "gameName" => ['$literal' => "rongho"],
                    "id" => ['$literal' => null],
                    "logDetail" => ['$literal' => null],
                    "moneyType" => '$money_type',
                    "nickName" => '$nick_name',
                    "sessionId" => '$reference_id',
                    'time' => [
                        '$dateToString' => [
                            'format' => '%d-%m-%Y %H:%M:%S',
                            'date' => '$create_time'
                        ]
                    ],
                    'timeLog' => [
                        '$divide' => [
                            [
                                '$toLong' => [
                                    '$toDate' => '$create_time'
                                ]
                            ],
                            1000  // Divide by 1000 to convert milliseconds to seconds
                        ]
                    ]
                ];

                $options["projection"] = $projection;
                if (strlen($sid)) {
                    $conds[] = ['session_id' => $sid];
                }
                break;
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
            'totalPlayer' => count($results),
            'transactions' => $results
        ];
    }
}