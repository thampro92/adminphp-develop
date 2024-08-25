<?php
Class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIPAddress() {
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

        $this->lang->load('admin/home');
        $this->data['temp'] = 'admin/home/index';
        $this->load->view('admin/main', $this->data);
    }

    function getDashboardStatisticsAjax(){
        $dateOption = $this->input->post('dateOption');
        $today = date('Y-m-d');
        switch ($dateOption) {
            case "yesterday":
                $start_time = date('Y-m-d', strtotime('-1 day', strtotime($today)));
                $end_time = $start_time;
                break;
            case "previousWeek":
                $start_time = date('Y-m-d', strtotime("monday -2 week"));
                $end_time = date('Y-m-d', strtotime("sunday -1 week"));
                break;
            case "previousMonth":
                $month_ini = new DateTime("first day of last month");
                $month_end = new DateTime("last day of last month");
                $start_time = $month_ini->format('Y-m-d');;
                $end_time = $month_end->format('Y-m-d');
                break;
            default:
                $start_time = $today;
                $end_time = $today;
                break;
        }
        $rechargeParams = [
            'c' => 9102,
            'ts' => $start_time,
            'te' => $end_time,
        ];
        $start_time1=date('d-m-Y',strtotime($start_time));
        $end_time1=date('d-m-Y',strtotime($end_time));
        $charging = $this->get_data_curl($this->config->item('api_backend') . '?c=7&ts='.$start_time1.'&te='.$end_time1);
        //$userRegister = file_get_contents($this->config->item('api_backend2').'?c=142&ts='.urlencode($start_time.' 00:00:00').'&te='.urlencode($end_time. '23:59:00'));
        $ccu = $this->get_data_curl($this->config->item('api_backend2').'?c=108&ts='.$start_time.' 00:00:00&te='.$end_time.' 23:59:00');
        //$userRecharge = $this->get_data_curl($this->config->item('api_backend2') . '?' . http_build_query($rechargeParams));

//        $vinplay=$this->load->database("vinplay",TRUE);
        $newCCU = new stdClass();
        $newCCU->web=0;
        $newCCU->android=0;
        $newCCU->ios=0;
        $newCCU->total=0;
        $ccu=json_decode($ccu);
        if ($ccu&&$ccu->transactions){
            foreach ($ccu->transactions as $item){
                $newCCU->web=$newCCU->web+$item->web;
                $newCCU->web=$newCCU->android+$item->android;
                $newCCU->ios=$newCCU->android+$item->ios;
                $newCCU->total=$newCCU->total+$item->web+$item->android+$item->ios+$item->ad+$item->wp+$item->fb+$item->dt+$item->ot+$item->ts;
            }
        }
        if (isset($charging)) {
            //$charging=json_decode($charging);
            //$charging->register=json_decode($userRegister);
            //$charging->ccu=$newCCU;
            //$charging->userRecharge=$userRecharge;
            echo json_encode($charging);
        } else {
            echo "Bạn không được hack";
        }
    }
}