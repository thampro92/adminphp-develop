<?php

class Usergame extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Usergame_model');
        $this->load->model('logadmin_model');
        $this->load->model('actionadmin_model');
        $this->load->library('paginationlib');

//      fix error load library name
        $this->load->library('CSVReader');
    }


    function delete_tele()
    {
        canMenu('usergame/uservinplay');

        $nickname = $this->input->post("nickname");

        $data = $this->Usergame_model->deleteTelegramUser($nickname);
        $res = new stdClass();

        if ($data) {
            $res->response = 1;
            $res->message = "Xóa gắn kết telegame thành công";
            echo json_encode($res);
            return;
        }

        $res->response = -1;
        $res->message = "Xóa gắn kết telegame thất bại";
        echo json_encode($res);
        return;
    }


    function freezemoney()
    {
        canMenu('usergame/freezemoney');
        $this->data['temp'] = 'admin/usergame/freezemoney';
        $this->load->view('admin/main', $this->data);
    }

    function freezemoneyAjax()
    {
        canMenu('usergame/freezemoney');

        $nn = $this->input->post("nickname");

        try {
            //$data = $this->get_data_curl($endPoint);
            $data = $this->Usergame_model->get_log_freezemoney($nn);
            if (isset($data)) {
                echo json_encode($data);
                return;
            }
            echo "Bạn không được hack";
            return;

        } catch (\Exception $e) {
            log_message('error', 'Caught exception freezemoneyAjax : ' . $e->getMessage());
            return;
        }
    }

    function freezemoneyFunc()
    {
        canMenu('usergame/freezemoney');
        $sid = $this->input->post("sid");

        try {
//https://apibackend.luxvip.bio/api_backend?c=714&sid=7178Lieng1665044065874
            $datainfo = $this->get_data_curl("https://apibackend.luxvip.bio/api_backend?c=715&sid=$sid");
            $datainfo2 = $this->get_data_curl("https://apibackend.luxvip.bio/api_backend?c=714&sid=$sid");

            $res = new stdClass();
            $res->response = 1;
            $res->message = "Phá Băng Thành Công";
            echo json_encode($res);
            return;

        } catch (\Exception $e) {
            log_message('error', 'Caught exception freezemoneyAjax : ' . $e->getMessage());
            return;
        }
    }


    /*
     * Lay danh sach admin
     */
    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/usergame/index';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $phone = urlencode($this->input->post("phone"));
        $fieldname = $this->input->post("fieldname");
        $timkiemtheo = $this->input->post("timkiemtheo");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $typetaikhoan = $this->input->post("typetaikhoan");
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $taikhoanbot = $this->input->post("taikhoanbot");
        $typetk = $this->input->post("typetk");
        $email = $this->input->post("email");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=104&un=' . $username
            . '&nn=' . $nickname . '&m=' . $phone . '&fd=' . $fieldname . '&srt=' . $timkiemtheo
            . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&dl=' . $typetaikhoan
            . '&p=' . $pages . '&tr=' . $record . '&bt=' . $taikhoanbot . '&email=' . $email . '&lk=' . $typetk);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function deleteuserliveajax()
    {
        $nickname = urlencode($this->input->post("nn"));

        $res = new stdClass();

        if (empty($nickname)) {
            $res->response = -1;
            $res->mes = "NickName không được null";
            echo json_encode($res);
            return;
        }

        $checknn = $this->Usergame_model->deleteUserLive($nickname);

        if ($checknn) {

            $datainfo = $this->get_data_curl("https://apibackend.luxvip.bio/api_backend?c=1457&nn=$nickname&type=2");
            $res->response = 1;
            $res->mes = "Xóa Thành Công";
            echo json_encode($res);

        } else {
            $res->response = -1;
            $res->mes = "Xóa Thất Bại";
            echo json_encode($res);

        }
    }


    function updateuserlive()
    {
        canMenu('usergame/userlive');
        $this->data['temp'] = 'admin/usergame/updateuserlive';
        $this->load->view('admin/main', $this->data);
    }

    function updateuserliveajax()
    {
        $nickname = urlencode($this->input->post("nn"));


        $res = new stdClass();


        if (empty($nickname)) {
            $res->response = -1;
            $res->mes = "NickName không được null";
            echo json_encode($res);
            return;
        }


        $checknn = $this->Usergame_model->checknickname($nickname);


        if (isset($checknn)) {
            if (!$checknn) {
                $res->response = -1;
                $res->mes = "NickName Không tồn tại";
                echo json_encode($res);
                return;
            }
        }

        $array = array(
            "is_bot" => 0,
            "usertype" => 2,
        );

        $datainfo = $this->Usergame_model->updateUserLive($nickname, $array);

        if ($datainfo) {

            $res->response = 1;
            $res->mes = "Update Thành Công";
            echo json_encode($res);

        } else {
            $res->response = -1;
            $res->mes = "Update Thất Bại";
            echo json_encode($res);

        }
    }


    function adduserlive()
    {
        canMenu('usergame/userlive');
        $this->data['temp'] = 'admin/usergame/adduserlive';
        $this->load->view('admin/main', $this->data);
    }


    function adduserliveajax()
    {
        $username = urlencode($this->input->post("un"));
        $nickname = urlencode($this->input->post("nn"));
        $pass = urlencode($this->input->post("pas"));


        $res = new stdClass();

        if (empty($username)) {
            $res->response = -1;
            $res->mes = "UserName không được null";
            echo json_encode($res);
            return;
        }

        if (empty($nickname)) {
            $res->response = -1;
            $res->mes = "NickName không được null";
            echo json_encode($res);
            return;
        }

        if (empty($pass)) {
            $res->response = -1;
            $res->mes = "Password không được null";
            echo json_encode($res);
            return;
        }


        $checknn = $this->Usergame_model->checknickname($nickname);


        if (isset($checknn)) {
            if ($checknn) {
                $res->response = -1;
                $res->mes = "NickName đã tồn tại";
                echo json_encode($res);
                return;
            }
        }

        $checkun = $this->Usergame_model->checkusername($username);

        if (isset($checkun)) {
            if ($checkun) {
                $res->response = -1;
                $res->mes = "UserName đã tồn tại";
                echo json_encode($res);
                return;
            }
        }
        $date = date('Y-m-d H:i:s');
        $array = array(
            "user_name" => $username,
            "nick_name" => $nickname,
            "password" => md5($pass),
            "mobile" => "",
            "avatar" => "0",
            "gender" => "1",
            "vin" => 0,
            "xu" => 0,
            "vin_total" => 0,
            "xu_total" => 0,
            "safe" => 0,
            "recharge_money" => 0,
            "vip_point" => 0,
            "vip_point_save" => 0,
            "money_vp" => 0,
            "dai_ly" => 0,
            "status" => 0,
            "create_time" => $date,
            "login_otp" => -1,
            "is_bot" => 0,
            "client" => "R",
            "is_verify_mobile" => 0,
            "referral_code" => "lot79",
            "t_nap" => 0,
            "t_rut" => 0,
            "usertype" => 2,
        );


        $datainfo = $this->Usergame_model->create($array);

        if ($datainfo) {


            //type  // 1: them ; 2:xoa
            //https://apibackend.luxvip.bio/api_backend?c=1457&nn=nickname&type=1
            $datainfo = $this->get_data_curl("https://apibackend.luxvip.bio/api_backend?c=1457&nn=$nickname&type=1");

            $res->response = 1;
            $res->mes = "Tạo Thành Công";
            echo json_encode($res);

        } else {
            $res->response = -1;
            $res->mes = "Tạo Thất Bại";
            echo json_encode($res);

        }
    }

    function userlive()
    {
        canMenu('usergame/userlive');
        $this->data['temp'] = 'admin/usergame/userlive';
        $this->load->view('admin/main', $this->data);
    }

    function userliveajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $phone = urlencode($this->input->post("phone"));
        $fieldname = $this->input->post("fieldname");
        $timkiemtheo = $this->input->post("timkiemtheo");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $typetaikhoan = 1;
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $typetk = $this->input->post("typetk");
        $email = $this->input->post("email");

        $datainfo = $this->Usergame_model->get_list_user_live($nickname, $fromDate, $toDate);

        if (isset($datainfo)) {

            $rel = new stdClass;

            $rel->totalRecord = count($datainfo);
            $rel->transactions = $datainfo;

            echo json_encode($rel);
        } else {
            echo "Bạn không được hack";
        }
    }


    function uservippoint()
    {
        canMenu('usergame/uservippoint');
        $this->data['temp'] = 'admin/usergame/uservippoint';
        $this->load->view('admin/main', $this->data);
    }

    function uservip()
    {
        $this->data['temp'] = 'admin/usergame/uservip';
        $this->load->view('admin/main', $this->data);
    }

    function userdaily1()
    {
        canMenu('usergame/userdaily1');
        $this->data['temp'] = 'admin/usergame/userdaily1';
        $this->load->view('admin/main', $this->data);
    }

    function userdaily1ajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $phone = urlencode($this->input->post("phone"));
        $fieldname = $this->input->post("fieldname");
        $timkiemtheo = $this->input->post("timkiemtheo");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $typetaikhoan = 1;
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $typetk = $this->input->post("typetk");
        $email = $this->input->post("email");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=104&un=' . $username . '&nn='
            . $nickname . '&m=' . $phone . '&fd=' . $fieldname . '&srt=' . $timkiemtheo . '&ts=' . urlencode($toDate)
            . '&te=' . urlencode($fromDate) . '&dl=' . $typetaikhoan . '&p=' . $pages . '&tr=' . $record . '&bt=0' . '&email=' . $email . '&lk=' . $typetk);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

