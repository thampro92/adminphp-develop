<?php

class Withdraw_payment_model extends MY_Model
{
    var $table = 'withdrawal_paygate';

    function search($nickName, $nhaCungCap, $orderId, $transactionId, $fromTime, $endTime, $status, $pages, $bankAccountName, $bankAccountNumber, $bankCode, $size, $fromAmount, $toAmount)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $pages = intval($pages);
        $size = intval($size);

//        $fromTime = "2023-10-22 00:30:55";
//        $endTime = "2023-10-22 23:30:55";
        $options = [
            "projection" => [
                "_id" => 0
            ],
            'skip' => ($pages - 1) * $size,
            'limit' => $size,
            'sort' => ['CreatedAt' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        $status = !strlen($status) ? "" : intval($status);
        $conds = [
            ['CreatedAt' => ['$gte' => $fromTime]],
            ['CreatedAt' => ['$lte' => $endTime]]
        ];

        if (strlen($nickName)) {
            $conds[] = ['Nickname' => $nickName];
        }

        if (strlen($nhaCungCap)) {
            $conds[] = ['ProviderName' => $nhaCungCap];
        }

        if (strlen($orderId)) {
            $conds[] = ['ID' => $orderId];
        }

        if (strlen($transactionId)) {
            $conds[] = ['ID' => $transactionId];
        }

        if (strlen($status)) {
            $conds[] = ['Status' => $status];
        }

        if (strlen($bankCode)) {
            $conds[] = ['BankCode' => $bankCode];
        }

        if (strlen($bankAccountName)) {
            $conds[] = ['BankAccountNumber' => $bankAccountName];
        }

        if (strlen($bankAccountNumber)) {
            $conds[] = ['BankAccountName' => $bankAccountNumber];
        }

        if (strlen($fromAmount)) {
            $conds[] = ['Amount' => ['$gte' => $fromAmount]];
        }

        if (strlen($toAmount)) {
            $conds[] = ['Amount' => ['$lte' => $toAmount]];
        }

        $filter = [
            '$and' => $conds
        ];

        $results = $this->mongodb_library->find($filter, $options);
        $statistic = [0, 0, 0];
        if (!strlen($status) || $status == 4) {
            if (strlen($status)) {
                $results2 = $this->mongodb_library->find([
                    '$and' => [
                        ['CreatedAt' => ['$gte' => $fromTime]],
                        ['CreatedAt' => ['$lte' => $endTime]],
                        ['Nickname' => $nickName],
                        ['ProviderName' => $nhaCungCap],
                        ['ID' => $orderId],
                        ['ID' => $transactionId],
                        ['Status' => $status],
                        ['BankCode' => $bankCode],
                        ['BankAccountNumber' => $bankAccountName],
                        ['BankAccountName' => $bankAccountNumber],
                        ['Amount' => ['$gte' => $fromAmount]],
                        ['Amount' => ['$lte' => $toAmount]]
                    ]
                ], $options);
            } else {
                $results2 = $results;
            }

            $statistic[0] = count($results2);
            $t1 = 0;
            foreach ($results2 as $result) {
                $t1 += ((array)$result)['Amount'];
            }
            $statistic[1] = $t1;

            $t2 = 0;
            foreach ($results as $result) {
                $t2 += ((array)$result)['Amount'];
            }
            $statistic[2] = $t2;
        }

        $total = $this->mongodb_library->countDocuments($filter);
        return [
            'success' => true,
            'data' => $results,
            'statistic' => $statistic,
            'errorCode' => null,
            'message' => null,
            'totalRecords' => $total
        ];
    }
}