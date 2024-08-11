<?php

class Ccu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lay ra danh sach danh muc san pham
     */
    function index()
    {
        canMenu('ccu');
        $this->data['temp'] = 'admin/ccu/index';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $game = $this->input->post("game");
        $version = $this->input->post("version");
        //$datainfo = $this->get_data_curl($this->config->item('api_backend2').'?c=108&ts='.urlencode($toDate).'&te='.urlencode($fromDate));

        //http://45.32.122.130:8090/game/service/cms?c=102&game=&fd=2022-12-01%2000:00:00&td=2022-12-30%2022:00:00&version=
//        $datainfo = $this->sendGet('http://10.40.96.10:8090/game/service/cms?c=102&game='.$game.'&fd='.urlencode($fromDate).'&td='.urlencode($toDate).'&version='.$version , '8090');
//
//        if(isset($datainfo)) {
//            echo $datainfo;
//        }else{
//            echo "Bạn không được hack";
//        }

        if ($this->input->is_ajax_request()) {
            $this->load->model("admin/ccu_model");
            $rs = $this->ccu_model->search($fromDate, $toDate, $game, $version);
            echo json_encode($rs);
        } else {
            show_404();
        }
    }

    function sendGet($url, $port)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => $port,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 55,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 02d54fda-89bf-aab3-abaf-3d482306f93a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}