//    function  userdaily2()
//    {
//        $this->data['temp'] = 'admin/usergame/userdaily2';
//        $this->load->view('admin/main', $this->data);
//    }

//    function  useradmin()
//    {
//        $this->data['temp'] = 'admin/usergame/useradmin';
//        $this->load->view('admin/main', $this->data);
//    } 

    function uservinplay()
    {
        canMenu('usergame/uservinplay');
        if (!empty($this->input->post("isEx"))) {
            $params = [
                'c' => 104,
                'un' => $this->input->post("username") ?? '',
                'nn' => $this->input->post("nickname") ?? '',
                'm' => $this->input->post("phone") ?? '',
                'fd' => $this->input->post("fieldname") ?? '',
                'ts' => $this->input->post("fromDate"),
                'te' => $this->input->post("toDate"),
                'dl' => 0,
                'bt' => 0,
                'p' => 1,
                'srt' => '',
                'tr' => 5000,
                'email' => $this->input->post("email") ?? '',
                'lk' => $this->input->post("typetk") ?? '',
                'rc' => $this->input->post("refcode") ?? '',
            ];


            $data = $this->getDataUser($params);
            $this->csv_download(['User name', 'Phone', 'Email', 'Ngày đăng ký'], $data, ['username', 'mobile', 'email', 'createTime'], date('Y-m-d') . '_export.csv');
        }
        $this->data['temp'] = 'admin/usergame/uservinplay';
        $this->load->view('admin/main', $this->data);
    }

    public function getDataUser($params)
    {
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);


        try {
            $response = $this->get_data_curl($endPoint);


            if (empty($response)) {
                return;
            }
            $data = json_decode($response, true);
            if (empty($data['success']) || empty($data['totalRecord'])) {
                return;
            }
            return $data['transactions'];
        } catch (\Exception $e) {
            log_message('error', 'Caught exception getDataUser : ' . $e->getMessage());
            return;
        }
    }

    function uservinplayajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $phone = urlencode($this->input->post("phone"));
        $fieldname = $this->input->post("fieldname");
        $timkiemtheo = $this->input->post("timkiemtheo");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $typetaikhoan = 0;
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $typetk = 0;//$this->input->post("typetk");
        $email = $this->input->post("email");
        $refcode = $this->input->post("refcode");


