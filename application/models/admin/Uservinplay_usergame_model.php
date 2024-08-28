<?php

class Uservinplay_usergame_model extends MY_Model
{
    var $table1 = 'deposit_paygate';
    var $table2 = 'withdrawal_paygate';
    var $table3 = 'vip_bonus';

    function search($username, $nickname, $phone, $fieldname, $timkiemtheo, $toDate, $fromDate, $typetaikhoan, $pages, $record, $typetk, $email, $refcode)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table1);

        $page = intval($pages);
        $size = intval($record);

        $accountInfo = $this->getAccounts($this->table1, $username, $nickname, $phone, $fieldname, $timkiemtheo, $toDate, $fromDate, $typetaikhoan, $page, $size, $typetk, $email, $refcode);
        $accounts = $accountInfo['data'];
        $totalRecord = intval($accountInfo['totalCount']);
        $transactions = [];
        foreach ($accounts as $account) {
            $transactions[] = $this->getTransactions($fromDate, $toDate, $account['Username'], $account['Nickname']);
        }

        return [
            "success" => true,
            "message" => null,
            "errorCode" => "0",
            "data" => null,
            "total" => ceil($totalRecord / $record),
            "totalRecord" => $totalRecord,
            "transactions" => $transactions
        ];
    }

    protected function getTransactions($fromDate, $toDate, $Username, $Nickname)
    {
        return [
            "username" => $Username,
            "nickname" => $Nickname,
            "email" => null,
            "mobile" => null,
            "identification" => null,
            "vinTotal" => 0,
            "xuTotal" => 0,
            "safe" => 0,
            "rechargeMoney" => 0,
            "total_nap" => $this->getAmount($this->table1, $fromDate, $toDate, $Username, $Nickname),
            "total_tieu" => $this->getAmount($this->table2, $fromDate, $toDate, $Username, $Nickname),
            "vippoint" => 0,
            "vippointSave" => 0,
            "loginOtp" => -1,
            "bot" => false,
            "createTime" => "",
            "securityTime" => null,
            "status" => 0,
            "hasMobileSecurity" => false,
            "hasEmailSecurity" => false,
            "google_id" => null,
            "facebook_id" => null,
            "birthday" => null,
            "referral_code" => ""
        ];
    }

    protected function getAmount($table, $fromDate, $toDate, $Username, $Nickname)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($table);

        $match = [
            'Username' => $Username,             // Thay thế bằng Username bạn muốn lọc
            'Nickname' => $Nickname,         // Thay thế bằng Nickname bạn muốn lọc
            'IsDeleted' => false                // Lọc các bản ghi chưa bị xóa
        ];

        if (strlen($fromDate)) {
            $match['CreatedAt']['$gte'] = $fromDate;
        }

        if (strlen($toDate)) {
            $match['CreatedAt']['$lte'] = $toDate;
        }

        $pipeline = [
            [
                '$match' => $match
            ],
            [
                '$group' => [
                    '_id' => null,  // Không nhóm theo trường nào, chỉ tính tổng
                    'totalAmount' => ['$sum' => '$Amount']
                ]
            ],
            [
                '$project' => [
                    '_id' => 0,           // Ẩn trường _id
                    'totalAmount' => 1    // Hiển thị tổng số tiền
                ]
            ]
        ];

        $results = $this->mongodb_library->aggregate($pipeline);
        $total = $results && count($results) ? $results[0]['totalAmount'] : 0;
        return $total;
    }

    protected function getAccounts($table, $username, $nickname, $phone, $fieldname, $timkiemtheo, $toDate, $fromDate, $typetaikhoan, $page, $size, $typetk, $email, $refcode)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($table);

        $fromDate = "2023-10-22 00:30:55";
        $toDate = "2023-10-22 23:30:55";
        //Lay ds nickname o 2 bang 1,2

        $match = ['IsDeleted' => false];
        if (strlen($fromDate)) {
            $match['CreatedAt'] = [];
            $match['CreatedAt']['$gte'] = $fromDate;
        }

        if (strlen($toDate)) {
            if (!is_array($match['CreatedAt']))
                $match['CreatedAt'] = [];

            $match['CreatedAt']['$lte'] = $toDate;
        }

        if (strlen($username)) {
            $match['Username'] = $username;
        }

        if (strlen($nickname)) {
            $match['Nickname'] = $nickname;
        }

        $pipeline = [
            [
                '$match' => $match
            ],
            [
                '$group' => [
                    '_id' => [
                        'Username' => '$Username',
                        'Nickname' => '$Nickname'
                    ],
                    'CreatedAt' => ['$first' => '$CreatedAt'],
                    'UserId' => ['$first' => '$UserId']
                ]
            ],
            [
                '$project' => [
                    '_id' => 0,               // Ẩn trường _id
                    'Username' => '$_id.Username',
                    'Nickname' => '$_id.Nickname'
                ]
            ],
            [
                '$facet' => [
                    'totalCount' => [
                        ['$count' => 'count']
                    ],
                    'results' => [
                        ['$skip' => ($page - 1) * $size],   // Bỏ qua một số lượng tài liệu, ví dụ cho phân trang
                        ['$limit' => $size]  // Giới hạn số lượng tài liệu trả về
                    ]
                ]
            ],
            [
                '$unwind' => '$totalCount' // Trích xuất giá trị từ mảng totalCount
            ]
        ];

        $results = $this->mongodb_library->aggregate($pipeline);
        $totalCount = count($results) ? $results[0]['totalCount']['count'] : 0;
        $data = count($results) ? $results[0]['results'] : [];
        return [
            'data' => $data,
            'totalCount' => $totalCount
        ];
    }

    protected function mergeUnique($array1, $array2)
    {
        if (!is_array($array1))
            $array1 = [];

        if (!is_array($array2))
            $array2 = [];

        // Tạo một mảng kết hợp từ mảng 1
        $merged = $array1;

        // Duyệt qua từng phần tử của mảng 2
        foreach ($array2 as $item2) {
            $isUnique = true;

            // Kiểm tra xem phần tử trong mảng 2 có trùng với phần tử trong mảng 1 không
            foreach ($array1 as $item1) {
                if ($item1['Username'] === $item2['Username'] && $item1['Nickname'] === $item2['Nickname']) {
                    $isUnique = false;
                    break;
                }
            }

            // Nếu không trùng, thêm vào mảng kết hợp
            if ($isUnique) {
                $merged[] = $item2;
            }
        }

        return $merged;
    }
}