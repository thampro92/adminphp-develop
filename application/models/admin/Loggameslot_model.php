<?php

class Loggameslot_model extends MY_Model
{
    var $coreDB = "DBCoreLog";
    var $table1 = 'slot_transactions';
    var $table2 = 'minislot_transactions';

    function lux52slot($game, $fromDate, $toDate, $transId, $bet_value, $nickName, $page)
    {
        set_time_limit(0);
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table1);

//        $fromDate = "2024-07-05 00:00:00";
//        $toDate = "2024-07-05 23:59:59";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . '+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . '+0000') * 1000); // Midnight of the next day

        $page = intval($page);
        $maxItem = 50;

        $projection = [
            '_id' => 0,
            "reference_id" => 1,
            "user_name" => '$nick_name',
            "bet_value" => 1,
            "lines_betting" => 1,
            "lines_win" => 1,
            "prizes_on_line" => '$win_value_on_line',
            "prize" => ['$sum' => '$win_value_on_line'],
            "result" => ['$sum' => '$result'],
            "description" => "",
            "time_log" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
                ]
            ],
            "create_time" => 1,
            "total_bet_value" => 1,
            "total_win_value" => 1
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

        if (strlen($game)) {
            $conds[] = ['game_id' => $game];
        }

        if (strlen($transId)) {
            $conds[] = ['reference_id' => intval($transId)];
        }

        if (strlen($bet_value)) {
            $conds[] = ['bet_value' => intval($bet_value)];
        }

        if (strlen($nickName)) {
            $conds[] = ['nick_name' => $nickName];
        }

        $filter = [
            '$and' => $conds
        ];

        $results = $this->mongodb_library->find($filter, $options);
        $tong_cuoc = 0;
        $tong_thang = 0;
        foreach ($results as &$result) {
            $tong_cuoc += intval($result['total_bet_value']);
            $tong_thang += intval($result['total_win_value']);

            $result['create_time'] = (string)$result['create_time'];
            $bsonArray = new MongoDB\Model\BSONArray($result['lines_betting']);
            $array = $bsonArray->getArrayCopy();
            $commaSeparatedString = implode(",", $array);
            $result['lines_betting'] = $commaSeparatedString;

            $bsonArray2 = new MongoDB\Model\BSONArray($result['lines_win']);
            $array2 = $bsonArray2->getArrayCopy();
            $commaSeparatedString2 = implode(",", $array2);
            $result['lines_win'] = $commaSeparatedString2;

            $bsonArray3 = new MongoDB\Model\BSONArray($result['prizes_on_line']);
            $array3 = $bsonArray3->getArrayCopy();
            $commaSeparatedString3 = implode(",", $array3);
            $result['prizes_on_line'] = $commaSeparatedString3;
        }

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
            'tong_cuoc' => $tong_cuoc,
            'tong_thang' => $tong_thang,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results,
            'tong_player' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0
        ];

    }

    function vb52slot($game, $fromDate, $toDate, $transId, $bet_value, $nickName, $page)
    {
        set_time_limit(0);
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table2);

//        $fromDate = "2024-07-06 00:00:00";
//        $toDate = "2024-07-06 23:59:49";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . '+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . '+0000') * 1000); // Midnight of the next day

        $page = intval($page);
        $maxItem = 50;

        $projection = [
            '_id' => 0,
            "reference_id" => 1,
            "user_name" => '$nick_name',
            "bet_value" => 1,
            "lines_betting" => 1,
            "lines_win" => 1,
            "prizes_on_line" => '$win_value_on_line',
            "prize" => ['$sum' => '$win_value_on_line'],
            "result" => ['$sum' => '$result'],
            "description" => "",
            "time_log" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$create_time',
                    'timezone' => '+00:00'
                ]
            ],
            "create_time" => 1,
            "total_bet_value" => 1,
            "total_win_value" => 1
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

        if (strlen($game)) {
            $conds[] = ['game_id' => $game];
        }

        if (strlen($transId)) {
            $conds[] = ['reference_id' => intval($transId)];
        }

        if (strlen($bet_value)) {
            $conds[] = ['bet_value' => intval($bet_value)];
        }

        if (strlen($nickName)) {
            $conds[] = ['nick_name' => $nickName];
        }

        $filter = [
            '$and' => $conds
        ];


        $results = $this->mongodb_library->find($filter, $options);
        $tong_cuoc = 0;
        $tong_thang = 0;
        foreach ($results as &$result) {
            $tong_cuoc += intval($result['total_bet_value']);
            $tong_thang += intval($result['total_win_value']);

            $result['create_time'] = (string)$result['create_time'];
            $bsonArray = new MongoDB\Model\BSONArray($result['lines_betting']);
            $array = $bsonArray->getArrayCopy();
            $commaSeparatedString = implode(",", $array);
            $result['lines_betting'] = $commaSeparatedString;

            $bsonArray2 = new MongoDB\Model\BSONArray($result['lines_win']);
            $array2 = $bsonArray2->getArrayCopy();
            $commaSeparatedString2 = implode(",", $array2);
            $result['lines_win'] = $commaSeparatedString2;

            $bsonArray3 = new MongoDB\Model\BSONArray($result['prizes_on_line']);
            $array3 = $bsonArray3->getArrayCopy();
            $commaSeparatedString3 = implode(",", $array3);
            $result['prizes_on_line'] = $commaSeparatedString3;
        }

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
            'tong_cuoc' => $tong_cuoc,
            'tong_thang' => $tong_thang,
            'total' => ceil($total / $maxItem),
            'totalRecord' => $total,
            'transactions' => $results,
            'tong_player' => isset($result2[0]['distinctNickNameCount']) ? $result2[0]['distinctNickNameCount'] : 0
        ];

    }

}