//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=104&un=' . $username . '&nn='
//            . $nickname . '&m=' . $phone . '&fd=' . $fieldname . '&srt=' . $timkiemtheo . '&ts=' . urlencode($fromDate)
//            . '&te=' . urlencode($toDate) . '&dl=' . $typetaikhoan . '&p=' . $pages . '&tr=' . $record . '&bt=0' .
//            '&email=' . $email . '&lk=' . $typetk . '&rc=' . $refcode);

        $datainfo = '{"success":true,"message":null,"errorCode":"0","data":null,"total":62261,"totalRecord":3113009,"transactions":[{"username":"No2612","nickname":"nobulonn","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:48:16.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"bestte","nickname":"bestto","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:47:55.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Trucleo","nickname":"truclep","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:45:31.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"bethui12","nickname":"x2ladiluon","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":75000,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:38:39.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"buinhatlinhD","nickname":"nhatbunnn","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:17:27.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"phungbaquyen","nickname":"duhdhxhxhxhh","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:13:47.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"buinhatlinh","nickname":"nhatbun","email":null,"mobile":"84962707860","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":73496,"total_nap":73496,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 14:09:09.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"ChinhQq","nickname":"chinhuqqq","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 13:57:17.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Datyeufa","nickname":"tandtas","email":null,"mobile":"84867823543","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 13:47:08.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"tramho","nickname":"tramhot","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":1020000,"total_nap":1020000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 13:06:21.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"lovanviet442","nickname":"vanviet233","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 13:02:57.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"boynhangheoyb","nickname":"boynhangheo8386","email":null,"mobile":"84334915912","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 12:58:30.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"nhhgghhhhh","nickname":"bachphieni","email":null,"mobile":null,"identification":null,"vinTotal":50000,"xuTotal":500000,"safe":0,"rechargeMoney":50000,"total_nap":50000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 12:41:30.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"0764461442","nickname":"ttttthsiddi","email":null,"mobile":"84764461442","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 12:24:01.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"huyngoc97","nickname":"ngocpuc97","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 12:15:32.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"huydoan98","nickname":"huytrang98","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":200000,"total_nap":200000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 12:05:17.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"phamngocmai1998","nickname":"pnmaicuti","email":"","mobile":"84828833612","identification":"","vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 11:27:57.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":"1900-01-01 00:00:00.0","referral_code":"lot79"},{"username":"DuyKhangkit","nickname":"DuyKhangnecon","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 10:58:47.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"choigamemayman","nickname":"bukuda","email":null,"mobile":"84398661496","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 10:33:46.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"do210208","nickname":"hamowk","email":"alldovip1@gmail.com","mobile":"84899319936","identification":"","vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:57:54.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":"1900-01-01 00:00:00.0","referral_code":"lot79"},{"username":"huy5667","nickname":"xoiemdi111","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":500000,"total_nap":300000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:48:08.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"bosster79","nickname":"bosster01","email":"","mobile":"84387766491","identification":"","vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:38:36.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":"1900-01-01 00:00:00.0","referral_code":"lot79"},{"username":"Testla","nickname":"testle","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":212000,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:28:03.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"bapbap24","nickname":"bapbongbi","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:22:36.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"thanhmytho24","nickname":"hoanganne88","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":63000,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:16:38.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"123sam1234","nickname":"samsamv","email":null,"mobile":"84888008247","identification":null,"vinTotal":3296,"xuTotal":500000,"safe":0,"rechargeMoney":1000000,"total_nap":0,"total_tieu":-1000000,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 09:00:26.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Huyanh20","nickname":"huysaran","email":null,"mobile":"84343145379","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":200000,"total_nap":200000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 08:55:49.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"kevin9999","nickname":"longnhat12345","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 08:51:59.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Phamnamnon2000","nickname":"namnon","email":null,"mobile":null,"identification":null,"vinTotal":552,"xuTotal":500000,"safe":0,"rechargeMoney":100000,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 08:21:32.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Songacho","nickname":"Achieved","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 07:26:52.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Mthien1919","nickname":"Thn1919","email":null,"mobile":"84359058685","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 07:26:34.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Tamlovan0000","nickname":null,"email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 07:21:26.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Khanh2345679","nickname":"khanh2398","email":null,"mobile":null,"identification":null,"vinTotal":160,"xuTotal":500000,"safe":0,"rechargeMoney":90000,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 07:21:21.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Tamlovan000","nickname":null,"email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 07:20:52.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Tamhahahahah","nickname":null,"email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 07:19:40.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"tuantran9192","nickname":"tuan89000","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 06:16:19.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Khanhhhee1","nickname":"mhanhhhhs","email":null,"mobile":"84907395126","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 06:06:10.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Trami1122","nickname":"misoi1122","email":"mannhi55@icloud.com","mobile":"84826170503","identification":"","vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 06:03:22.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":"1900-01-01 00:00:00.0","referral_code":"lot79"},{"username":"cubin12377","nickname":"jijijiiii","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 05:24:36.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Taitrann92","nickname":"ngoctaii92","email":null,"mobile":"84937135403","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 05:01:02.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"sunboy0006","nickname":"sunboy879","email":null,"mobile":"84396921297","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 04:50:29.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Dinh0591","nickname":"Dinhbro1905","email":null,"mobile":null,"identification":null,"vinTotal":1569,"xuTotal":500000,"safe":0,"rechargeMoney":500000,"total_nap":200000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 04:33:09.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Matkhau098","nickname":"matkhau0987","email":null,"mobile":"84776551114","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 04:27:45.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Manhchem28","nickname":"Manhvip28","email":null,"mobile":"84374486168","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 04:25:34.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"minhtiep67788","nickname":"gugyyybhh","email":null,"mobile":"84967608355","identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 03:36:57.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"juuhbh555","nickname":"juuuu55","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 03:27:35.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Luu210492","nickname":"luuluugzgz","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 03:19:40.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Dcuonggmm","nickname":"kllejensnn","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":0,"total_nap":0,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 02:02:35.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"Gamedenquaaaa","nickname":"gamthaouuu","email":null,"mobile":"84584782617","identification":null,"vinTotal":60,"xuTotal":500000,"safe":0,"rechargeMoney":19000000,"total_nap":9900000,"total_tieu":-200000,"vippoint":2,"vippointSave":2,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 01:48:17.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"},{"username":"0355095015","nickname":"Tienssoo","email":null,"mobile":null,"identification":null,"vinTotal":0,"xuTotal":500000,"safe":0,"rechargeMoney":100000,"total_nap":100000,"total_tieu":0,"vippoint":0,"vippointSave":0,"loginOtp":-1,"bot":false,"createTime":"2024-08-10 01:39:34.0","securityTime":null,"status":0,"hasMobileSecurity":false,"hasEmailSecurity":false,"google_id":null,"facebook_id":null,"birthday":null,"referral_code":"lot79"}]}';
        $datainfo = json_decode($datainfo, true);
