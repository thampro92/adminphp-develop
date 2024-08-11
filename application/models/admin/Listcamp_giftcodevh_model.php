<?php

class Listcamp_giftcodevh_model extends MY_Model
{
    var $table = 'campain';

    function search($menhgiavin, $soluong, $camp, $endTime, $page, $page_size)
    {
        $this->load->library('mongodb_library');
        $this->mongodb_library->selectCollection($this->table);

        $page = !strlen($page) ? 0 : intval($page);
        $page_size = !strlen($page_size) ? 0 : intval($page_size);

        $options = [
            "projection" => ["_id" => 0],
            'sort' => ['create_time' => -1] // Sắp xếp theo CreatedAt giảm dần (tùy chọn)
        ];

        if ($page) {
            $options['skip'] = ($page - 1) * $page_size;
        }

        if ($page_size) {
            $options['limit'] = $page_size;
        }

        $conds = [];
        if (strlen($endTime)) {
            $conds[] = ['create_time' => ['$gte' => $endTime]];
        }

        if (strlen($camp)) {
            $conds[] = ['campain' => $camp];
        }

        if (intval($soluong)) {
            $conds[] = ['quantity' => intval($soluong)];
        }

        if (intval($menhgiavin)) {
            $conds[] = ['price' => intval($menhgiavin)];
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
            'counts' => count($results),
            'success' => true,
            'data' => $results,
            'errorCode' => null,
            'message' => "success",
            'total' => count($results),
            'totalRecord' => $total
        ];
    }
}