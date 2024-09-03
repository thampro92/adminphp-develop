<?php

class Ccu_model extends MY_Model
{
    var $table = 'log_ccu';

    function search($fromDate, $toDate, $game, $version)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $results = $this->mongodb_library->find([
            '$and' => [
                ['time_log' => ['$gte' => $fromDate]],
                ['time_log' => ['$lte' => $toDate]]
            ]
        ], ["projection" => ["_id" => 0, 'ccu' => 1, 'web' => 1, 'ad' => 1, 'ios' => 1, 'wp' => 1, 'fb' => 1, 'dt' => 1, 'ot' => 1, 'ts' => '$time_log']]);

        return [
            'success' => true,
            'transactions' => $results,
            'data' => null,
            'errorCode' => null,
            'message' => null
        ];
    }
}