//        echo json_encode($datainfo);
//        die;
        if ($this->input->is_ajax_request()) {
            $this->load->model("admin/uservinplay_usergame_model");
            $rs = $this->uservinplay_usergame_model->search($username, $nickname, $phone,$fieldname,$timkiemtheo, $toDate, $fromDate, $typetaikhoan, $pages, $record, $typetk, $email, $refcode);
            echo json_encode($rs);
        } else {
            echo "Bạn không được hack";
        }
    }

    function alertUserAgentCodeAjax()
    {
        canMenu('usergame/uservinplay');
        $params = [
            'c' => 9430,
            'rc' => $this->input->post("cd"),
            'nn' => $this->input->post("nn"),
        ];
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        try {
            $data = $this->get_data_curl($endPoint);
            echo empty($data) ? "" : $data;
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception alertUserAgentCodeAjax : ' . $e->getMessage());
            return;
        }
    }

    function pwd_uservinplayajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);

        if ($admin_info->UserName == 'cskh1' ||
            $admin_info->UserName == 'cskh2' ||
            $admin_info->UserName == 'cskh3' ||
            $admin_info->UserName == 'cskh4' ||
            $admin_info->UserName == 'cskh5' ||
            $admin_info->UserName == 'cskh6' ||
            $admin_info->UserName == 'cskh7' ||
            $admin_info->UserName == 'cskh8' ||
            $admin_info->UserName == 'cskh9' ||
            $admin_info->UserName == 'cskh10' ||
            $admin_info->UserName == 'cskh11') {

            $res = new stdClass();
            $res->errorCode = -1;
            $res->success = false;
            $res->message = "Bạn không có quyền thực hiện chức năng này";

            echo json_encode($res);
        }

        //https://apibackend.luxvip.bio/api_backend?c=1456&un=test888&sign=ed019c0dd2643ed143be7f759c7436c9
        $username = urlencode($this->input->post("reason"));
        $sign = md5($username . "|" . "F5LFGTYMNV6E4MG9GT");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1456&un=' . $username . '&sign=' . $sign);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


    function lockchat_uservinplayajax()
    {
        //https://apibackend.fte-sq.org/api_backend?c=1993&nn=tesst011&t=100000
        $time = urlencode($this->input->post("reason"));
        $nn = urlencode($this->input->post("nn"));

        if ($time == -1) {
            $time = 1000000 * 60 * 1000;
        } else if ($time = 0) {
            $time = 0;
        } else {
            $time = $time * 60 * 1000;
        }

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1993&nn=' . $nn . '&t=' . $time);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function userbot()
    {
        canMenu('usergame/userbot');
        $this->data['temp'] = 'admin/usergame/userbot';
        $this->load->view('admin/main', $this->data);
    }

    function userbotajax()
    {
        $username = urlencode($this->input->post("username"));
        $nickname = urlencode($this->input->post("nickname"));
        $phone = urlencode($this->input->post("phone"));
        $fieldname = $this->input->post("fieldname");
        $timkiemtheo = $this->input->post("timkiemtheo");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $typetaikhoan = $this->input->post("typetaikhoan");
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=104&un=' . $username .
            '&nn=' . $nickname . '&m=' . $phone . '&fd=' . $fieldname . '&srt=' . $timkiemtheo .
            '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&dl=' . $typetaikhoan .
            '&p=' . $pages . '&tr=' . $record . '&bt=1' . '&email=&lk=0');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function userlogin()
    {
        canMenu('usergame/userlogin');
        $this->data['temp'] = 'admin/usergame/userlogin';
        $this->load->view('admin/main', $this->data);
    }

    function userloginajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $iplogin = urlencode($this->input->post("iplogin"));
        $devicelogin = urlencode($this->input->post("devicelogin"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $status = $this->input->post("status");
        $pages = $this->input->post("pages");

//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=109&nn=' . $nickname . '&ip=' . $iplogin . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&type=' . $status . '&p=' . $pages . '&dv=' . $devicelogin);
        if ($this->input->is_ajax_request()) {
            $this->load->model("admin/userlogin_usergame_model");
            $rs = $this->userlogin_usergame_model->search($nickname, $iplogin, $devicelogin, $toDate, $fromDate, $status, $pages);
            echo json_encode($rs);
        } else {
            echo "Bạn không được hack";
        }
    }

//    function topcaothu()
//    {
//
//        $this->data['temp'] = 'admin/usergame/topcaothu';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function topcaothuajax()
//    {
//        $display = $this->input->post("display");
//        $money = $this->input->post("money");
//        $date = $this->input->post("date");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=13&n=' . $display . '&mt=' . $money . '&date=' . $date);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//    }

    function topuserbot()
    {
        canMenu('usergame/topuserbot');
        $this->data['temp'] = 'admin/usergame/topuserbot';
        $this->load->view('admin/main', $this->data);
    }

    function topuserbotajax()
    {
        $display = $this->input->post("display");
        $gamename = $this->input->post("gamename");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=12&n=' . $display . '&ac=' . $gamename . '&ts=' . $toDate . '&te=' . $fromDate);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function sendmail()
    {

        $this->data['temp'] = 'admin/usergame/sendmail';
        $this->load->view('admin/main', $this->data);
    }


    function lockuser()
    {
        $nickname = $this->uri->rsegment('3');
        $status = $this->uri->rsegment('4');

        $allstatus = str_repeat('0', 40 - strlen(decbin($status))) . decbin($status);
        $dao = $this->mb_strrev($allstatus, $encoding = "utf-8");
        $this->data['daochuoi'] = $dao;
        $this->data['nickname'] = $nickname;
        $this->data['status'] = $status;
        $this->data['temp'] = 'admin/usergame/lockuser';
        $this->load->view('admin/main', $this->data);
    }

    function messlockuser()
    {
        $this->session->set_flashdata('message', 'Câp  nhật thành công');

    }

    function lockuserajax()
    {
        $nickname = $this->input->post("nickname");
        $action = $this->input->post("action");
        $type = $this->input->post("type");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=105&nn=' . $nickname . '&ac=' . $action . '&type=' . $type);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

        $po = strpos($action, '604');

        if ($po >= 0) {
            $this->Usergame_model->deleteBalance($nickname);
        }

        return;


    }

    function loglockuser()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $lydo = $this->input->post("txtlydo");
        $nickname = $this->input->post("nickname");
        $txtaction = $this->input->post("txtaction");
        $statuslock = $this->input->post("statuslock");
        $data = array(
            'reason' => $lydo,
            'account_name' => $nickname,
            'username' => $admin_info->UserName,
            'action' => $txtaction,
            'status' => $statuslock,
        );
        $this->logadmin_model->create($data);
    }

    function upload()
    {
        if (file_exists(FCPATH . "public/admin/uploads/nickname.csv") != false) {
            $this->load->library('csvreader');
            $result = $this->csvreader->parse_file(public_url('admin/uploads/nickname.csv'));
            $listnn = array();
            foreach ($result as $row) {
                if ($row["Nickname"]) {
                    array_push($listnn, $row["Nickname"]);
                }

            }
            $this->data['listnn'] = implode(',', $listnn);
            echo json_encode(array(array("er" => 0), array("nn" => implode(',', $listnn))));
        } else {
            echo json_encode(array(array("er" => 1)));
        }
    }

    function search_usergame()
    {
        $query_array = array(
            'name' => $this->input->post('name'),
            'nickname' => $this->input->post('nickname'),
            'sdt' => $this->input->post('sdt')

        );
        $query_id = $this->input->save_query($query_array);
        redirect("admin/usergame/index/$query_id");
    }

    function detailgc()
    {
        $nickname = $this->uri->rsegment('3');
        $this->data['nickname'] = $nickname;
        $this->load->view('admin/usergame/detailgc', $this->data);
    }

    function detailgcajax()
    {
        $nickname = $this->input->post("nickname");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=135&nn=' . $nickname . '&p=1');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function resetpw()
    {
        $this->data['temp'] = 'admin/usergame/resetpw';
        $this->load->view('admin/main', $this->data);
    }

    function resetpwajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = $this->input->post("nickname");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=14&nn=' . $nickname);
        if (isset($datainfo)) {
            $data = array(
                'account_name' => $nickname,
                'username' => $admin_info->UserName,
                'action' => "Reset password"
            );
            $this->logadmin_model->create($data);
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

//    function updateinfo()
//    {
//        $this->data['temp'] = 'admin/usergame/updateinfo';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function updateinfoajax()
//    {
//        $admin_login = $this->session->userdata('user_id_login');
//        $admin_info = $this->admin_model->get_info($admin_login);
//        $nickname = urlencode($this->input->post("nickname"));
//        $birthday = $this->input->post("birthday");
//        $gioitinh = $this->input->post("gioitinh");
//        $address = urlencode($this->input->post("address"));
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=15&nn=' . $nickname . '&bd=' . $birthday . '&gd=' . $gioitinh . '&address=' . $address);
//        if (isset($datainfo)) {
//            if ($datainfo == 0) {
//                $data = array(
//                    'account_name' => $nickname,
//                    'username' => $admin_info->UserName,
//                    'action' => "Cập nhập thông tin tài khoản",
//                );
//                $this->logadmin_model->create($data);
//            }
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//    }

//    function congxu()
//    {
//        $this->data['temp'] = 'admin/usergame/congxu';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function congxuajax()
//    {
//        $admin_login = $this->session->userdata('user_id_login');
//        $admin_info = $this->admin_model->get_info($admin_login);
//        $nickname = urlencode($this->input->post("nickname"));
//        $money = $this->input->post("money");
//        $reason = urlencode($this->input->post("reason"));
//        $otp = urlencode($this->input->post("otp"));
//        $typeotp = $this->input->post("typeotp");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=100&nn=' . $nickname . '&mn=' . $money . '&mt=' . "xu" . '&nns=' . $admin_info->FullName . '&rs=' . $reason . '&otp=' . $otp . '&type=' . $typeotp);
//        $data = json_decode($datainfo);
//        if (isset($data->success)) {
//            if ($data->success == true) {
//                if ($data->errorCode == 0) {
//                    $data = array(
//                        'account_name' => $nickname,
//                        'username' => $admin_info->UserName,
//                        'action' => "Cộng xu",
//                        'money' => $money,
//                        'money_type' => 'Xu'
//                    );
//                    $this->logadmin_model->create($data);
//                    echo json_encode("1");
//                }
//            } else {
//                if ($data->errorCode == 1001) {
//                    echo json_encode("2");
//                } elseif ($data->errorCode == 1002) {
//                    echo json_encode("3");
//                } elseif ($data->errorCode == 1008) {
//                    echo json_encode("4");
//                } elseif ($data->errorCode == 1021) {
//                    echo json_encode("5");
//                } elseif ($data->errorCode == 2001) {
//                    echo json_encode("6");
//                }
//            }
//
//        } else {
//            echo "Bạn không được hack";
//        }
//
//    }

//    function truxuajax()
//    {
//        $admin_login = $this->session->userdata('user_id_login');
//        $admin_info = $this->admin_model->get_info($admin_login);
//        $nickname = urlencode($this->input->post("nickname"));
//        $money = $this->input->post("money");
//        $reason = urlencode($this->input->post("reason"));
//        $otp = urlencode($this->input->post("otp"));
//        $typeotp = $this->input->post("typeotp");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=100&nn=' . $nickname . '&mn=' . $money . '&mt=' . "xu" . '&nns=' . $admin_info->FullName . '&rs=' . $reason . '&otp=' . $otp . '&type=' . $typeotp);
//        $data = json_decode($datainfo);
//        if (isset($data->success)) {
//            if ($data->success == true) {
//                if ($data->errorCode == 0) {
//                    $data = array(
//                        'account_name' => $nickname,
//                        'username' => $admin_info->UserName,
//                        'action' => "Trừ xu",
//                        'money' => $money,
//                        'money_type' => 'Xu'
//                    );
//                    $this->logadmin_model->create($data);
//                    echo json_encode("1");
//                }
//            } else {
//                if ($data->errorCode == 1001) {
//                    echo json_encode("2");
//                } elseif ($data->errorCode == 1002) {
//                    echo json_encode("3");
//                } elseif ($data->errorCode == 1008) {
//                    echo json_encode("4");
//                } elseif ($data->errorCode == 1021) {
//                    echo json_encode("5");
//                } elseif ($data->errorCode == 2001) {
//                    echo json_encode("6");
//                }
//            }
//
//        } else {
//            echo "Bạn không được hack";
//        }
//
//    }


    function logchangemobile()
    {
        canMenu('usergame/logchangemobile');
        $this->data['temp'] = 'admin/usergame/logchangemobile';
        $this->load->view('admin/main', $this->data);
    }

    function logchangemobileajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $mobilenew = urlencode($this->input->post("mobilenew"));
        $mobileold = urlencode($this->input->post("mobileold"));
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=509&nn=' . $nickname . '&m=' . $mobilenew . '&mo=' . $mobileold . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }
//    function checkinfo()
//    {
//
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('d-m-Y');
//        }
//        if ($end_time === null) {
//            $end_time = date('d-m-Y');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['error'] = "";
//        if ($this->input->post("ok")) {
//            if (file_exists('public/admin/uploads/checkinfo.csv')) {
//                unlink('public/admin/uploads/checkinfo.csv');
//            }
//            $temp = explode(".", $_FILES["filexls"]["name"]);
//            $extension = end($temp);
//            if ($extension == "csv") {
//                $config = array("");
//                $config['upload_path'] = './public/admin/uploads';
//                $config['allowed_types'] = '*';
//                $config['max_size'] = 1024 * 8;
//                $config['overwrite'] = TRUE;
//                $config['file_name'] = 'checkinfo';
//                $this->load->library('upload', $config);
//                $this->upload->initialize($config);
//
//                if (!$this->upload->do_upload('filexls')) {
//                    $error = array('error' => $this->upload->display_errors());
//                    $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";
//
//                } else {
//                    $this->data['error'] = "";
//                    $data = array('upload_data' => $this->upload->data());
//
//                    $this->data['error'] = "Upload file thành công";
//                    //
//
//                }
//            } else {
//                $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
//            }
//
//        }
//        if (file_exists(FCPATH . "public/admin/uploads/checkinfo.csv") != false) {
//            $this->load->library('csvreader');
//            $result = $this->csvreader->parse_file(public_url('admin/uploads/checkinfo.csv'));
//            $listnn = array();
//            foreach ($result as $row) {
//                if (isset($row["Nickname"])) {
//                    array_push($listnn, $row["Nickname"]);
//                }
//
//            }
//            $this->data['listnn'] = implode(',', $listnn);
//        } else {
//            $this->data['listnn'] = "";
//        }
//        $this->data['temp'] = 'admin/usergame/checkinfo';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function checkinfoajax()
//    {
//        $nickname = urlencode($this->input->post("nickname"));
//        $todate = urlencode($this->input->post("todate"));
//        $fromdate = urlencode($this->input->post("fromdate"));
//        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=606&nn=' . $nickname . '&ts=' . $todate . '&te=' .$fromdate);
//
//
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "Bạn không được hack";
//        }
//
//    }

    function setjackpot()
    {
        canMenu('usergame/setjackpot');
        $this->data['temp'] = 'admin/usergame/setjackpot';
        $this->load->view('admin/main', $this->data);
    }

    function setjackpotajax()
    {
        canMenu('usergame/setjackpot');
        $nickname = urlencode($this->input->post("nickname"));
        $gameid = urlencode($this->input->post("gameid"));
        $betvalue = urlencode($this->input->post("betvalue"));
        $action = 0;
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=730&nickName=' . $nickname . '&gameID=' . $gameid . '&betValue=' . $betvalue . '&action=' . $action);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function deletejackpotajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $gameid = urlencode($this->input->post("gameid"));
        $betvalue = urlencode($this->input->post("betvalue"));
        $action = 1;
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=730&nickName=' . $nickname . '&gameID=' . $gameid . '&betValue=' . $betvalue . '&action=' . $action);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function listjackpotajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=729');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function setuserwin()
    {
        canMenu('usergame/setuserwin');
        $this->data['temp'] = 'admin/usergame/setuserwin';
        $this->load->view('admin/main', $this->data);
    }

    function listuserwinajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8904&action=0');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function setuserwinajax()
    {
        canMenu('usergame/setuserwin');
        $params = [
            'c' => 8904,
            'nick_name' => $this->input->post("nickname"),
            'action' => 1,
            'ut' => $this->input->post("ut"),
        ];
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        $result = $this->get_data_curl($endPoint);

        if (isset($result)) {
            echo $result;
            return;
        }
        echo "Bạn không được hack";
        return;
    }

    function deleteuserwinajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8904&nick_name=' . $nickname . '&action=2');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function setresulttaixiu()
    {
        canMenu('usergame/setresulttaixiu');
        $this->data['temp'] = 'admin/usergame/setresulttaixiu';
        $this->load->view('admin/main', $this->data);
    }

    function setresultonlytaixiuajax()
    {
        canMenu('usergame/setresulttaixiu');
        $result = urlencode($this->input->post("result"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8798&result=' . $result);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function setresult()
    {
        canMenu('usergame/setresult');
        $this->data['temp'] = 'admin/usergame/setresult';
        $this->load->view('admin/main', $this->data);
    }

    function listresulttaixiuajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=732&action=0');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function setresulttaixiuajax()
    {
        canMenu('usergame/setresult');
        $result = urlencode($this->input->post("result"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=731&result=' . $result . '&action=0');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function deleteresulttaixiuajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=733&action=0');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function listresultbaucuaajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=732&action=1');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function setresultbaucuaajax()
    {
        canMenu('usergame/setresult');
        $result = urlencode($this->input->post("result"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=731&result=' . $result . '&action=1');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function deleteresultbaucuaajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=733&action=1');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function syncData()
    {
        canMenu('usergame/syncData');
        $this->data['temp'] = 'admin/usergame/syncData';
        $this->load->view('admin/main', $this->data);
    }

    function syncDataAjax()
    {
        canMenu('usergame/syncData');
        $params = [
            'c' => 76,
            'gn' => $this->input->post("gn"),
            'ft' => $this->input->post("ft"),
            'et' => $this->input->post("et"),
        ];
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        try {
            $data = $this->get_data_curl($endPoint);
            echo empty($data) ? "" : $data;
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception syncDataAjax : ' . $e->getMessage());
            return;
        }
    }

    function jackpotCache()
    {
        canMenu('usergame/jackpotCache');
        $this->data['temp'] = 'admin/usergame/jackpotCache';
        $this->load->view('admin/main', $this->data);
    }

    function ajaxJackpotCache()
    {
        $action = $this->input->post("action");
        $params = [
            'c' => 1992,
            'delete' => $action,
            'cn' => $this->input->post("cn"),//'cacheSetUserJackpot',
            'k' => $this->input->post("k"),
        ];
        if ($action == 2) {
            $params['value'] = $this->input->post("value");
        }
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        try {
            $data = $this->get_data_curl($endPoint);
            echo $data;
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception ajaxJackpotCache : ' . $e->getMessage());
        }
        return;
    }
}