<?php                                                                       
defined('BASEPATH') OR exit('No direct script access allowed');
Class Myoperator {

    protected $developers_url = 'https://wservices.margcompusoft.com/api/eOnlineData/MargEDE';
    protected $code = 'MEDICO3';
    protected  $key = 'IW0GRBDSS6GU';

    function __construct() {
    }

    public function run() {
        # request for Logs
        $url = $this->developers_url ;
        //5:30pm May 23 2020
        $d=strtotime('12:00am  April 1 2020');

        $this->datetime =  date("Y-m-d h:i:sa", $d);
        $fields = [ "CompanyCode" => $this->code ,"Datetime"=> $this->datetime ,"Index" => 0];
        $response = $this->_post_api($fields, $url );
        return $response;

    }

    private function _post_api(Array $fields, $url) {
         $headers = array("Content-Type: application/json");
         $data = json_encode( $fields);
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $err = curl_error($ch);
            $result = curl_exec($ch);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            }
            
        } 
        catch (Exception $e) {
            return false;
        }        
        curl_close($ch);
        if ($result)
            return $result;
        else
            return false;
    }

    private function log($message) {
        print_r($message);
        
    }
   

}
?>