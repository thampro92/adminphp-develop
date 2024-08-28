<?php

Class Login extends MY_controller
{
    function index()
    {

        $ip = $this->getIPAddress();
        if(

$ip != "207.148.121.203" 
&& $ip != "2001:19f0:4401:18:5400:4ff:fe12:75ff"
&& $ip != "2405:4802:278:ea50:889:3dfe:9fa8:b0f6" 
&& $ip != "::1" 
&& $ip != "206.189.145.91"
&& $ip != "139.59.239.174"
&& $ip !="35.198.33.2"
&& $ip !="35.198.56.180"
&& $ip !="143.198.202.87"
&& $ip != "206.189.155.142"
&& $ip != "92.119.177.20"
&& $ip != "139.59.224.232"
&& $ip != "104.248.156.46"
&& $ip != "104.248.156.85"
&& $ip != "165.232.167.43"
&& $ip != "157.245.146.129"
&& $ip != "167.172.68.52"
&& $ip != "167.172.86.154"
&& $ip != "165.232.173.113"
&& $ip != "2402:800:61c2:c6e2:1ce5:1509:8ec:9779"
&& $ip != "206.189.145.91"
&& $ip != "37.19.205.183"
&& $ip != "143.198.219.221"
&& $ip != "128.199.114.124"
&& $ip != "128.199.114.136"
&& $ip != "128.199.114.135"
&& $ip != "128.199.167.98"
&& $ip != "128.199.143.247"
&& $ip != "128.199.148.144"
&& $ip != "188.166.191.87"
&& $ip != "128.199.195.129"
&& $ip != "104.248.157.98"
&& $ip != "159.223.78.206"
&& $ip != "134.209.111.172"
&& $ip != "157.245.147.82"
&& $ip != "134.209.104.101"
&& $ip != "118.71.116.63"
&& $ip != "2405:4802:1bb6:96d0:1ce3:cfd3:6410:b5a3"
&& $ip != "139.180.186.24"
&& $ip != "157.230.47.251"
&& $ip != "157.230.37.64"

        ){
            return $this->getIPAddress();
        }



        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post()) {
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            $user = $this->_get_user_info();
            $this->session->set_userdata('user_admintransfer_login', $user->ID);
        }
        $this->load->view('admin/login/index');
    }

    private function _get_user_info()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        $this->load->model('admin_model');
        $where = array('UserName' => $username, 'Password' => $password);
        $user = $this->admin_model->get_info_rule($where);
        return $user;
    }

    function infouser($nickname, $accessToken)
    {
        $this->load->model('admin_model');
        $where = array('FullName' => $nickname);
        $user = $this->admin_model->get_info_rule($where);

        if ($user == false) {
            $this->session->set_flashdata('message', ' Tài khoản chưa được phân quyền');
            return false;
        } else {
            $this->session->set_userdata('user_id_login', $user->ID);
            $this->session->set_userdata('user_name_login', $user->UserName);
            $this->session->set_userdata('nick_name_login', $nickname);
            $this->session->set_userdata('accessToken', array($accessToken, $nickname));
            $userPermission = $this->userPermission($user);
            $this->session->set_userdata('user_menu', $userPermission);
        }
        return true;
    }

    function loginajax(){
        $username = $this->input->post('username');
        $password =  $this->input->post('password');
        $datainfo = $this->curl->simple_get($this->config->item('api_url2').'?c=701&un='.$username.'&pw=' . $password);
        $data = json_decode($datainfo);
        if($data->success == true){
            $this->log_login_admin($username,"Thành công",0);
            $dataObj = json_decode(base64_decode($data->sessionKey));
            $nickname = $dataObj -> nickname;
            $this->session->set_userdata('nicknameadmin', $nickname);
            $this->session->set_userdata('isMobileSecure', $dataObj->mobileSecure);
            if ($dataObj->mobileSecure == 0) {
                if($this->infouser($nickname) == true){
                    $data->inforuser = 1;
                    $this->log_login_admin($username,"Login",0);
                }else{
                    $data->inforuser = 2;
                    $this->log_login_admin($username,"Tài khoản chưa được phân quyền",1);
                }
                $datainfo = json_encode($data);
            }
        }else{
            if($data->errorCode == 1001){
                $this->log_login_admin($username,"Hệ thống gián đoạn",1);
            }
            if($data->errorCode == 1005){
                $this->log_login_admin($username,"Username không tồn tại",1);
            }
            if($data->errorCode == 1007){
                $this->log_login_admin($username,"Password không đúng",1);
            }
            if($data->errorCode == 1109){
                $this->log_login_admin($username,"Tài khoản bị khóa đăng nhập",1);
            }
            if($data->errorCode == 1114){
                $this->log_login_admin($username,"Hệ thống bảo trì",1);
            }
            if($data->errorCode == 2001){
                $this->log_login_admin($username,"Tài khoản chưa cập nhật nickname",1);
            }
            if($data->errorCode == 1012){
                $this->log_login_admin($username,"Tài khoản đăng nhập bằng OTP",1);
            }
        }
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "Bạn không được hack";
        }
    }

    function getIPAddress() {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }



    function loginODP()
    {

        $ip = $this->getIPAddress();
        if(

$ip != "207.148.121.203" 
&& $ip != "2001:19f0:4401:18:5400:4ff:fe12:75ff"
&& $ip != "2405:4802:278:ea50:889:3dfe:9fa8:b0f6" 
&& $ip != "::1" 
&& $ip != "206.189.145.91"
&& $ip != "139.59.239.174"
&& $ip !="35.198.33.2"
&& $ip !="35.198.56.180"
&& $ip !="143.198.202.87"
&& $ip != "206.189.155.142"
&& $ip != "92.119.177.20"
&& $ip != "139.59.224.232"
&& $ip != "104.248.156.46"
&& $ip != "104.248.156.85"
&& $ip != "165.232.167.43"
&& $ip != "157.245.146.129"
&& $ip != "167.172.68.52"
&& $ip != "167.172.86.154"
&& $ip != "165.232.173.113"
&& $ip != "2402:800:61c2:c6e2:1ce5:1509:8ec:9779"
&& $ip != "206.189.145.91"
&& $ip != "37.19.205.183"
&& $ip != "143.198.219.221"
&& $ip != "128.199.114.124"
&& $ip != "128.199.114.136"
&& $ip != "128.199.114.135"
&& $ip != "128.199.167.98"
&& $ip != "128.199.143.247"
&& $ip != "128.199.148.144"
&& $ip != "188.166.191.87"
&& $ip != "128.199.195.129"
&& $ip != "104.248.157.98"
&& $ip != "159.223.78.206"
&& $ip != "134.209.111.172"
&& $ip != "157.245.147.82"
&& $ip != "134.209.104.101"
&& $ip != "118.71.116.63"
&& $ip != "2405:4802:1bb6:96d0:1ce3:cfd3:6410:b5a3"
&& $ip != "139.180.186.24"
&& $ip != "157.230.47.251"
&& $ip != "157.230.37.64"

        ){
            return $this->getIPAddress();
        }


        $username = $this->input->post('username');
        $password = $this->input->post('password');
//        $odpinfo = $this->get_data_curl($this->config->item('api_backend') . '?c=701&un=' . $username . '&pw=' . $password);
        $this->load->model('admin_model');
        $data = $this->admin_model->check_login($username, $password);
        if (isset($data)) {
            if ($data->success == true) {
                $dataObj = json_decode(base64_decode($data->sessionKey));
                $nickname = $dataObj -> nickname;
                $this->session->set_userdata('nicknameadmin', $nickname);
                $this->session->set_userdata('isMobileSecure', $dataObj->mobileSecure);
                //print_r(json_decode(base64_decode($data->sessionKey)));
                $access = $data->accessToken;

                if ($this->infouser($nickname, $access) == true) {
                    $this->log_login_admin($username, "Thành công", 0);
                    //echo 'day';
                    //return;
                    echo json_encode("1");
                } else {
                    $this->log_login_admin($username, "Tài khoản chưa được phân quyền", 1);
                    echo json_encode("2");
                }

            } else {
                if ($data->errorCode == 1001) {
                    $this->log_login_admin($username, "Hệ thống gián đoạn", 1);
                    echo json_encode("3");
                }
                if ($data->errorCode == 1005) {
                    $this->log_login_admin($username, "Username không tồn tại", 1);
                    echo json_encode("4");
                }
                if ($data->errorCode == 1007) {
                    $this->log_login_admin($username, "Password không đúng", 1);
                    echo json_encode("5");
                }
                if ($data->errorCode == 1109) {
                    $this->log_login_admin($username, "Tài khoản bị khóa đăng nhập", 1);
                    echo json_encode("6");
                }
                if ($data->errorCode == 1114) {
                    $this->log_login_admin($username, "Hệ thống bảo trì", 1);
                    echo json_encode("7");
                }
                if ($data->errorCode == 2001) {
                    $this->log_login_admin($username, "Tài khoản chưa cập nhật nickname", 1);
                    echo json_encode("8");
                }
                if ($data->errorCode == 1012) {
                    $this->log_login_admin($username, "Tài khoản đăng nhập bằng OTP", 1);
                    echo json_encode("9");
                }

            }
        }


    }

    function log_login_admin($username, $action, $status)
    {
        $this->load->model('admin_model');
        $this->load->model('log_loginadmin_model');
        $where = array('UserName' => $username);
        $user = $this->admin_model->get_info_rule($where);
        if ($user == true) {
            $username = $user->UserName;
            $nickname = $user->FullName;
        } else {
            $nickname = "";
        }
        $data = array(
            'username' => $username,
            'nickname' => $nickname,
            'ip' => $this->get_client_ip(),
            'status' => $status,
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'action' => $action,
            'tool' => "Admin"

        );
        $this->log_loginadmin_model->create($data);

    }

    function userPermission($user)
    {
        $this->load->model('userrole_model');
        $userPermission = $this->userrole_model->get_permission_by($user->ID);
        if ($userPermission) {
            return array_column($userPermission, "Link");
        }
        return [];
    }
}