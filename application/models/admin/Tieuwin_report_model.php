<?php

class Tieuwin_report_model extends MY_Model
{
    var $table = 'withdrawal_paygate';

    function search($nickName, $actionName, $toDate, $fromDate, $serviceName, $transId, $userId, $moneyExchange, $currentMoney, $fee, $page, $maxItem)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $page = intval($page);
        $maxItem = intval($maxItem);

        $options = [
            "projection" => [
                "_id" => 0
            ],
            'skip' => ($page - 1) * $maxItem,
            'limit' => $maxItem,
            'sort' => ['CreatedAt' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

//        $fromDate = "2023-10-22 00:30:55";
//        $toDate = "2023-10-22 23:30:55";
        $conds = [
            ['CreatedAt' => ['$gte' => $fromDate]],
            ['CreatedAt' => ['$lte' => $toDate]]
        ];

        if (strlen($nickName)) {
            $conds[] = ['Nickname' => $nickName];
        }

        if (strlen($actionName)) {
            //$conds[] = ['action_name' => $actionName];
        }

        if (strlen($transId)) {
            $conds[] = ['ReferenceId' => $transId];
        }

        if (strlen($userId)) {
            $conds[] = ['UserId' => $userId];
        }

        if (intval($currentMoney)) {
            $conds[] = ['Amount' => ['$gte' => intval($currentMoney)]];
        }

        if (intval($moneyExchange)) {
            //$conds[] = ['money_exchange' => ['$gte' => intval($moneyExchange)]];
        }

        if (intval($fee)) {
            $conds[] = ['AmountFee' => ['$gte' => intval($fee)]];
        }

        $filter = [
            '$and' => $conds
        ];

        $results = $this->mongodb_library->find($filter, $options);
        $totalRut = 0;
        foreach ($results as $result) {
            (array)$result["action_name"] = (array)$result["UserApprove"];
            (array)$result["money_exchange"] = intval(((array)$result)["Amount"])- intval(((array)$result)["AmountFee"]);
            $totalRut += intval(((array)$result)["money_exchange"]);
        }

        $total = $this->mongodb_library->countDocuments($filter);
        return [
            'success' => true,
            'data' => ['listData' => $results, 'totalRut' => $totalRut],
            'statistic' => null,
            'errorCode' => null,
            'message' => null,
            'totalRecords' => $total
        ];
    }
}