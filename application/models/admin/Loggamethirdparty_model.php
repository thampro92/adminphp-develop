<?php

class Loggamethirdparty_model extends MY_Model
{
    var $coreDB = "DBCoreLog";
    var $table1 = 'lode_requests';
    var $table2 = 'lode_st_requests';

    function getLode($fromDate, $toDate, $nickname, $pages, $size)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table1);


//        $fromDate = "2024-08-12";
//        $toDate = "2024-08-12";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = intval($size);
        $projection = [
            "Id" => '$_id',
            "TimePlay" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$TimePlay',
                    'timezone' => '+00:00'
                ]
            ],
            "GameMode" => 1,
            "Number" => 1,
            "Pay" => 1,
            "PayRate" => 1,
            "Win" => 1,
            "nickname" => '$nickName'
        ];

        $options = [
            "projection" => $projection,
            'skip' => ($page - 1) * $maxItem,
            'limit' => $maxItem,
            'sort' => ['TimePlay' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $conds = [
            ['TimePlay' => ['$gte' => $startTime, '$lt' => $endTime]]
        ];

        if (strlen($nickname)) {
            $conds[] = ['nickName' => $nickname];
        }

        $filter = [
            '$and' => $conds
        ];

        $results = $this->mongodb_library->find($filter, $options);
        return $results;
    }

    function lodest($fromDate, $toDate, $nickname, $pages, $size)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectDatabase($this->coreDB);
        $this->mongodb_library->selectCollection($this->table2);


//        $fromDate = "2024-08-12";
//        $toDate = "2024-08-12";

        $startTime = new MongoDB\BSON\UTCDateTime(strtotime($fromDate . 'T00:00:00.000+0000') * 1000);
        $endTime = new MongoDB\BSON\UTCDateTime(strtotime($toDate . 'T23:59:59.000+0000') * 1000); // Midnight of the next day

        $page = intval($pages);
        $maxItem = intval($size);
        $projection = [
            "_id" => 0,
            "AppId" => ['$literal' => "xxeng"],
            "Channel" => 1,
            "CrDate" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y 00:00:00',
                    'date' => [
                        '$dateFromString' => [
                            'dateString' => [
                                '$concat' => [
                                    ['$substr' => ['$CrDate', 0, 4]],'-',
                                    ['$substr' => ['$CrDate', 4, 2]],'-',
                                    ['$substr' => ['$CrDate', 6, 2]]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "GameMode" => 1,
            "Number" => 1,
            "Pay" => 1,
            "PayRate" => 1,
            "Session" => 1,
            "Status" => 1,
            "TimePlay" => [
                '$dateToString' => [
                    'format' => '%d-%m-%Y %H:%M:%S',
                    'date' => '$TimePlay',
                    'timezone' => '+00:00'
                ]
            ],
            "TimeUpdate" => [
                '$dateToString' => [
                    'format' => '%d-%m-%YT%H:%M:%S',
                    'date' => '$TimeUpdate',
                    'timezone' => '+00:00'
                ]
            ],
            "TotalPay" => 1,
            "UserId" => 1,
            "Username" => ['$literal' => null],
            "Win" => 1,
            "WinNumber" => 1,
            "WinRate" => 1,
            "game" => 1,
            "id" => '$_id',
            "nickname" => '$nickName'
        ];

        $options = [
            "projection" => $projection,
            'skip' => ($page - 1) * $maxItem,
            'limit' => $maxItem,
            'sort' => ['TimePlay' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $conds = [
            ['TimePlay' => ['$gte' => $startTime, '$lt' => $endTime]]
        ];

        if (strlen($nickname)) {
            $conds[] = ['nickName' => $nickname];
        }

        $filter = [
            '$and' => $conds
        ];

        $results = $this->mongodb_library->find($filter, $options);
        return [
            'data' => $results,
            'total' => count($results)
        ];
    }
}