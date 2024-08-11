<?php

class Revenuever_model extends MY_Model
{
    var $table1 = 'deposit_paygate';
    var $table2 = 'withdrawal_paygate';

    function search($fromDate, $toDate, $game, $version)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table1);
        $platformProvider = [
            "ad" => ["bank", "card", "momo"],
            "ios" => ["bank", "card", "momo"],
            "web" => ["bank", "card", "momo"],
            "unknow" => ["bank", "card", "momo"]
        ];

        $result = [
            "deposit" => 0
        ];
        $total = 0;

        foreach ($platformProvider as $platform => $providerNames) {
            $total2 = 0;
            $result["deposit_{$platform}"] = 0;

            foreach ($providerNames as $providerName) {
                $pipeline = [
                    [
                        '$match' => [
                            'IsDeleted' => false,
                            'Status' => 4,
                            'ProviderName' => $providerName,
                            'Platform' => $platform,
                            'CreatedAt' => [
                                '$gte' => $fromDate,
                                '$lte' => $toDate
                            ]
                        ]
                    ],
                    [
                        '$group' => [
                            '_id' => [
                                'ProviderName' => '$ProviderName',
                                'Platform' => '$Platform'
                            ],
                            'totalAmount' => ['$sum' => ['$multiply' => ['$Amount']]]
                        ]
                    ],
                    [
                        '$project' => [
                            '_id' => 0,
                            'ProviderName' => '$_id.ProviderName',
                            'Platform' => '$_id.Platform',
                            'totalAmount' => 1
                        ]
                    ]
                ];

                $results = $this->mongodb_library->aggregate($pipeline);
                if (!$results || !count($results)) {
                    $result["deposit_{$platform}_{$providerName}"] = 0;
                } else {
                    $result["deposit_{$platform}_{$providerName}"] = intval((array)$results[0]['totalAmount']);
                    $total2 += intval((array)$results[0]['totalAmount']);
                }
            }

            $result["deposit_{$platform}"] = $total2;
            $total += $total2;
        }

        $result["deposit"] = $total;

        $this->mongodb_library->selectCollection($this->table2);

        $result["withdrawal"] = 0;
        $total = 0;

        foreach ($platformProvider as $platform => $providerNames) {
            $total2 = 0;
            $result["withdrawal_{$platform}"] = 0;

            foreach ($providerNames as $providerName) {
                $pipeline = [
                    [
                        '$match' => [
                            'IsDeleted' => false,
                            'Status' => 4,
                            'ProviderName' => $providerName,
                            'Platform' => $platform,
                            'game' => $game,
                            'version' => $version,
                            'CreatedAt' => [
                                '$gte' => $fromDate,
                                '$lte' => $toDate
                            ]
                        ]
                    ],
                    [
                        '$group' => [
                            '_id' => [
                                'ProviderName' => '$ProviderName',
                                'Platform' => '$Platform'
                            ],
                            'totalAmount' => ['$sum' => ['$multiply' => ['$Amount']]]
                        ]
                    ],
                    [
                        '$project' => [
                            '_id' => 0,
                            'ProviderName' => '$_id.ProviderName',
                            'Platform' => '$_id.Platform',
                            'totalAmount' => 1
                        ]
                    ]
                ];

                $results = $this->mongodb_library->aggregate($pipeline);
                if (!$results || !count($results)) {
                    $result["withdrawal_{$platform}_{$providerName}"] = 0;
                } else {
                    $result["withdrawal_{$platform}_{$providerName}"] = intval((array)$results[0]['totalAmount']);
                    $total2 += intval((array)$results[0]['totalAmount']);
                }
            }

            $result["withdrawal_{$platform}"] = $total2;
            $total += $total2;
        }

        $result["withdrawal"] = $total;
        return $result;
    }
}