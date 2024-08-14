<?php

class Loggamebai extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }


    function index()
    {
        $this->data['temp'] = 'admin/loggamebai/index';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = $this->input->post("namegame");
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function loggame()
    {
        canMenu('loggamebai/loggame');
        $this->data['temp'] = 'admin/loggamebai/loggame';
        $this->load->view('admin/main', $this->data);
    }

    function loggameajax()
    {
        canMenu('loggamebai/loggame');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = urlencode($this->input->post("namegame"));
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));

//        if ($namegame == "rongho") {
//
//
//            //http://10.40.96.10:8090/game/service/cms?c=301&page=1&referenceId=0&fd=1675357200&td=1675443599
//            $datainfo = $this->sendGet('http://10.40.96.10:8090/game/service/cms' . '?c=301&referenceId=' . $sid . '&td=' . urlencode($toDate) . '&fd=' . urlencode($fromDate) . '&mt=' . $money . '&page=' . $pages, '8090');
//
//
//            if (isset($datainfo)) {
//                echo $datainfo;
//            } else {
//                echo "Bạn không được hack";
//            }
//            return;
//        }
//
//        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($fromDate) . '&te=' . urlencode($toDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);

        if ($this->input->is_ajax_request()) {
            $this->load->model("admin/Loggamebai_model");
            $rs = $this->Loggamebai_model->loggame($fromDate, $toDate, $nickname, $namegame, $sid, $money, $pages);
            echo json_encode($rs);
        } else {
            echo "Bạn không được hack";
        }
    }

    function ronghodetail()
    {
        $sid = $this->uri->segment('4');
        $gamename = $this->uri->segment('6');
        $createtime = $this->uri->segment('5');
        $uriMatch = $this->config->item('game_bai_uri_return');
        $this->data['sid'] = $sid;
        $this->data['gamename'] = $gamename;
        $this->data['createtime'] = $createtime;
        $params = [
            'toDate' => $this->input->get("toDate"),
            'fromDate' => $this->input->get("fromDate"),
            'session_name' => $this->input->get("session_name"),
            'name' => $this->input->get("name"),
        ];
        $this->data['uri'] = http_build_query($params);
        $this->data['returnUrl'] = isset($uriMatch[$gamename]) ? $uriMatch[$gamename] : null;
        $this->data['temp'] = 'admin/loggamebai/ronghodetail';
        $this->load->view('admin/main', $this->data);
    }

    function ronghodetailajax()
    {
        $time = $this->input->post("time");
        $sid = $this->input->post("sid");
        //http://10.40.96.10:8090/game/service/cms?c=302&referenceId=16373&fd=03-02-2023
        $datainfo = $this->sendGet('http://10.40.96.10:8090/game/service/cms' . '?c=302&referenceId=' . $sid . '&fd=' . urlencode($time), '8090');


        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
        return;
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


    function maubinh()
    {
        canMenu('loggamebai/maubinh');
        $this->data['temp'] = 'admin/loggamebai/maubinh';
        $this->load->view('admin/main', $this->data);
    }

    function maubinhajax()
    {
        canMenu('loggamebai/maubinh');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "Binh";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function lieng()
    {
        canMenu('loggamebai/lieng');
        $this->data['temp'] = 'admin/loggamebai/lieng';
        $this->load->view('admin/main', $this->data);
    }

    function liengajax()
    {
        canMenu('loggamebai/lieng');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "Lieng";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function baicao()
    {
        canMenu('loggamebai/baicao');
        $this->data['temp'] = 'admin/loggamebai/baicao';
        $this->load->view('admin/main', $this->data);
    }

    function baicaoajax()
    {
        canMenu('loggamebai/baicao');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "BaiCao";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function baisam()
    {
        canMenu('loggamebai/baisam');
        $this->data['temp'] = 'admin/loggamebai/baisam';
        $this->load->view('admin/main', $this->data);
    }

    function baisamajax()
    {
        canMenu('loggamebai/baisam');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "Sam";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function poker()
    {
        canMenu('loggamebai/poker');
        $this->data['temp'] = 'admin/loggamebai/poker';
        $this->load->view('admin/main', $this->data);
    }

    function pokerajax()
    {
        canMenu('loggamebai/poker');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "Poker";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function bacay()
    {
        canMenu('loggamebai/bacay');
        $this->data['temp'] = 'admin/loggamebai/bacay';
        $this->load->view('admin/main', $this->data);
    }

    function bacayajax()
    {
        canMenu('loggamebai/bacay');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "BaCay";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function sam()
    {
        canMenu('loggamebai/sam');
        $this->data['temp'] = 'admin/loggamebai/sam';
        $this->load->view('admin/main', $this->data);
    }

    function samajax()
    {
        canMenu('loggamebai/sam');
//        $params = [
//            'c' => 503,
//            'nn' => $this->input->post("nickname"),
//            'tid' => $this->input->post("tid"),
////                    'r' => null,
//            'ts' => $this->input->post("fromDate"),
//            'te' => $this->input->post("toDate"),
//            'mt' => $this->input->post("moneyType"),
//            'p' => $this->input->post("pages"),
//        ];
//        $url = $this->config->item('api_backend2') . '?' . http_build_query($params);
//        $datainfo = $this->get_data_curl($url);

        $nickname = $this->input->post("nickname");
        $transid = $this->input->post("tid");
        $fromDate = $this->input->post("fromDate");
        $toDate = $this->input->post("toDate");
        $pages = $this->input->post("pages");
        $moneyType = $this->input->post("moneyType");
        if ($this->input->is_ajax_request()) {
            $this->load->model("admin/loggamebai_model");
            $rs = $this->loggamebai_model->loggamebaisam($transid, $nickname, $fromDate, $toDate, $moneyType, $pages);
            echo json_encode($rs);
        } else {
            echo "Bạn không được hack";
        }
    }

    function binh()
    {
        canMenu('loggamebai/binh');
        $this->data['temp'] = 'admin/loggamebai/binh';
        $this->load->view('admin/main', $this->data);
    }

    function binhajax()
    {
        canMenu('loggamebai/binh');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "XocDia";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function tlmn()
    {
        canMenu('loggamebai/tlmn');
        $this->data['temp'] = 'admin/loggamebai/tlmn';
        $this->load->view('admin/main', $this->data);
    }

    function tlmnajax()
    {
        canMenu('loggamebai/tlmn');
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = "Tlmn";
        $pages = $this->input->post("pages");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $sid = urlencode($this->input->post("sid"));
        $money = urlencode($this->input->post("money"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=2&nn=' . $nickname . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&sid=' . $sid . '&mt=' . $money);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function detail()
    {
        $sid = $this->uri->segment('4');
        $gamename = $this->uri->segment('5');
        $createtime = $this->uri->segment('6');
        $uriMatch = $this->config->item('game_bai_uri_return');
        $this->data['sid'] = $sid;
        $this->data['gamename'] = $gamename;
        $this->data['createtime'] = $createtime;
        $params = [
            'toDate' => $this->input->get("toDate"),
            'fromDate' => $this->input->get("fromDate"),
            'session_name' => $this->input->get("session_name"),
            'name' => $this->input->get("name"),
        ];
        $this->data['uri'] = http_build_query($params);
        $this->data['returnUrl'] = isset($uriMatch[$gamename]) ? $uriMatch[$gamename] : null;
        $this->data['temp'] = 'admin/loggamebai/detail';
        $this->load->view('admin/main', $this->data);
    }

    function detailajax()
    {
        $time = $this->input->post("time");
        $namegame = $this->input->post("namegame");
        $sid = $this->input->post("sid");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=4&sid=' . $sid . '&gn=' . $namegame . '&tg=' . $time);


        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

//    function  reportticketfree(){
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//        if ($start_time === null) {
//            $start_time = date('Y-m-d', strtotime('-7 days'));
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//
//        $this->data['temp'] = 'admin/loggamebai/reportticketfree';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function ticketfreeajax(){
//        $nickname = urlencode($this->input->post("nickname"));
//        $id = urlencode($this->input->post("id"));
//        $source = $this->input->post("source");
//        $gtve = $this->input->post("gtve");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $status = $this->input->post("status");
//        $pages = $this->input->post("page");
//        $record = $this->input->post("record");
//        $tourid = $this->input->post("tourid");
//        $typetour = $this->input->post("typetour");
//        $tinhtrang = $this->input->post("tinhtrang");
//        $taikhoan = $this->input->post("taikhoan");
//
//        if($id == "" && $tourid != ""){
//            $id = -1;
//        }elseif($id != "" && $tourid == ""){
//            $tourid = -1;
//        }elseif($id == "" && $tourid == ""){
//            $id = -1;
//            $tourid = -1;
//
//        }
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=23&nn=' . $nickname . '&id=' . $id . '&cty=' . $source . '&am=' .$gtve . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&st=' . $status . '&p=' . $pages . '&s=' . $record . '&bot=' . $taikhoan.'&use='.$tinhtrang.'&tid='.$tourid.'&tty='.$typetour);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//    }

//    function  reportcodefree(){
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//
//        $this->data['temp'] = 'admin/loggamebai/reportcodefree';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function reportcodefreeajax(){
//        $accesstoken = $this->session->userdata('accessToken');
//        //var_dump($accesstoken);
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $id = urlencode($this->input->post("id"));
//        $nickname = urlencode($this->input->post("nickname"));
//        $code = urlencode($this->input->post("code"));
//        $amount = $this->input->post("amount");
//        $status = $this->input->post("status");
//        $search = $this->input->post("search");
//        $loid= urlencode($this->input->post("loid"));
//        $typecode = $this->input->post("typecode");
//        $thongtin = urlencode($this->input->post("thongtin"));
//        if($id == ""){
//            $id = -1;
//        }
//        if($loid == ""){
//            $loid = -1;
//        }
//       // var_dump($this->config->item('api_backend') . '?c=25&id=' . $id . '&co=' . $code . '&pkid=' . $loid . '&gn=PokerTour&am='.$amount.'&ct='.$typecode.'&st='.$status.'&nn='.$nickname.'&adi='.$thongtin.'&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate).'&type='.$search.'&adm='.$accesstoken[1].'&at='.$accesstoken[0]);
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=25&id=' . $id . '&co=' . $code . '&pkid=' . $loid . '&gn=PokerTour&am='.$amount.'&ct='.$typecode.'&st='.$status.'&nn='.$nickname.'&adi='.$thongtin.'&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate).'&type='.$search.'&adm='.$accesstoken[1].'&at='.$accesstoken[0]);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//    }


//    function  reportlocodefree(){
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//
//        $this->data['temp'] = 'admin/loggamebai/reportlocodefree';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function reportlocodefreeajax(){
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $id = urlencode($this->input->post("id"));
//        $nickname = urlencode($this->input->post("nickname"));
//        $amount = $this->input->post("amount");
//        $typecode = $this->input->post("typecode");
//        if($id == ""){
//            $id = -1;
//        }
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=26&id=' . $id .'&gn=PokerTour&am='.$amount.'&ct='.$typecode.'&act='.$nickname.'&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//    }

//    function  reportcodepokertour(){
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//
//        $this->data['temp'] = 'admin/loggamebai/reportcodepokertour';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function  reportcodepokertourajax(){
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $search = $this->input->post("search");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=27&gn=PokerTour&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate).'&type='.$search);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//    }

}