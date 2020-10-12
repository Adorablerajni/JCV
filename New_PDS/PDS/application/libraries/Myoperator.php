<?php                                                                       
defined('BASEPATH') OR exit('No direct script access allowed');
Class Myoperator {

    protected $developers_url = 'https://2factor.in/API/V1/553dbb22-fe6b-11ea-9fa5-0200cd936042/SMS/+91{mobile_number}/AUTOGEN';
    

    function __construct() {
    }

    public function run($mobile) {
        # request for Logs
        $url = $this->developers_url ;
        $url = str_replace('{mobile_number}', $mobile,  $url);
        $response = $this->_get_api( $url );
        return $response;

    }
    public function run_verify($user_Otp,$session_id) {
        # request for Logs
        $api_key ='553dbb22-fe6b-11ea-9fa5-0200cd936042';
        $url = 'https://2factor.in/API/V1/{api_key}/SMS/VERIFY/{session_id}/{otp_entered_by_user}' ;
        $url = str_replace('{api_key}',$api_key,  $url);
        $url = str_replace('{session_id}',$session_id,  $url);
        $url = str_replace('{otp_entered_by_user}',$user_Otp,  $url);
        $response = $this->_get_api( $url );
        return $response;

    }


    private function _get_api( $url) {
       
         
        try {

             // Get cURL resource
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
          

            return $resp;
            
            
        } 
        catch (Exception $e) {
            return false;
        }        
        curl_close($curl);
        
    }

    private function log($message) {
        print_r($message);
        
    }
   

}
?>